// Função para mostrar notificação
function showToast(message, isSuccess = true) {
    const toast = document.getElementById("toast");
    toast.className = "toast " + (isSuccess ? "success" : "error");
    toast.innerText = message;
    toast.classList.add("show");
    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}

// Redirecionamento ao clicar nos botões
document.getElementById('btnColeta').addEventListener('click', () => {
    window.location.href = 'map.html';  // Redireciona para map.html ao clicar em "COMEÇAR COLETA"
});

document.getElementById('btnEntrega').addEventListener('click', () => {
    window.location.href = 'map.html';  // Redireciona para map.html ao clicar em "COMEÇAR ENTREGA"
});

// Função de alternância do modo escuro
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}
