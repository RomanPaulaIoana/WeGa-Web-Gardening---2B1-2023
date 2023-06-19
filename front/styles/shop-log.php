<?php
@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$message = '';

if (!isset($_SESSION['user_id'])) {
  header('location: login.html');
  exit;
}

if (isset($_POST['add_to_wishlist'])) {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];

  $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `favorites` WHERE ID_user = '$user_id' AND ID_flower = '$product_id'") or die('query failed');
  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = '$user_id' AND id_flower = '$product_id'") or die('query failed');

  if (mysqli_num_rows($check_wishlist_numbers) > 0) {
    $message = 'already added to wishlist';
  } elseif (mysqli_num_rows($check_cart_numbers) > 0) {
    $message = 'already added to cart';
  } else {
    mysqli_query($conn, "INSERT INTO `favorites` (ID_user, ID_flower, Name, Price, ImageURL) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
    $message = 'product added to wishlist';
  }
}

if (isset($_POST['add_to_cart'])) {
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

  $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE ID_user = '$user_id' AND ID_flower = '$product_id'") or die('query failed');

  if (mysqli_num_rows($check_cart_numbers) > 0) {
    $message = 'already added to cart';
  } else {
    $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = '$user_id' AND id_flower = '$product_id'") or die('query failed');

    if (mysqli_num_rows($check_wishlist_numbers) > 0) {
      mysqli_query($conn, "DELETE FROM `wishlist` WHERE ID_user = '$user_id' AND ID_flower = '$product_id'") or die('query failed');
    }

    mysqli_query($conn, "INSERT INTO `cart` (id_user, id_flower, Name, Price, Quantity, ImageURL) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
    $message = 'product added to cart';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link rel="stylesheet" href="styles/style-shop.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <header class="header">
    <div class="logo-wrapper">
      <a class="logo-a" href="home-not-logged.html"><img class="logo-img" src="styles/resources/logo-image.png" alt="Plant Palooza"></a>
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
        <div class="message"><?php echo $message; ?></div>
      </div>
    </div>
  <?php endif; ?>

  <div class="menu">
    <a href="home-logged-user.html">H O M E</a>
    <a class="active" href="shop-log.html">S H O P</a>
    <a href="about-log.html">A B O U T</a>
    <a href="help-log.html">H E L P</a>
    <a href="crops.html"> C R O P S</a>
  </div>
  <div class="filter-sort-container">
    <div class="filter-container">
      <button class="filter-button">Filter By</button>
      <div class="filter-dropdown">
        <ul>
          <li><a href="#">Color</a></li>
          <li><a href="#">Category 2</a></li>
          <li><a href="#">Category 3</a></li>
          
        </ul>
      </div>
    </div>

    <div class="sort-container">
      <button class="sort-button">Sort By</button>
      <div class="sort-dropdown">
        <ul>
          <li><a href="#" class="sort-option price_asc">Price: Low to High</a></li>
          <li><a href="#" class="sort-option price_desc">Price: High to Low</a></li>
          <li><a href="#" class="sort-option name_asc">Name: A to Z</a></li>
          <li><a href="#" class="sort-option name_desc">Name: Z to A</a></li>
        
        </ul>
      </div>
    </div>
  </div>

  <section class="products">
    <div class="box-container">
      <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `flowers`") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
          while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
            <form action="" method="POST" class="box">
              <div class="name">
                <a href="plant_page.html?pid=<?php echo $fetch_products['ID_flower']; ?>">
                  <span style="font-size: 40px;"><?php echo $fetch_products['Name']; ?></span>
                </a>
              </div>
              <div class="price">$<?php echo $fetch_products['Price']; ?>/-</div>
              <img src="<?php echo $fetch_products['ImageURL']; ?>" alt="" class="image">
              <input type="number" name="product_quantity" value="1" min="0" class="qty">
              <input type="hidden" name="product_id" value="<?php echo $fetch_products['ID_flower']; ?>">
              <input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">
              <input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">
              <input type="hidden" name="product_image" value="<?php echo $fetch_products['ImageURL']; ?>">
              <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
              <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
      <?php
          }
        } else {
          echo "No products found.";
        }
      ?>
    </div>
  </section>
</body>
</html>
