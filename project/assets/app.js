// Get the registration form
const registerForm = document.getElementById('registerForm');

registerForm.addEventListener('submit', function(e) {
  const email = document.querySelector('[data-test="register-email"]').value.trim();
  const password = document.querySelector('[data-test="register-password"]').value;
  const confirm = document.querySelector('[data-test="register-passwordConfirm"]').value;

  const error = validateRegistration(email, password, confirm);
  if (error) {
    e.preventDefault(); // stop form submission
    alert(error); // simple alert, can be replaced with inline message
  }
});

function validateRegistration(email, password, confirm) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!email) return 'Email address is required';
  if (!emailRegex.test(email)) return 'Please provide a valid e-mail address';
  if (password !== confirm) return 'This field value must be the same as "Password".';
  if (password.length < 8) return 'Password must be at least 8 characters';
  if (!/[A-Za-z]/.test(password) || !/\d/.test(password)) {
    return 'Password must contain both letters and numbers';
  }

  return '';
}
