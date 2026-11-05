const passwordInput = document.getElementById('mail_password');
const togglePassword = document.getElementById('togglePassword');
const eyeIcon = document.getElementById('eyeIcon');

togglePassword.addEventListener('click', function () {

    const isPassword = passwordInput.type === 'password';

    passwordInput.type = isPassword ? 'text' : 'password';

    eyeIcon.classList.toggle('bi-eye', !isPassword);
    eyeIcon.classList.toggle('bi-eye-slash', isPassword);

});