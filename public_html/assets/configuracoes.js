document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggle-theme');
    const body = document.body;

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        toggleButton.textContent = body.classList.contains('light-mode') ? 'Modo Escuro' : 'Modo Claro';
    });

    // Fetch para buscar dados do usuário
    fetch('https://nights-like-this-435616.rj.r.appspot.com/jduber/api/user/me', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('name').value = data.name;
        document.getElementById('email').value = data.email;
    })
    .catch(error => console.error('Erro ao buscar dados do usuário:', error));

    // Atualização dos dados
    document.getElementById('configForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();

        fetch('https://nights-like-this-435616.rj.r.appspot.com/jduber/api/user/update', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify({ name, email })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Dados atualizados com sucesso!');
            } else {
                alert('Erro ao atualizar os dados.');
            }
        })
        .catch(error => console.error('Erro ao atualizar os dados:', error));
    });

    // Logout
    document.getElementById('logoutBtn').addEventListener('click', function() {
        localStorage.removeItem('token');
        window.location.href = 'index.html';
    });
});
