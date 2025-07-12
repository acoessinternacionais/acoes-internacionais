// js/ativos.js (Tabela de Ações com atualização em tempo real)

const acoes = ["PETR4.SA", "VALE3.SA", "ITUB4.SA"];
const tabelaAcoes = document.getElementById("acoes-table");
const ctxAcoes = document.getElementById("acoes-chart").getContext("2d");

async function buscarPrecoAcao(simbolo) {
  try {
    const res = await fetch(`https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=${simbolo}&interval=5min&apikey=SUA_API_KEY`);
    const dados = await res.json();
    const serie = dados["Time Series (3sec)"];
    if (!serie) throw new Error("Sem dados");
    const tempos = Object.keys(serie).sort().slice(-12);
    const precos = tempos.map(t => parseFloat(serie[t]["1. open"]));
    const atual = precos[precos.length - 1];

    return { simbolo, tempos, precos, atual };
  } catch (erro) {
    console.error("Erro ao buscar:", simbolo, erro);
    return { simbolo, tempos: [], precos: [], atual: "Erro" };
  }
}

async function atualizarTabelaAcoes() {
  tabelaAcoes.innerHTML = "<table><tr><th>Ativo</th><th>Preço</th></tr></table>";
  const table = tabelaAcoes.querySelector("table");

  for (const simbolo of acoes) {
    const { simbolo: nome, atual } = await buscarPrecoAcao(simbolo);
    const linha = document.createElement("tr");
    linha.innerHTML = `<td>${nome}</td><td>R$ ${atual}</td>`;
    table.appendChild(linha);
  }
}

async function atualizarGraficoAcoes() {
  const datasets = [];
  let labels = [];

  for (const simbolo of acoes) {
    const { tempos, precos } = await buscarPrecoAcao(simbolo);
    if (tempos.length > 0 && labels.length === 0) labels = tempos;
    datasets.push({
      label: simbolo,
      data: precos,
      fill: false,
      borderColor: '#' + Math.floor(Math.random()*16777215).toString(16),
      tension: 0.1
    });
  }

  new Chart(ctxAcoes, {
    type: 'line',
    data: { labels, datasets },
    options: { responsive: true, plugins: { legend: { position: 'top' } } }
  });
}

// Iniciar atualização
atualizarTabelaAcoes();
atualizarGraficoAcoes();
setInterval(() => {
  atualizarTabelaAcoes();
  atualizarGraficoAcoes();
}, 1000); // 3 secunds
