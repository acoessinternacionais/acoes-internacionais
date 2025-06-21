
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Ações Internacionais</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; background: #f1f5f9; }
    h1 { color: #0f172a; }
    input, button { padding: 8px; margin: 5px; border-radius: 5px; border: 1px solid #ccc; }
    table { border-collapse: collapse; margin-top: 20px; background: #fff; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    #graficoAtivo { max-width: 600px; margin-top: 20px; }
  </style>
</head>
<body>
  <h1>Esta é a Home do site Ações Internacionais</h1>
  <p>Em breve mais funcionalidades estarão disponíveis aqui.</p>

  <div id="search-panel">
    <input type="text" id="ticker-input" placeholder="Ticker (ex: PETR4)" />
    <button onclick="buscarAtivo()">Pesquisar</button>
  </div>

  <div id="panels"></div>
  <canvas id="graficoAtivo" width="600" height="300"></canvas>

  <script>
    async function buscarAtivo() {
      const ticker = document.getElementById('ticker-input').value.trim().toUpperCase();
      if (!ticker) return alert('Informe um ticker válido');

      const apikey = '9OCLX5BXKL5QSFO8'; // substitua pela sua chave
      const url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=${ticker}&outputsize=compact&apikey=${apikey}`;

      try {
        const res = await fetch(url);
        const data = await res.json();

        if (!data["Time Series (Daily)"]) {
          document.getElementById("panels").innerHTML = "Erro ao buscar dados.";
          return;
        }

        const serie = data["Time Series (Daily)"];
        const datas = Object.keys(serie).slice(0, 5);

        // TABELA
        let htmlTabela = '<table><tr><th>Data</th><th>Abertura</th><th>Fechamento</th></tr>';
        datas.forEach(data => {
          htmlTabela += `<tr>
            <td>${data}</td>
            <td>${parseFloat(serie[data]["1. open"]).toFixed(2)}</td>
            <td>${parseFloat(serie[data]["4. close"]).toFixed(2)}</td>
          </tr>`;
        });
        htmlTabela += '</table>';
        document.getElementById("panels").innerHTML = htmlTabela;

        // GRÁFICO
        const valores = datas.reverse().map(d => parseFloat(serie[d]["4. close"]));
        const labels = datas.reverse();
        new Chart(document.getElementById('graficoAtivo'), {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: `Fechamento ${ticker}`,
              data: valores,
              borderColor: 'blue',
              borderWidth: 2,
              fill: false
            }]
          }
        });
      } catch (e) {
        document.getElementById("panels").innerHTML = "Erro ao carregar dados.";
        console.error(e);
      }
    }
  </script>
</body>
</html>
