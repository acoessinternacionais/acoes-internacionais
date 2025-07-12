// js/ativos.js

const apiKey = "af60372cadbd471c966a1fe20a74de94";
const symbols = {
  "acoes": ["PETR4", "ITUB4", "VALE3", "BBDC4",
            "ABEV3", "BBAS3", "WEGE3", "B3SA3",
            "ITSA4", "SUZB3", "ELET3", "PRIO3",
            "RENT3", "BPAC11", "RDOR3", "LREN3",
            "KLBN11", "FLRY3", "MGLU3", "RADL3",
            "ENBR3", "CSAN3", "RAIL3", "CMIG4",
            "EQTL3", "HAPV3", "COGN3", "GOAU4",
            "GGBR4", "SBSP3"],
  "dividendos": ["T", "VZ"],
  "etfs": ["SPY", "IVV"],
  "fiis": ["HGLG11.SA", "KNRI11.SA"]
};

async function fetchData(symbol) {
  try {
    const res = await fetch(
      `https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=${symbol}&interval=5min&apikey=${apiKey}`
    );
    const data = await res.json();
    const meta = data["Meta Data"];
    const lastRefreshed = meta && meta["3. Last Refreshed"];
    const series = data["Time Series (3sec)"];
    const latest = series && series[lastRefreshed];

    return {
      symbol,
      price: latest ? parseFloat(latest["1. open"]).toFixed(2) : "-",
      timestamp: lastRefreshed || ""
    };
  } catch (err) {
    console.error("Erro ao buscar dados para", symbol, err);
    return { symbol, price: "Erro", timestamp: "" };
  }
}

async function atualizarTabela(tipo) {
  const container = document.getElementById(`tabela-${tipo}`);
  container.innerHTML = "<tr><th>Ativo</th><th>Preço</th><th>Atualizado</th></tr>";

  for (const s of symbols[tipo]) {
    const dados = await fetchData(s);
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${dados.symbol}</td>
      <td>R$ ${dados.price}</td>
      <td>${dados.timestamp}</td>
    `;
    container.appendChild(tr);
  }
}

function atualizarTudo() {
  atualizarTabela("acoes");
  atualizarTabela("dividendos");
  atualizarTabela("etfs");
  atualizarTabela("fiis");
}

// Atualiza a cada 3 segundos
atualizarTudo();
setInterval(atualizarTudo, 3 * 1000);
