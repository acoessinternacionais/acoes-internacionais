document.addEventListener("DOMContentLoaded", () => {
  const empresa = "B3"; // termo mais genérico para garantir retorno
  const url = `https://newsdata.io/api/1/news?apikey=pub_36712bff61e9bcd6b5958a0fe81abbd5fb5b3&q=${empresa}&language=pt`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const container = document.getElementById("noticiasCarrossel");
      container.innerHTML = "";
      const noticias = data.results?.slice(0, 10) || [];

      if (noticias.length === 0) {
        container.innerHTML = "<div class='noticia'>Nenhuma notícia encontrada.</div>";
        return;
      }

      noticias.forEach(n => {
        const item = document.createElement("div");
        item.className = "noticia";
        item.innerHTML = `<a href="${n.link}" target="_blank">${n.title}</a>`;
        container.appendChild(item);
      });
      container.style.animation = "scrollNoticias 60s linear infinite";
    })
    .catch(err => {
      const container = document.getElementById("noticiasCarrossel");
      container.innerHTML = "<div class='noticia'>Erro ao carregar notícias. Exibindo exemplo:</div>";

      const fallback = [
        "Ibovespa opera em alta com avanço das commodities",
        "Mercado aguarda decisão de juros nos EUA",
        "Inflação brasileira desacelera em junho, aponta IBGE",
        "Petrobras anuncia pagamento de dividendos",
        "Setor bancário lidera ganhos na B3"
      ];

      fallback.forEach(titulo => {
        const item = document.createElement("div");
        item.className = "noticia";
        item.innerHTML = `<a href='#'>${titulo}</a>`;
        container.appendChild(item);
      });
    });
});
