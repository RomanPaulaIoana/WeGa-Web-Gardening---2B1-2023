<?php

include 'config.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert_danger'>{$email} - This email address already exists.</div>";
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE name='{$name}'")) > 0) {
        $msg = "<div class='alert_danger'>{$name} - This name is already taken.</div>";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('{$name}', '{$email}', '{$password}')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "<div class='alert_succes'>Registration successful.</div>";
        } else {
            $msg = "<div class='alert_danger'>Something went wrong.</div>";
        }
    }
    
    header("Location: register.html?msg=" . urlencode($msg));
}
?>
