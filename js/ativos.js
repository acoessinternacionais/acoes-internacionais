const API_KEY = 'Y03SX8XFM7QQ56RG'; // Substitua pela sua chave real da Alpha Vantage
const ativos = ['AAPL', 'MSFT', 'GOOGL', 'AMZN', 'ITUB', 'PETR4.SA']; // Exemplo: ações EUA + Brasil

// Atualiza os dados a cada 60 segundos
setInterval(buscarAtivos, 60000);
buscarAtivos(); // primeira chamada ao carregar a página

async function buscarAtivos() {
  const tabela = document.getElementById('tabela-ativos');
  tabela.innerHTML = '<tr><td colspan="5">Carregando dados...</td></tr>';

  const rows = await Promise.all(ativos.map(async ticker => {
    try {
      const url = `https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${ticker}&apikey=${API_KEY}`;
      const response = await fetch(url);
      const data = await response.json();
      const quote = data['Global Quote'];

      if (!quote || !quote['05. price']) {
        return `<tr><td>${ticker}</td><td>-</td><td>Erro</td><td>--</td><td>--</td></tr>`;
      }

      const preco = parseFloat(quote['05. price']).toFixed(2);
      const variacao = parseFloat(quote['09. change']).toFixed(2);
      const pct = parseFloat(quote['10. change percent']).toFixed(2);

      return `
        <tr>
          <td>${ticker}</td>
          <td>${ticker}</td>
          <td>R$ ${preco}</td>
          <td>--</td>
          <td style="color:${variacao >= 0 ? 'green' : 'red'}">${variacao} (${pct}%)</td>
        </tr>`;
    } catch (err) {
      return `<tr><td>${ticker}</td><td>-</td><td>Erro</td><td>--</td><td>--</td></tr>`;
    }
  }));

  tabela.innerHTML = rows.join('');
}
let chart; // gráfico global

document.addEventListener('click', function (e) {
  const target = e.target.closest('tr');
  if (target && target.cells.length && target.cells[0].innerText !== 'Ticker') {
    const ticker = target.cells[0].innerText;
    carregarGrafico(ticker);
  }
});

async function carregarGrafico(ticker) {
  const url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=${ticker}&apikey=${API_KEY}`;
  const response = await fetch(url);
  const data = await response.json();

  const timeseries = data['Time Series (Daily)'];
  if (!timeseries) {
    alert("Erro ao carregar gráfico.");
    return;
  }

  const labels = Object.keys(timeseries).slice(0, 10).reverse(); // últimos 10 dias
  const valores = labels.map(dia => parseFloat(timeseries[dia]['4. close']));

  const ctx = document.getElementById('grafico-preco').getContext('2d');

  // Remove gráfico antigo
  if (chart) chart.destroy();

  // Cria novo gráfico
  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: `Preço de ${ticker}`,
        data: valores,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: false
        }
      }
    }
  });
}
document.getElementById('periodo').addEventListener('change', () => {
  if (chart) {
    const lastTicker = chart.data.datasets[0].label.split(" ")[2];
    carregarGrafico(lastTicker);
  }
});
