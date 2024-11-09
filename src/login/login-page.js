
const loginForm = document.getElementById("login-form");
const loginButton = document.getElementById("login-form-submit");

loginButton.addEventListener("click", (e) => {
    e.preventDefault();
    const email = loginForm.email.value;
    const password = loginForm.password.value;

    console.log("test");
    alert("email: " + email);
    alert("password: " +password);
})