const btnHidePassword = document.querySelector('.hide-password');
const inputPassword = document.querySelector("[name='password']");

btnHidePassword.addEventListener("mousedown", function () {
    btnHidePassword.classList.toggle('hide');
    if(inputPassword.type == 'password') {
        inputPassword.type = 'text';
        return
    } 
    inputPassword.type = 'password';
})
document.querySelector(".change-option").addEventListener("click", () => {
    document.querySelector(".fa-right-to-bracket").classList.toggle("rotate");
    document.querySelector(".form-login").classList.toggle("active");
    document.querySelector(".form-register").classList.toggle("active");
})