// chat.js
// Módulo de comunicação via chat simples (frontend)

// Espera o carregamento do DOM para iniciar
document.addEventListener("DOMContentLoaded", () => {
  const chatForm = document.getElementById("chat-form");
  const chatInput = document.getElementById("chat-input");
  const chatMensagens = document.getElementById("chat-mensagens");

  if (!chatForm || !chatInput || !chatMensagens) {
    console.warn("Elementos do chat não encontrados.");
    return;
  }

  chatForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const mensagem = chatInput.value.trim();
    if (mensagem === "") return;

    adicionarMensagem("Você", mensagem, "right");

    // Simula resposta automática
    setTimeout(() => {
      adicionarMensagem("Assistente", "Recebido! Em breve responderei.", "left");
    }, 800);

    chatInput.value = "";
  });

  function adicionarMensagem(usuario, texto, lado) {
    const msgDiv = document.createElement("div");
    msgDiv.classList.add("mensagem", lado);
    msgDiv.innerHTML = `<strong>${usuario}:</strong> ${texto}`;
    chatMensagens.appendChild(msgDiv);
    chatMensagens.scrollTop = chatMensagens.scrollHeight;
  }
});
