// noticias.js

const noticiasAPI = 'https://api.allorigins.win/get?url=' + encodeURIComponent('https://g1.globo.com/rss/g1/');
const container = document.getElementById('noticias-container');

let noticiasCache = [];

function exibirNoticias(noticias) {
  container.innerHTML = '';
  noticias.slice(0, 5).forEach(noticia => {
    const div = document.createElement('div');
    div.className = 'noticia';
    div.innerHTML = `
      <img src="${noticia.imagem}" alt="Imagem da notícia" class="noticia-imagem" />
      <div class="noticia-conteudo">
        <a href="${noticia.link}" target="_blank" class="noticia-titulo">${noticia.titulo}</a>
      </div>
    `;
    container.appendChild(div);
  });
}

function parseRSStoJSON(xmlString) {
  const parser = new DOMParser();
  const xml = parser.parseFromString(xmlString, 'text/xml');
  const items = xml.querySelectorAll('item');
  const noticias = [];

  items.forEach(item => {
    const titulo = item.querySelector('title')?.textContent || '';
    const link = item.querySelector('link')?.textContent || '';
    const descricao = item.querySelector('description')?.textContent || '';

    // Tenta extrair a imagem da descrição
    const imgMatch = descricao.match(/<img.*?src="(.*?)"/);
    const imagem = imgMatch ? imgMatch[1] : 'https://via.placeholder.com/100x60?text=Notícia';

    noticias.push({ titulo, link, imagem });
  });

  return noticias;
}

async function carregarNoticias() {
  try {
    const resposta = await fetch(noticiasAPI);
    const data = await resposta.json();

    const noticias = parseRSStoJSON(data.contents);
    noticiasCache = noticias;
    exibirNoticias(noticias);
  } catch (erro) {
    // Em caso de erro, usa cache
    if (noticiasCache.length > 0) {
      exibirNoticias(noticiasCache);
    }
  }
}

// Atualiza a cada 5 minutos
carregarNoticias();
setInterval(carregarNoticias, 5 * 60 * 1000);
