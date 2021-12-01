<?php
session_start();

// DB info
$servername = 'localhost';
$username = 'id15304214_projectweek';
$password = '%/[fWDDH4W25$i\Q';
$dbname = 'id15304214_users';
// Connecting DB
$conn = new mysqli($servername, $username, $password, $dbname);
// check conn
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

// if post is set
if (isset($_POST['submit']))
{
    // setting values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $secPassword = $_POST['secPassword'];
    // check if pass is the same
    if ($password == $secPassword)
    {
        $sql = "INSERT INTO users (username, password, email)VALUES ('$username', '$password', '$email');";
        // check if all goes right
        if ($conn->query($sql) === true)
        {
            header("Location: https://webdevelopmentlj1.000webhostapp.com/login.php");
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        echo "wrong stuff dude";
    }

    $conn->close();
}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <div class="login">
            <h1>Login</h1>
            <form method="POST">
                <label for="username">
                <i class="fas fa-user"></i>
                </label>
                <input type="text" name="username" placeholder="Username" id="username" required>
                <label for="email">
                <i class="fas fa-user"></i>
                </label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <label for="password">
                <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <label for="secPassword">
                <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="secPassword" placeholder="Repeat password" id="secPassword" required>
                <input type="submit" value="Register" name="submit">
            </form>
        </div>
    </body>
</html>