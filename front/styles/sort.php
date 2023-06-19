<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

// Conectare la baza de date
include 'config.php';

// Verificăm dacă s-a primit parametrii "sortField" și "sortOrder" în cererea GET
if (isset($_GET['sortField']) && isset($_GET['sortOrder'])) {
  // Obținem valorile parametrilor "sortField" și "sortOrder"
  $sortField = $_GET['sortField'];
  $sortOrder = $_GET['sortOrder'];

  // Escapăm valoarea variabilei $sortField pentru a preveni injecții SQL
  $sortField = mysqli_real_escape_string($conn, $sortField);

  // Generăm interogarea SQL în funcție de câmpul și direcția de sortare
  $sql = "SELECT * FROM Flowers ORDER BY $sortField $sortOrder";
} else {
  // În cazul în care parametrii "sortField" și "sortOrder" lipsesc, setăm valorile implicite
  $sortField = 'ID_flower';
  $sortOrder = 'ASC';

  // Generăm interogarea SQL cu valorile implicite
  $sql = "SELECT * FROM Flowers ORDER BY $sortField $sortOrder";
}


  // Executăm interogarea și obținem rezultatul
  $result = $conn->query($sql);


  // Construim HTML-ul pentru fiecare produs sortat
  $html = '';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $html .= '<div class="box">';
      $html .= '<div class="name"><a href="pagina_plantei.html" class="product-name"><strong>' . $row['Name'] . '</strong></a></div>';
      $html .= '<img src="' . $row['ImageURL'] . '" alt="' . $row['Name'] . '" class="image" />';
      $html .= '<div class="price">$' . $row['Price'] . '</div>';
      $html .= '<input type="number" name="product_quantity" value="1" min="0" class="qty" />';
     $html .= '<input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn" onclick="showMessage()" />';
     $html .= '<input type="submit" value="Add to Cart" name="add_to_cart" class="option-btn" onclick="showMessage()" />';
      $html .= '</div>';
    }
  }

  // Returnăm HTML-ul generat
  if (!empty($html)) {
    echo $html;
  } else {
    echo "Nu există produse disponibile.";
  }



  // Închidem conexiunea la baza de date
  $conn->close();

?>
