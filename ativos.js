const API_KEY = 'SUA_API_KEY'; // Substitua pela sua chave da Alpha Vantage

const acoes = ['PETR4.SA', 'VALE3.SA'];
const fiis = ['HGLG11.SA', 'MXRF11.SA'];
const etfs = ['BOVA11.SA', 'IVVB11.SA'];

let chart;
let periodoAtual = 'daily';

setInterval(() => {
  carregarTabela('acoes', acoes);
  carregarTabela('fiis', fiis);
  carregarTabela('etfs', etfs);
}, 60000);

carregarTabela('acoes', acoes);
carregarTabela('fiis', fiis);
carregarTabela('etfs', etfs);

async function carregarTabela(tipo, lista) {
  const tabela = document.getElementById(`tabela-${tipo}`);
  tabela.innerHTML = '<tr><td colspan="5">Carregando...</td></tr>';

  const linhas = await Promise.all(lista.map(async ticker => {
    try {
      const url = `https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${ticker}&apikey=${API_KEY}`;
      const res = await fetch(url);
      const data = await res.json();
      const q = data['Global Quote'];

      if (!q || !q['05. price']) return `<tr><td>${ticker}</td><td>-</td><td>Erro</td><td>--</td><td>--</td></tr>`;

      const preco = parseFloat(q['05. price']).toFixed(2);
      const variacao = parseFloat(q['09. change']).toFixed(2);
      const pct = q['10. change percent'];

      return `<tr data-ticker="${ticker}">
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

  tabela.innerHTML = linhas.join('');
}

document.addEventListener('click', function (e) {
  const linha = e.target.closest('tr[data-ticker]');
  if (linha) {
    const ticker = linha.dataset.ticker;
    document.querySelectorAll('tr[data-ticker]').forEach(r => r.classList.remove('ativo-selecionado'));
    linha.classList.add('ativo-selecionado');
    carregarGrafico(ticker, periodoAtual);
  }
});

async function carregarGrafico(ticker, periodo) {
  let funcao = periodo === 'weekly' ? 'TIME_SERIES_WEEKLY' :
               periodo === 'monthly' ? 'TIME_SERIES_MONTHLY' : 'TIME_SERIES_DAILY';

  const url = `https://www.alphavantage.co/query?function=${funcao}&symbol=${ticker}&apikey=${API_KEY}`;
  const res = await fetch(url);
  const data = await res.json();
  const serie = data['Time Series (Daily)'] || data['Weekly Time Series'] || data['Monthly Time Series'];

  if (!serie) return alert('Erro ao carregar gráfico');

  const labels = Object.keys(serie).slice(0, 12).reverse();
  const valores = labels.map(k => parseFloat(serie[k]['4. close']));

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
    }
  });
}

document.getElementById('filtro-periodo').addEventListener('change', function () {
  periodoAtual = this.value;
  const ativo = document.querySelector('tr[data-ticker].ativo-selecionado');
  if (ativo) carregarGrafico(ativo.dataset.ticker, periodoAtual);
});

function mudarAba(id) {
  document.querySelectorAll('.aba').forEach(a => a.classList.remove('ativa'));
  document.getElementById(id).classList.add('ativa');
}