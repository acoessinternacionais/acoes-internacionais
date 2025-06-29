
document.addEventListener("DOMContentLoaded", () => {
  const empresa = "Petrobras";
  const url = `https://newsdata.io/api/1/news?apikey=pub_36712bff61e9bcd6b5958a0fe81abbd5fb5b3&q=Petrobras&language=pt`;

  fetch(url)
    .then(response => response.json())
    .then(data => {
      const container = document.getElementById("noticiasCarrossel");
      container.innerHTML = "";

      const noticias = data.results?.slice(0, 10) || [];
      noticias.forEach(n => {
        const item = document.createElement("div");
        item.className = "noticia";
        item.innerHTML = `<a href="${n.link}" target="_blank">${n.title}</a>`;
        container.appendChild(item);
      });

      container.style.animation = "scrollNoticias 60s linear infinite";
    })
    .catch(err => {
      document.getElementById("noticiasCarrossel").innerHTML = "<div class='noticia'>Erro ao carregar notícias</div>";
    });
});
