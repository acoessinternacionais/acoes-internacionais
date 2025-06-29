document.addEventListener("DOMContentLoaded", () => {
  const empresa = "B3";
  const container = document.getElementById("noticiasCarrossel");

  const mostrarFallback = () => {
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
  };

  const tentarGNews = () => {
    const gnewsUrl = `https://gnews.io/api/v4/search?q=${empresa}&lang=pt&token=dd8c1acf382c673a54b4e680ac57f8c2`;
    fetch(gnewsUrl)
      .then(res => res.json())
      .then(data => {
        const noticias = data.articles?.slice(0, 10) || [];
        if (noticias.length === 0) return mostrarFallback();
        container.innerHTML = "";
        noticias.forEach(n => {
          const item = document.createElement("div");
          item.className = "noticia";
          item.innerHTML = `<a href="${n.url}" target="_blank">${n.title}</a>`;
          container.appendChild(item);
        });
        container.style.animation = "scrollNoticias 60s linear infinite";
      })
      .catch(() => mostrarFallback());
  };

  const tentarNewsData = () => {
    const url = `https://newsdata.io/api/1/news?apikey=pub_36712bff61e9bcd6b5958a0fe81abbd5fb5b3&q=${empresa}&language=pt`;
    fetch(url)
      .then(res => res.json())
      .then(data => {
        const noticias = data.results?.slice(0, 10) || [];
        if (noticias.length === 0) return tentarGNews();
        container.innerHTML = "";
        noticias.forEach(n => {
          const item = document.createElement("div");
          item.className = "noticia";
          item.innerHTML = `<a href="${n.link}" target="_blank">${n.title}</a>`;
          container.appendChild(item);
        });
        container.style.animation = "scrollNoticias 60s linear infinite";
      })
      .catch(() => tentarGNews());
  };

  tentarNewsData();
});
