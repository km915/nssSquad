<?php
include("database.php");
?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/329da96191.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="form-box">
        <h1 id="title">Sign Up as security</h1>
        <form id="userForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" id="actionField" name="action" value="signup"> <!-- Hidden field for action -->
            <div class="input-group">
                <div class="input-field" id="nameField">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="name" placeholder="Name">
                </div>
                <div class="input-field">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <p>Lost password? <a href="#">Click Here!</a></p>
            </div>
            <div class="btn-field">
                <button type="button" id="signupBtn">Sign up</button>
                <button type="button" id="signinBtn" class="disable">Sign in</button><br>
                <button type="submit" id="submitBtn" style="display:block;">Submit</button> 
            </div>
            
               
            
        </form>
    </div>
</div>

<script>
let signupBtn = document.getElementById("signupBtn");
let signinBtn = document.getElementById("signinBtn");
let nameField = document.getElementById("nameField");
let title = document.getElementById("title");
let actionField = document.getElementById("actionField");
let submitBtn = document.getElementById("submitBtn");

signupBtn.onclick = function() {
    nameField.style.maxHeight = "60px";
    title.innerHTML = "Sign Up as security";
    actionField.value = "signup";
    signupBtn.classList.remove("disable");
    signinBtn.classList.add("disable");
};

signinBtn.onclick = function() {
    nameField.style.maxHeight = "0";
    title.innerHTML = "Sign In as security";
    actionField.value = "signin";
    signupBtn.classList.add("disable");
    signinBtn.classList.remove("disable");
};
</script>

</body>
</html>

<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "<script>alert('Please enter a username.');</script>";
    } elseif (empty($password)) {
        echo "<script>alert('Please enter a password.');</script>";
    } elseif ($_POST['action'] == 'signup' && empty($name)) {
        echo "<script>alert('Please enter your name.');</script>";
    } else {
        if ($_POST['action'] == 'signup') {
            $sql_check = "SELECT * FROM users WHERE username = '$username'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                echo "<script>alert('Username already taken.');</script>";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (name, username, password, user_type) VALUES ('$name', '$username', '$hash', 'security')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('You are now registered!');</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            }
        } elseif ($_POST['action'] == 'signin') {
            $sql = "SELECT * FROM users WHERE username = '$username' AND user_type='security'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);

            if (!$user) {
                echo "<script>alert('Username doesn\'t exist, please sign up first.');</script>";
            } elseif (!password_verify($password, $user['password'])) {
                echo "<script>alert('Password is incorrect.');</script>";
            } else {
                echo "<script>alert('Login successful!');</script>";
                echo "<script>setTimeout(function() { window.location.href = 'homepages/homepage_security.php'; }, 1000);</script>"; // Redirect after 1 second
                exit();
            }
        }
    }
}

mysqli_close($conn);
?>
