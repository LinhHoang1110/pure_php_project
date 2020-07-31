var signup_btn = document.getElementById("signup");
var signin_btn = document.getElementById('signin');



signup_btn.addEventListener('click',(e) => {
    var password = document.getElementById("password");
    var re_password = document.getElementById("re_password");
    var username = document.getElementById('username');
    var isnum = /^\d+$/.test(password.value);
    var isAlpha = /^[a-zA-Z]+$/.test(password.value);
    if(username.value === "" || password.value === "" || re_password.value === ""){
        alert("Please fill all blanks!");
        e.preventDefault();
    }
    else {
        if(password.value !== re_password.value) {
            alert("retyped password is not true!");
            e.preventDefault();
        }
        else {
            if(password.value.length < 6) {
                alert("Password too short!!");
                e.preventDefault();
            }
            else {
                if(isnum || isAlpha) {
                    alert("Password should have both of alphabet and number!");
                    e.preventDefault();
                }
                else {
                    alert("Sign up success!!");
                    window.location.href = "login.php";
                    // e.preventDefault();
                }
            }
        }
    }
});

signin_btn.addEventListener('click',() => {
    window.location.href = 'login.php';
})