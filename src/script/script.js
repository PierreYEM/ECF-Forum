passwordInput = document.querySelector("#password"),
  passwordConfirm = document.querySelector("#passwordConfirm"),
  btnShowPassword = document.querySelector(".fa-eye-slash"),
  btnShowPasswordConfirm = document.querySelector(".confirm");


btnShowPassword.addEventListener("click", () => {
  passwordInput.setAttribute("type", passwordInput.type === "password" ? "text" : "password");
  btnShowPassword.classList.toggle("fa-eye");
});

btnShowPasswordConfirm.addEventListener("click", () => {
  passwordConfirm.setAttribute("type", passwordConfirm.type === "password" ? "text" : "password");
  btnShowPasswordConfirm.classList.toggle("fa-eye");
});






