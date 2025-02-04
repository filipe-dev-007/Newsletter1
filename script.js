document.getElementById('subscribeForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = document.getElementById('email').value;

    if (!email || !email.includes('@')) {
        document.getElementById('message').textContent = 'Por favor, insira um email válido.';
        return;
    }

    fetch('subscribe.php', {
        method: 'POST',
        body: new URLSearchParams({ email: email }),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
        .then(response => response.text())
        .then(data => {
            document.getElementById('message').textContent = data;
        })
        .catch(error => {
            document.getElementById('message').textContent = 'Ocorreu um erro. Tente novamente.';
        });
});