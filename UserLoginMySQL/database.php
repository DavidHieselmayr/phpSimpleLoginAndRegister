<?php
$_db_host = "localhost";
$_db_datenbank = "web";
$_db_username = "root";
$_db_passwort = "";

SESSION_START();

// open database connection
$conn = new mysqli($_db_host, $_db_username, $_db_passwort, $_db_datenbank);

// check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>