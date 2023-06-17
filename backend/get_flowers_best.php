<?php
// Conectare la baza de date
include 'config.php';

// Interogare SQL pentru a selecta cele mai vândute 4 flori începând cu ID-ul 11
$sql = "SELECT * FROM flowers WHERE ID_flower >= 11 ORDER BY ID_flower LIMIT 4";
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
        echo "<button class='view-details-btn' onclick=\"location.href='plant_page.html?name=$name';\">View Details</button>";
        echo '</div>';
    }
} else {
    echo "Nu s-au găsit flori cele mai vândute.";
}

// Inchidere conexiune
$conn->close();
?>
