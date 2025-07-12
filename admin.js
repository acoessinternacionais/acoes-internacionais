
function aplicarEstilo() {
  const cor = document.getElementById('corFundo').value;
  const fonte = document.getElementById('fonte').value;
  document.body.style.backgroundColor = cor;
  document.body.style.fontFamily = fonte;
}

const blocos = document.querySelectorAll('.bloco');
blocos.forEach(bloco => {
  bloco.addEventListener('dragstart', e => {
    e.dataTransfer.setData('text/plain', bloco.outerHTML);
    e.target.remove();
  });
});

const container = document.getElementById('blocos-layout');
container.addEventListener('dragover', e => e.preventDefault());
container.addEventListener('drop', e => {
  e.preventDefault();
  const data = e.dataTransfer.getData('text/plain');
  container.insertAdjacentHTML('beforeend', data);
});
