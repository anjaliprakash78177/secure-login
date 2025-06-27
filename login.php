<?php
session_start();

$conn = new mysqli("localhost", "root", "", "login_demo");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_captcha = $_POST['captcha_input'];

    if ($user_captcha != $_SESSION["captcha"]) {
        echo " Worng Captcha!";
        exit();
    }

    $res = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $row = $res->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid Credentials";
    }
}
?>
