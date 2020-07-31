var signup_btn = document.getElementById("signup_btn");
var username = document.getElementById('username');
var password = document.getElementById('password');
var signin_btn = document.getElementById('signin');


signup_btn.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = "signup.php";
});


signin_btn.addEventListener('click', (e) => {
    if(username.value === '' || password.value === '') {
        alert('Please fill all blanks!');
        e.preventDefault();
    }
})


