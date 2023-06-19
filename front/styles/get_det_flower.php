<?php
// Conectare la baza de date
include 'config.php';

// Extrage numele florii din parametrul de interogare
$flowerName = $_GET['name'];

// Interogare pentru a obține datele florii din baza de date
$sql = "SELECT * FROM flowers WHERE Name = '$flowerName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["Name"];
    $price = $row["Price"];
    $growthPeriod = $row["GrowthPeriod"];
    $imageURL = $row["ImageURL"];
    $description = $row["Description"];

    // Afișează detaliile florii
    echo "<div class='plant-section'>";
    echo "<div class='plant-image'>";
    echo "<img src='$imageURL' alt='Imagine floare'>";
    echo "</div>";
    echo "<div class='plant-details'>";
    echo "<div class='plant-info'>";
    echo "<h2>$name</h2>";
    echo "<p class='price'>Price: $price</p>";
    echo "<p class='growth-period'>Growth Period: $growthPeriod</p>";
    echo "</div>";
    echo "<div class='buttons'>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    // Afișează descrierea florii
    echo "<div class='plant-description'>";
    echo "<h2>About</h2>";
    echo "<p>$description</p>";
    echo "</div>";
} else {
    echo "Nu s-au găsit informații despre floare.";
}

$conn->close();
?>
