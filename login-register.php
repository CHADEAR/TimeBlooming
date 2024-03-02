<?php 

    session_start();
    require_once 'config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
    content="width=device-width,
     initial-scale=1.0">
    <title>Login-Register</title>
    <link rel="stylesheet" href="login-register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="form">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <form action="login_db.php" method="post" id="login" class="input-group">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
                <div class="input-icons">
                    <i class="ri-user-line icon"></i>
                    <input type="text" class="input-field" value="<?php if (isset($_COOKIE['user_login'])) { echo $_COOKIE['user_login'];} ?>" name="username" placeholder="Username" required>
                </div>
                <div class="input-icons">
                    <i class="ri-lock-line icon"></i>
                    <input type="password" class="input-field" value="<?php if (isset($_COOKIE['user_password'])) { echo $_COOKIE['user_password'];} ?>" name="password" placeholder="Enter Password" required>
                </div>
                    <input type="checkbox" class="check-box" name="remember" <?php if(isset($_COOKIE['user_login'])) { ?> checked <?php } ?> >
                    <span>Remember Password</span>
                    <button type="submit" class="submit-btn" name="login">Log IN</button>
            </form>

            <form  action="register_db.php" method="post" id="register" class="input-group">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
                <div class="input-icons">
                    <i class="ri-user-line icon"></i>
                    <input type="text" class="input-field" name="username" placeholder="Username" required>
                </div>
                <div class="input-icons">
                    <i class="ri-mail-line icon"></i>
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                </div>
                <div class="input-icons">
                    <i class="ri-lock-line icon"></i>
                    <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                </div>
                    <button type="submit" class="submit-btn" name="regis">Log In</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var log = document.getElementById("login")
        var reg = document.getElementById("register")
        var buttom = document.getElementById("btn")

        function login(){
            log.style.left = "50px";
            reg.style.left = "450px"
            buttom.style.left = "0"
        }

        function register(){
            log.style.left = "-400px";
            reg.style.left = "50px"
            buttom.style.left = "110px"
        }
    </script>
</body>
</html>