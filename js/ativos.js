const API_KEY = 'SUA_API_KEY'; // Substitua pela sua chave real da Alpha Vantage
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
