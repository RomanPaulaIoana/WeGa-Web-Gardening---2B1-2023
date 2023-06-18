<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE Name = '$product_name' AND id_user = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'already added to cart';
    }else{

        $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `favorites` WHERE Name = '$product_name' AND ID_user = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_wishlist_numbers) > 0){
            mysqli_query($conn, "DELETE FROM `favorites` WHERE Name = '$product_name' AND ID_user = '$user_id'") or die('query failed');
        }

        mysqli_query($conn, "INSERT INTO `cart`(id_user, id_flower, Name, Price, Quantity, imageURL) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart';
    }

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `favorites` WHERE ID_flower = '$delete_id'") or die('query failed');
    header('location:favorite-log.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `favorites` WHERE ID_user = '$user_id'") or die('query failed');
    header('location:favorite-log.php');
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
</head>

<body>
  <header class="header">
    <div class="logo-wrapper">
      <a class="logo-a" href="home-not-logged.html"><img class="logo-img" src="styles/resources/logo-image.png" alt="Plant Palooza"></a>
    </div>
    <input class="search-input" type="text" placeholder="search" />

    <div class="side-header">
      <div class="account-div">
        <a class="account-a" href="login.html">
          <img class="account-img" src="https://static.thenounproject.com/png/4038155-200.png" alt="account">
        </a>
      </div>
      
      <div class="favorite-a">
        <a href="favorite.html">
          <img class="fav-img" src="styles/resources/favorite.png" alt="favorite">
        </a>
      </div>
      <div class="dropdown2">
        <img class="shopping-cart-img" src="https://icons.veryicon.com/png/o/miscellaneous/jd-app-icon/shopping-cart-296.png" alt="shopping cart">
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
    <a class="active" href="shop-log.html">S H O P</a>
    <a href="about-log.html">A B O U T</a>
    <a href="help-log.html">H E L P</a>
    <a href="help-log.html">C R O P S</a>
  </div>

  <section class="wishlist">
    <h1 class="title">Products Added</h1>

    <div class="box-container">
      <?php
        $grand_total = 0;
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `favorites` WHERE ID_user = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_wishlist) > 0){
          while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
      ?>
      <div class="box">
        <a href="plant_page.html?pid=<?php echo $fetch_wishlist['ID_flower']; ?>">
          <img src="<?php echo $fetch_wishlist['imageURL']; ?>" alt="<?php echo $fetch_wishlist['Name']; ?>">
        </a>
        <div class="name"><?php echo $fetch_wishlist['Name']; ?></div>
        <div class="price">$<?php echo $fetch_wishlist['Price']; ?>/-</div>
        <form action="" method="POST">
          <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['ID_flower']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['Name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['Price']; ?>">
          <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['imageURL']; ?>">
          <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
        </form>
      </div>
      <?php
          $grand_total += $fetch_wishlist['Price'];
          }
        }else{
          echo '<p class="empty">Your wishlist is empty</p>';
        }
      ?>
    </div>

    <div class="wishlist-total">
      <p>Grand Total: <span>$<?php echo $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">Continue Shopping</a>
      <a href="favorite-log.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Delete all from wishlist?');">Delete All</a>
    </div>
  </section>



<script src="js/script.js"></script>

</body>
</html>