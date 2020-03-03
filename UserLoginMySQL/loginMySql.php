<?php
require("database.php");
if (!empty($_POST['submit'])) {
    session_start();
    $_username = $conn->real_escape_string($_POST["username"]);
    $_passwort = $conn->real_escape_string($_POST["password1"]);


    $_passwort = "saver" . $_passwort;
    $_sql = "select * from users where username='$_username' AND password =md5('$_passwort') AND user_deleted=0 LIMIT 1";

    if ($_res = $conn->query($_sql)) {
        if ($_res->num_rows > 0) {
            echo "Login war erfolgreich!<br>";

            $_SESSION['login'] = 1;
            $_SESSION['user'] = $_res->fetch_assoc();
            $_sql = "UPDATE users SET last_login=NOW() where id=" . $_SESSION['user']['id'];
            $conn->query($_sql);
        } else {
            echo "Die Logindaten sind nicht korrekt.<br>";
            include("login_user_form.html");
            exit();
        }
        $_res->close();

    }
    $conn->close();

    if ($_SESSION['login'] != 1) {
        include("login_user_form.html");
        exit();
    }
    echo "<br>User" . $_SESSION['user']['username'] . " is logged in since " . $_SESSION['user']['last_login'] . ".<br>";
}
?>