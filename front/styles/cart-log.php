<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE id_user = '$user_id'") or die('query failed');
    header('location:cart-log.php');
}

if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET Quantity = '$cart_quantity' WHERE id_flower = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link rel="stylesheet" href="styles/style-fav.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
</head>

<body>
  <header class="header">
    <div class="logo-wrapper">
      <a class="logo-a" href="home-logged-user.html"><img class="logo-img" src="styles/resources/logo-image.png" alt="Plant Palooza"></a>
    </div>
    <form action="search.php" method="GET">
      <input class="search-input" type="text" name="search" placeholder="search" />
    </form>

    <div class="side-header">
      <div class="account-div">
        <a class="account-a" href="login-log.php">
          <img class="account-img" src="https://static.thenounproject.com/png/4038155-200.png" alt="account">
        </a>
      </div>
      
      <div class="favorite-a">
        <a href="favorite-log.php">
          <img class="fav-img" src="styles/resources/favorite.png" alt="favorite">
        </a>
      </div>
      <div class="dropdown2">
      <a href="cart-log.php">
        <img class="shopping-cart-img" src="https://icons.veryicon.com/png/o/miscellaneous/jd-app-icon/shopping-cart-296.png" alt="shopping cart">
      </a>
      </div>
    </div>
  </header>
  
  <?php if (!empty($message)): ?>
    <div class="message-container">
      <div class="message-box">
        <div class="message"><?php echo implode(', ', $message); ?></div>
      </div>
    </div>
  <?php endif; ?>

  <div class="menu">
    <a href="home-logged-user.html">H O M E</a>
    <a class="active" href="shop-log.php">S H O P</a>
    <a href="about-log.html">A B O U T</a>
    <a href="help-log.html">H E L P</a>
    <a href="crops.html">C R O P S</a>
    
  </div>

  <section class="shopping-cart">

    <h1 class="title">products added</h1>

    <div class="box-container">

    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
    ?>
    <div class="box">
        <div class="image">
            <img src="<?php echo $fetch_cart['imageURL']; ?>" alt="Flower Image">
        </div>
        <div class="name"><?php echo $fetch_cart['Name']; ?></div>
        <div class="price">$<?php echo $fetch_cart['Price']; ?>/-</div>
        <form action="" method="post">
            <input type="hidden" value="<?php echo $fetch_cart['id_flower']; ?>" name="cart_id">
            <input type="number" min="1" value="<?php echo $fetch_cart['Quantity']; ?>" name="cart_quantity" class="qty">
            <input type="submit" value="update" class="option-btn" name="update_quantity">
        </form>
        <div class="sub-total"> sub-total : <span>$<?php echo $sub_total = ($fetch_cart['Price'] * $fetch_cart['Quantity']); ?>/-</span> </div>
    </div>
    <?php
        $grand_total += $sub_total;
            }
        } else {
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    </div>

    <div class="more-btn">
        <a href="cart-log.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>" onclick="return confirm('delete all from cart?');">delete all</a>
    </div>

    <div class="cart-total">
        <p>grand total : <span>$<?php echo $grand_total; ?>/-</span></p>
        <a href="shop-log.php" class="option-btn">continue shopping</a>
        <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">proceed to checkout</a>
    </div>

  </section>

  <script src="js/script.js"></script>

</body>
</html>
