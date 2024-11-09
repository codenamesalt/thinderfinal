document.addEventListener("DOMContentLoaded", () => {
    const signUpForm = document.getElementById("signup-form");
    const signUpButton = document.getElementById("signup-form-submit");
  
    signUpButton.addEventListener("click", (e) => {
      e.preventDefault();
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      const phone = document.getElementById("phone").value;
      const city = document.getElementById("city").value;
      const state = document.getElementById("state").value;
      const problems = document.getElementById("problems").value;
      const traits = document.getElementById("traits").value;
  
      // Clear the input fields
      document.getElementById("email").value = '';
      document.getElementById("password").value = '';
      document.getElementById("phone").value = '';
      document.getElementById("city").value = '';
      document.getElementById("state").value = '';
      document.getElementById("problems").value = '';
      document.getElementById("traits").value = '';

      alert("email: " + email);
      alert("password: " + password);
      alert("phone: " + phone);
      alert("city: " + city);
      alert("state: " + state);
      alert("problems: " + problems);
      alert("traits: " + traits);
    });
  });
  