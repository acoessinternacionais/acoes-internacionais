
// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDVGf9IPhghtvmqEh9VRjXePY9FWgDDcrA",
  authDomain: "acoes-internacionais.firebaseapp.com",
  projectId: "acoes-internacionais",
  storageBucket: "acoes-internacionais.appspot.com",
  messagingSenderId: "607444026146",
  appId: "1:607444026146:web:692894f168d55ef1c19b7b"
};

firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

function enviarMensagem() {
  const msg = document.getElementById("mensagem").value;
  if (msg.trim()) {
    db.collection("mensagens").add({
      texto: msg,
      timestamp: firebase.firestore.FieldValue.serverTimestamp()
    });
    document.getElementById("mensagem").value = "";
  }
}

db.collection("mensagens").orderBy("timestamp")
  .onSnapshot(snapshot => {
    const painel = document.getElementById("painel-chat");
    painel.innerHTML = "<strong>Mensagens:</strong><br>";
    snapshot.forEach(doc => {
      const data = doc.data();
      if (data.texto) {
        painel.innerHTML += `<div>${data.texto}</div>`;
      }
    });
  });
