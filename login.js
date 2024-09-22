document.getElementById('showSignup').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.card').style.display = 'none';
    document.getElementById('signupForm').style.display = 'block';
});

document.getElementById('showLogin').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.card').style.display = 'block';
    document.getElementById('signupForm').style.display = 'none';
});

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('Password');
    if (passwordField.type === 'pPassword') {
        passwordField.type = 'text';
        this.innerHTML = '<i class="bi bi-eye-slash"></i>';
    } else {
        passwordField.type = 'Password';
        this.innerHTML = '<i class="bi bi-eye"></i>';
    }
});