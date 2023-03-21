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


/* en cours (Pierre) */
/* const form = document.querySelector('#test');
let output = document.querySelector('#output');
form.addEventListener('submit', (event) => {
  event.preventDefault();
  console.log("test");
history.pushState({}, ' ','?filter=author')

  const selectValue = document.querySelector('#mySelect').value;
  const url = `./index.php?filter=${selectValue}`;

  fetch(url, {
    method: 'GET',
    headers: {
      'Accept': 'application/json'
    },
    responseType: 'json'
  })
    .then(response => {
      console.log(response); // Afficher la réponse dans la console
      return response.json();

    })



}); */




