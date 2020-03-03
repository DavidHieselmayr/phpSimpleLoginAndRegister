<?php
// mySQL database information
require("database.php");

if (!empty($_POST['submit'])) {
    $_username = $conn->real_escape_string($_POST["username"]);
    $_passwort = $conn->real_escape_string($_POST["password1"]);
    if (strcmp($_passwort, $conn->real_escape_string($_POST["password2"])) != 0) {
        // password is not repeated correctly
        include("create_user_form.html");
        exit();
    }

    // add to the users passwort some text to make it more secure
    // this must also be done in the login program
    $_passwort = "saver" . $_passwort;

    // Statement for insert the values of the new user
    // Using md5 from mySQL, because we do not want to save the password in plain text.
    $insertStatement = "INSERT INTO login_username (username, password, user_deleted, last_login) 
                            VALUES ('$_username', md5('$_passwort'),0,NOW());";

    if ($_res = $conn->query($insertStatement)) {
        echo "<br>User $_username has been added to the database.<br>Try to log in.";
        include ("create_user_form.html");
    } else {
        echo "<br>NO insertion. User could not be added. Maybe user $_username already exists.";
        include("create_user_form.html");
    }
} else {
    include("create_user_form.html");
}

// clsoe database
require("closeDatabase.php");
?>