<?php
include 'config.php';

$message = "";

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

        if (!empty($email)) {
    
            $email = trim($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subscribers WHERE email='{$email}'")) > 0) {
                $message = "<div class='alert_danger'>{$email} - This email address already exists.</div>";
            } else {
                    
                    $sql_insert = "INSERT INTO subscribers (email) VALUES ('$email')";
                    $result_insert = mysqli_query($conn, $sql_insert);

                    if ($result_insert) {
                        $message = "<div class='alert_succes'>Your email address has been successfully registred!</div>";
                       
                    } else {
                        $message = "<div class='alert_danger'>Something went wrong!</div>";
                    }
                }
            } else {
                $message = "<div class='alert_danger'>The email address you entered is invalid!</div>";
            }
        } else{ $message = "<div class='alert_danger'>Please enter another email address!</div>";
              }
    

              header("Location: about.html?message=" . urlencode($message)); exit;
}
?>