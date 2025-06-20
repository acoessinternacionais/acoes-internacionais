<h1>Esta é a Home do site Ações Internacionais</h1>
<p>Em breve mais funcionalidades estarão disponíveis aqui.</p>

<!-- Painel de pesquisa de ativos -->
<div id="search-panel">
  <input type="text" id="ticker-input" placeholder="Ticker (ex: PETR4)" />
  <button onclick="buscarAtivo()">Pesquisar</button>
</div>

<div id="panels"></div>

<!-- Scripts e estilos necessários -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  #panels { display: flex; flex-wrap: wrap; gap: 20px; margin-top:15px; }
  .ativo-panel { border:1px solid #ccc; padding:10px; width:300px; background:#fff; box-shadow:0 2px 5px rgba(0,0,0,0.1); }
</style>

<script>
async function buscarAtivo() {
  const ticker = document.getElementById('ticker-input').value.trim().toUpperCase();
  if (!ticker) return alert('Informe um ticker válido');
  const apikey = 'SUA_API_KEY';
  const url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=${ticker}&outputsize=compact&apikey=${apikey}`;

  try {
    const res = await fetch(url);
    const data = await res.json();
    const ts = data['Time Series (Daily)'];
    if (!ts) return alert('Ativo não encontrado');
    const dates = Object.keys(ts).slice(0,30).reverse();
    const prices = dates.map(d => +ts[d]['4. close']);
    const panel = document.createElement('div');
    panel.className = 'ativo-panel';
    panel.innerHTML = `<h3>${ticker}</h3><canvas id="chart-${ticker}" height="100"></canvas>`;
    document.getElementById('panels').append(panel);

    new Chart(panel.querySelector(`#chart-${ticker}`), {
      type: 'line',
      data: { labels: dates, datasets: [{ label:'Fechamento (R$)', data: prices, borderColor:'#0077cc', fill:false }] },
      options: { responsive:true }
    });
    document.getElementById('ticker-input').value = '';
  } catch (err) {
    alert('Erro ao buscar dados: ' + err.message);
  }
}
</script>
