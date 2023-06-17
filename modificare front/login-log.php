<?php

include 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = 1; 
$sql = "SELECT name, email FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["name"];
    $email = $row["email"]; 
} else {
    $username = "N/A";
    $email = "N/A"; 
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
<link rel="stylesheet" href="styles/styles-login-log.css">


</head>

<body>
  <header class="header">
    <div class="logo-wrapper">
      <a class="logo-a" href="home-logged-user.html"><img class="logo-img" src="styles/resources/logo-image.png" alt="Plant Palooza"></a>
    </div>
    <input class="search-input" type="text" placeholder="search" />

    <div class="side-header">
      <div class="account-div">
        <a class="account-a" href="login-log.php">
          <img class="account-img" src="https://static.thenounproject.com/png/4038155-200.png" alt="account">
        </a>
      </div>
      
      <div class="favorite-a">
        <a href="favorite-log.html">
          <img class="fav-img" src="styles/resources/favorite.png" alt="favorite">
        </a>
      </div>
      <div class="dropdown2">
        <a href="cart-log.html">
        <img class="shopping-cart-img"
          src="https://icons.veryicon.com/png/o/miscellaneous/jd-app-icon/shopping-cart-296.png"
          alt="shopping cart">
        </a>
      </div>
    </div>
  </header>
  <div class="menu">
    <a href="home-logged-user.html">H O M E</a>
    <a href="shop-log.html">S H O P</a>
    <a href="about-log.html">A B O U T</a>
    <a href="help-log.html">H E L P</a>
    <a href=https://www.google.com>C R O P S</a>
  </div>
 
  <div class="heading">
    <h3><strong>YOUR ACCOUNT</strong></h3>
  </div>
<div class="container">
  <div class="box_info">
    <h3 class="text">You are logged as :   <?php echo $username; ?></h3>
    <h3 class="text">Your email is : <?php echo $email; ?></h3>
    <a href="logout.php" class="option-btn">LOG OUT</a>
    <a class="option-btn" >EDIT</a>

       <div class="img">
         <img src="styles/resources/woman-hand-holding-peony-roses.jpg" alt="">
       </div>
  </div>
</div>
  
  
  
 
</body>

</html>

