document.addEventListener('DOMContentLoaded', function() {
    function isLoggedIn() {
        return sessionStorage.getItem('loggedIn') === 'true';
    }

    function login(username, password) {
        if (username === 'user' && password === 'password') {
            sessionStorage.setItem('loggedIn', 'true');
            alert('Login successful!');
            window.location.href = 'home.html'; 
        } else {
            alert('Invalid credentials. Please try again.');
        }
    }

    window.addEventListener('beforeunload', function(event) {
        if (!isLoggedIn()) {
            event.preventDefault();
            event.returnValue = '';
        }
    });

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        login(username, password);
    });
});