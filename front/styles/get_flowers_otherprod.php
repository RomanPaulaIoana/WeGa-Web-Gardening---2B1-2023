<?php
// Conectare la baza de date
include 'config.php';


// Interogare SQL pentru a selecta primele 10 flori după ID
$sql = "SELECT * FROM flowers ORDER BY ID_flower LIMIT 10";
$result = $conn->query($sql);

// Verificare rezultate
if ($result->num_rows > 0) {
    // Afisare flori
    while ($row = $result->fetch_assoc()) {
        $image = $row['ImageURL'];
        $name = $row['Name'];
        $price = $row['Price'];

        echo '<div class="grid-item">';
        echo "<a href='plant_page.html?name=$name'><img src='$image' alt='$name'></a>";
        echo "<h3 class='product-name'>$name</h3>";
        echo "<p class='product-price'>$price</p>";
        echo '</div>';
    }
} else {
    echo "Nu s-au gasit flori.";
}

// Inchidere conexiune
$conn->close();
?>
