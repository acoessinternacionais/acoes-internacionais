// ativos.js
// Responsável por buscar e exibir dados de ações no painel

document.addEventListener("DOMContentLoaded", function () {
  const ativos = [
    { ticker: "AAPL", preco: 212.41, variacao: 1.27, percentual: 0.6015 },
    { ticker: "MSFT", preco: 501.48, variacao: -2.03, percentual: -0.4032 },
    { ticker: "GOOGL", preco: 177.62, variacao: 1.0, percentual: 0.5662 },
    { ticker: "AMZN", preco: 222.26, variacao: -0.28, percentual: -0.1258 },
    { ticker: "PETR4.SA", preco: 32.24, variacao: -0.28, percentual: -0.8610 },
    { ticker: "VALE3.SA", preco: 55.28, variacao: 0.70, percentual: 1.2825 }
  ];

  const tabela = document.getElementById("tabela-ativos");

  ativos.forEach(ativo => {
    const linha = document.createElement("tr");

    const celTicker = document.createElement("td");
    celTicker.textContent = ativo.ticker;

    const celPreco = document.createElement("td");
    celPreco.textContent = `R$ ${ativo.preco.toFixed(2)}`;

    const celSeta = document.createElement("td");
    celSeta.innerHTML = getSetaHTML(ativo.variacao);

    const celVariacao = document.createElement("td");
    celVariacao.textContent = `${ativo.variacao.toFixed(2)} (${ativo.percentual.toFixed(4)}%)`;
    celVariacao.style.color = ativo.variacao >= 0 ? "green" : "red";

    linha.appendChild(celTicker);
    linha.appendChild(celPreco);
    linha.appendChild(celSeta);
    linha.appendChild(celVariacao);

    tabela.appendChild(linha);
  });

  function getSetaHTML(valor) {
    if (valor > 0) {
      return `<span style="color: green;">▲</span>`;
    } else if (valor < 0) {
      return `<span style="color: red;">▼</span>`;
    } else {
      return `--`;
    }
  }
});
