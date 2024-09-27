document.getElementById('forgotForm').addEventListener('submit', async function (e) {
    e.preventDefault(); // Previne o envio padrão do formulário

    const email = document.getElementById('email').value.trim();

    try {
        const response = await fetch('/backend_php/recover-password.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}`
        });

        const data = await response.text();  // Altere para 'text' para ver a resposta

        console.log(data);  // Verifique a resposta no console para depuração

        if (response.ok) {
            showPopup();
            setTimeout(() => {
                window.location.href = 'login.html'; // Redireciona após 3 segundos
            }, 3000);
        } else {
            alert(data || 'Erro ao recuperar senha.');
        }
    } catch (error) {
        console.error('Erro na requisição de recuperação de senha:', error);
        alert('Erro ao conectar com o servidor.');
    }
});

function showPopup() {
    document.getElementById('popup').classList.add('show');
}

function fecharPopup() {
    document.getElementById('popup').classList.remove('show'); // Fecha o pop-up
}

function toggleMode() {
    const body = document.body;
    const container = document.getElementById('main-container');

    if (document.getElementById('modeToggle').checked) {
        body.classList.add('dark-mode');
        container.classList.add('dark-mode');
    } else {
        body.classList.remove('dark-mode');
        container.classList.remove('dark-mode');
    }

    // Salvar o estado do modo
    localStorage.setItem('darkMode', body.classList.contains('dark-mode'));
}

// Carregar o estado do modo ao iniciar
window.onload = function() {
    const toggle = document.getElementById('modeToggle');
    const darkModeEnabled = localStorage.getItem('darkMode') === 'true';

    toggle.checked = darkModeEnabled;
    if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        document.getElementById('main-container').classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
        document.getElementById('main-container').classList.remove('dark-mode');
    }
};
