const API_KEY = 'Y03SX8XFM7QQ56RG'; // Substitua pela sua chave da Alpha Vantage
const ativos = ['AAPL', 'MSFT', 'GOOGL', 'AMZN', 'PETR4.SA', 'VALE3.SA'];

let chart;
let periodoAtual = 'daily'; // padrão: últimos dias

// Atualiza tabela a cada 60 segundos
setInterval(buscarAtivos, 60000);
buscarAtivos();

// Preenche a tabela com dados em tempo real
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
      const pct = quote['10. change percent'];

      return `
        <tr data-ticker="${ticker}">
          <td>${ticker}</td>
          <td>${ticker}</td>
          <td>R$ ${preco}</td>
          <td>--</td>
          <td style="color:${variacao >= 0 ? 'green' : 'red'}">${variacao} (${pct})</td>
        </tr>`;
    } catch (err) {
      return `<tr><td>${ticker}</td><td>-</td><td>Erro</td><td>--</td><td>--</td></tr>`;
    }
  }));

  tabela.innerHTML = rows.join('');
}

// Detecta clique em uma linha da tabela
document.addEventListener('click', function (e) {
  const linha = e.target.closest('tr[data-ticker]');
  if (linha) {
    const ticker = linha.dataset.ticker;
    carregarGrafico(ticker, periodoAtual);
  }
});

// Carrega gráfico com base no ticker e período
async function carregarGrafico(ticker, periodo) {
  let funcao = '';
  if (periodo === 'daily') funcao = 'TIME_SERIES_DAILY';
  else if (periodo === 'weekly') funcao = 'TIME_SERIES_WEEKLY';
  else if (periodo === 'monthly') funcao = 'TIME_SERIES_MONTHLY';

  const url = `https://www.alphavantage.co/query?function=${funcao}&symbol=${ticker}&apikey=${API_KEY}`;
  const response = await fetch(url);
  const data = await response.json();

  let timeserie;
  if (periodo === 'daily') timeserie = data['Time Series (Daily)'];
  if (periodo === 'weekly') timeserie = data['Weekly Time Series'];
  if (periodo === 'monthly') timeserie = data['Monthly Time Series'];

  if (!timeserie) {
    alert('Erro ao carregar dados do gráfico.');
    return;
  }

  const labels = Object.keys(timeserie).slice(0, 12).reverse();
  const valores = labels.map(dia => parseFloat(timeserie[dia]['4. close']));

  const ctx = document.getElementById('grafico-preco').getContext('2d');
  if (chart) chart.destroy();

  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels,
      datasets: [{
        label: `Preço de ${ticker} (${periodo})`,
        data: valores,
        borderColor: 'rgba(54, 162, 235, 1)',
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        fill: true,
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      plugins: {
        title: {
          display: true,
          text: `Histórico de ${ticker} - ${periodo.toUpperCase()}`
        }
      }
    }
  });
}

// Muda o período do gráfico
document.getElementById('filtro-periodo').addEventListener('change', function () {
  periodoAtual = this.value;
  const ativoSelecionado = document.querySelector('tr[data-ticker].ativo-selecionado');
  if (ativoSelecionado) {
    const ticker = ativoSelecionado.dataset.ticker;
    carregarGrafico(ticker, periodoAtual);
  }
});
