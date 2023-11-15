<?php

// Include the database connection
$pgsqlConnection = require __DIR__ . "/database.php";

if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$sql = "INSERT INTO users (name, email, password)
        VALUES ($1, $2, $3)";
        
$stmt = pg_prepare($pgsqlConnection, "", $sql);

if (!$stmt) {
    die("SQL error: " . pg_last_error());
}

$result = pg_execute($pgsqlConnection, "", [$_POST["name"], $_POST["email"], $_POST["password"]]);

if ($result) {
    header("Location: signup-success.html");
    exit;
} else {
    $error = pg_last_error($pgsqlConnection);

    if (strpos($error, 'duplicate key') !== false) {
        die("Email already taken");
    } else {
        die($error);
    }
}
