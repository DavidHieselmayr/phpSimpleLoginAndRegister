<?php
require("database.php");

if (!empty($_POST['submit'])) {
    $_username = $conn->real_escape_string($_POST["username"]);
    $_passwort = $conn->real_escape_string($_POST["password1"]);
    if (strcmp($_passwort, $conn->real_escape_string($_POST["password2"])) != 0) {
        include("create_user_form.html");
        exit();
    }

    $_passwort = "saver" . $_passwort;

    $insertStatement = "INSERT INTO users (username, password, user_deleted, last_login) VALUES ('$_username', md5('$_passwort'),'0',NOW());";

    if ($_res = $conn->query($insertStatement)) {
        echo "<br>User $_username has been added to the database.<br>Try to log in.";
        include ("login_user_form.html");
    } else {
        echo "<br>NO insertion. User could not be added. Maybe user $_username already exists.";
        include("create_user_form.html");
    }
} else {
    include("create_user_form.html");
}

$conn->close();
?>