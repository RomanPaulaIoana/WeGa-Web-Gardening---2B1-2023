<?php

include 'config.php';

$sql = "SELECT * FROM Flowers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo '<div class="box">';
    echo '<div class="name"><a href="pagina_plantei.html" class="product-name"><strong>' . $row['Name'] . '</strong></a></div>';
    echo '<img src="' . $row['ImageURL'] . '" alt="' . $row['Name'] . '" class="image" />';
    echo '<div class="price">$' . $row['Price'] . '</div>';
    echo '<input type="number" name="product_quantity" value="1" min="0" class="qty" />';
    echo '<input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn" />';
    echo '<input type="submit" value="Add to Cart" name="add_to_cart" class="btn" />';
    echo '</div>';
  }
}

$conn->close();
?>