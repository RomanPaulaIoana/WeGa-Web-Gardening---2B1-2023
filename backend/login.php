<?php
   

    include 'config.php';
    $msg = "";

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: welcome.php");
                die();
            }
        } else {
            $msg = "<div class='alert_danger'>Email or password do not match.</div>";
        }
        header("Location: login.html?msg=" . urlencode($msg));
    }
?>