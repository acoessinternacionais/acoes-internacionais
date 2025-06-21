// Importa e inicializa o Firebase
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

// Enviar mensagem
function enviarMensagem() {
  const input = document.getElementById("mensagem");
  const texto = input.value.trim();
  if (texto === "") return;

  db.collection("chat").add({
    texto,
    timestamp: firebase.firestore.FieldValue.serverTimestamp()
  });
  input.value = "";
}

// Receber mensagens
db.collection("chat").orderBy("timestamp").onSnapshot(snapshot => {
  const painel = document.getElementById("painel-chat");
  painel.innerHTML = "";
  snapshot.forEach(doc => {
    const msg = document.createElement("div");
    msg.textContent = doc.data().texto;
    painel.appendChild(msg);
  });
});
