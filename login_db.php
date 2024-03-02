<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

      
        if (empty($username)) {
            $_SESSION['error'] = 'กรุณากรอก username';
            header("location: login-register.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: login-register.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: login-register.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE username = :username");
                $check_data->bindParam(":username", $username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($username == $row['username']) {
                        if (password_verify($password, $row['password'])) {
                            $_SESSION['user_login'] = $row['id'];
                            if(!empty($_POST['remember'])){
                                setcookie('user_login',$_POST['username']);
                                setcookie('user_password',$_POST['password']);
                            } else {
                                if (isset($_COOKIE['user_login'])){
                                    setcookie('user_login','');

                                    if(isset($_COOKIE['user_login']))
                                        setcookie('user_password','');
                                }
                            }
                            header("location: index.php");
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: login-register.php");
                        }
                    } else {
                        $_SESSION['error'] = 'username ผิด';
                        header("location: login-register.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: login-register.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>