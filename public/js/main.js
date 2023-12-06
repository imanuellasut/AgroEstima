let open_passwd = document.getElementById("open_passwd");
let password = document.getElementById("password");

open_passwd.onclick = function () {
    if (password.type == "password") {
        password.type = "text";
        open_passwd.src = "svg/icon-pass-hidden.svg";
    } else {
        password.type = "password";
        open_passwd.src = "svg/icon-pass-show.svg";
    }
};

const celarEmail = () => {
    const email = document.getElementById("email");
    email.value = "";
    email.focus();
};
