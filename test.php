<?php
    require_once "config/db.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
    content="width=device-width,
     initial-scale=1.0">
    <title>Login-Register</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" rel="stylesheet">
</head>
<body>
<form  action="signup_db.php" method="post" id="register" class="input-group">
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

            </body>
</html>