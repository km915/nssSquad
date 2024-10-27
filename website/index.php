<!DOCTYPE html><html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/329da96191.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign in as</h1>
        <form>
            <div class="btn-field">
                <button type="button" id="adminBtn">Admin</button>
                <button type="button" id="securityBtn" class="disable">Security staff</button>
                <button type="button" id="userBtn" class="disable">user</button>
            </div>
        </form>
    </div>
</div>

<script>
let adminBtn = document.getElementById("adminBtn");
let securityBtn = document.getElementById("securityBtn");
let userBtn = document.getElementById("userBtn");
let nameField = document.getElementById("nameField");
let title = document.getElementById("title");


adminBtn.onclick =function(){
    securityBtn.classList.add("disable");
    userBtn.classList.add("disable");
    adminBtn.classList.remove("disable");
    window.location.href = "login/login_admin.php"; 

}

securityBtn.onclick =function(){
    securityBtn.classList.remove("disable");
    userBtn.classList.add("disable");
    adminBtn.classList.add("disable");
    window.location.href = "login/login_security.php";

}

userBtn.onclick =function(){
    userBtn.classList.remove("disable");
    adminBtn.classList.add("disable");
    securityBtn.classList.add("disable");
    window.location.href = "login/login_user.php"; 
}

</script>


</body>
</html>