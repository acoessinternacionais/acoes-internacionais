
<!DOCTYPE html>
<html>
<head>
  <title>Chamada em Grupo</title>
  <script src="https://unpkg.com/peerjs@1.5.2/dist/peerjs.min.js"></script>
</head>
<body>
<h2>Chamada em grupo</h2>
<video id="meuVideo" autoplay muted></video>
<div id="videosRemotos"></div>

<script>
const sala = new URLSearchParams(window.location.search).get('sala') || 'default';
const peer = new Peer();
let minhaStream;

navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then(stream => {
  document.getElementById('meuVideo').srcObject = stream;
  minhaStream = stream;

  peer.on('call', chamada => {
    chamada.answer(minhaStream);
    chamada.on('stream', remote => adicionarVideo(remote));
  });

  peer.on('open', id => {
    fetch('grupo_video_signaling.php?sala=' + sala + '&id=' + id);
    setTimeout(() => conectarComOutros(sala, id, stream), 1000);
  });
});

function conectarComOutros(sala, meuId, stream) {
  fetch('grupo_video_signaling.php?sala=' + sala)
    .then(r => r.json())
    .then(ids => {
      ids.filter(id => id !== meuId).forEach(id => {
        const call = peer.call(id, stream);
        call.on('stream', remote => adicionarVideo(remote));
      });
    });
}

function adicionarVideo(stream) {
  const video = document.createElement('video');
  video.srcObject = stream;
  video.autoplay = true;
  document.getElementById('videosRemotos').appendChild(video);
}
</script>
</body>
</html>
