<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

$message = array(); 

if (isset($_POST['order'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = array();

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['Name'] . ' (' . $cart_item['Quantity'] . ') ';
            $sub_total = ($cart_item['Price'] * $cart_item['Quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email'  AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'your cart is empty!';
    } elseif (mysqli_num_rows($order_query) > 0) {
        $message[] = 'order placed already!';
    } else {
        mysqli_query($conn, "INSERT INTO `orders`(id_user, name, number, email, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE id_user = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
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
                <div class="message">
                    <?php foreach ($message as $msg): ?>
                        <p><?php echo $msg; ?></p>
                    <?php endforeach; ?>
                </div>
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


    <section class="heading">
        <h3>checkout order</h3>
    </section>

    <section class="display-order">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id_user = '$user_id'") or die('query failed');
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['Price'] * $fetch_cart['Quantity']);
                $grand_total += $total_price;
        ?>
                <p><?php echo $fetch_cart['Name'] ?> <span>(<?php echo '$' . $fetch_cart['Price'] . '/-' . ' x ' . $fetch_cart['Quantity']  ?>)</span></p>
        <?php
            }
        } else {
            echo '<p class="empty">your cart is empty</p>';
        }
        ?>
        <div class="grand-total">grand total : <span>$<?php echo $grand_total; ?>/-</span></div>
    </section>

    <section class="checkout">

        <form action="" method="POST">

            <h3>place your order</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>your name :</span>
                    <input type="text" name="name" placeholder="enter your name">
                </div>
                <div class="inputBox">
                    <span>your number :</span>
                    <input type="number" name="number" min="0" placeholder="enter your number">
                </div>
                <div class="inputBox">
                    <span>your email :</span>
                    <input type="email" name="email" placeholder="enter your email">
                </div>
                <div class="inputBox">
                    <span>payment method :</span>
                    <select name="payment">
                        <option value="Cash On Delivery">Cash On Delivery</option>
                        <option value="Online Payment">Online Payment</option>
                    </select>
                </div>
            </div>

            <h3>your address</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>flat no :</span>
                    <input type="text" name="flat" placeholder="enter flat number">
                </div>
                <div class="inputBox">
                    <span>street :</span>
                    <input type="text" name="street" placeholder="enter street">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name="city" placeholder="enter city">
                </div>
                <div class="inputBox">
                    <span>country :</span>
                    <input type="text" name="country" placeholder="enter country">
                </div>
                <div class="inputBox">
                    <span>pin code :</span>
                    <input type="text" name="pin_code" placeholder="enter pin code">
                </div>
            </div>
            <input class="place-order" type="submit" name="order" value="Place Order">

        </form>

    </section>

  

</body>

</html>
