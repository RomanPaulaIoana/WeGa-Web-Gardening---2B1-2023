<?php

// Configurarea conexiunii la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$database = "plant_palooza";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexiunea la baza de date a eșuat: " . mysqli_connect_error());
}

// Definirea endpoint-ului pentru API
$endpoint = '/api/flowers';

// Verificarea cererii API
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === $endpoint) {
    // Executarea interogării la baza de date pentru a obține produsele
    $query = "SELECT * FROM flowers";
    $result = mysqli_query($conn, $query);

    // Verificarea rezultatelor
    if (mysqli_num_rows($result) > 0) {
        $products = array();

        // Parcurgerea rezultatelor și construirea array-ului de produse
        while ($row = mysqli_fetch_assoc($result)) {
            $product = array(
                'ID_flowers' => $row['ID_flowers'],
                'Name' => $row['Name'],
                'Price' => $row['Price'],
                // Adăugați alte coloane necesare aici
            );
            $products[] = $product;
        }

        // Returnarea rezultatelor în format JSON
        header('Content-Type: application/json');
        echo json_encode($products);
    } else {
        // Nu s-au găsit produse
        http_response_code(404);
        echo json_encode(array('message' => 'Nu s-au găsit produse.'));
    }
} else {
    // Cerere API nevalidă
    http_response_code(404);
    echo json_encode(array('message' => 'Endpoint API nevalid.'));
}

// Închiderea conexiunii la baza de date
mysqli_close($conn);
?>
