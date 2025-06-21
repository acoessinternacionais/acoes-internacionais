<!DOCTYPE html>
<html lang="pt-BR">
<body>
<h1>Esta é a Home do site Ações Internacionais</h1>
<p>Em breve mais funcionalidades estarão disponíveis aqui.</p>

<!-- Painel de pesquisa de ativos -->
<div id="search-panel">
  <input type="text" id="ticker-input" placeholder="Ticker (ex: PETR4)" />
  <button onclick="buscarAtivo()">Pesquisar</button>
</div>

<div id="panels"></div>

<!-- Chat -->
<div id="painel-chat" style="border:1px solid #ccc; height:200px; overflow-y:auto; margin-top:30px; padding:10px; background:#fff;">
  <strong>Mensagens:</strong>
</div>
<input id="mensagem" type="text" placeholder="Digite sua mensagem..." style="width:70%; padding:5px;" />
<button onclick="enviarMensagem()" style="padding:5px 10px;">Enviar</button>

<!-- Scripts necessários -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore-compat.js"></script>
<script src="chat.js"></script>

<style>
  #panels { display: flex; flex-wrap: wrap; gap: 20px; margin-top: 15px; }
  .ativo-panel {
    border: 1px solid #ccc;
    padding: 10px;
    width: 300px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
</style>

<script>
async function buscarAtivo() {
  const ticker = document.getElementById('ticker-input').value.trim().toUpperCase();
  if (!ticker) return alert('Informe um ticker válido');
  const apikey = '9OCLX5BXKLSQ5T0';
  const url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=${ticker}&outputsize=compact&apikey=${apikey}`;

  try {
    const res = await fetch(url);
    const data = await res.json();
    console.log(data);
    // Aqui você pode adicionar exibição dos dados no painel
  } catch (error) {
    console.error('Erro ao buscar ativo:', error);
  }
}
</script>
</body>
</html>
