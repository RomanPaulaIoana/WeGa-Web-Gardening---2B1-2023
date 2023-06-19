<?php
// Conectare la baza de date
include 'config.php';

// Interogare pentru a obține florile
$sql = "SELECT * FROM Flowers";
$result = $conn->query($sql);

// Verifică rezultatul interogării și construiește un HTML pentru fiecare produs
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $flowerName = $row['Name'];
    echo '<div class="box">';
    echo '<div class="name"><a href="plant_page.html?name=' . urlencode($flowerName) . '" class="product-name"><strong>' . $flowerName . '</strong></a></div>';
    echo '<img src="' . $row['ImageURL'] . '" alt="' . $flowerName . '" class="image" />';
    echo '<div class="price">$' . $row['Price'] . '</div>';
    echo '<input type="number" name="product_quantity" value="1" min="0" class="qty" />';
    echo '<input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn" onclick="showMessage()" />';
    echo '<input type="submit" value="Add to Cart" name="add_to_cart" class="option-btn" onclick="showMessage()" />';
    echo '</div>';
    unset($flowerName); // Elimină variabila $flowerName după utilizare
  }
}

// Închidem conexiunea la baza de date
$conn->close();
?>
