<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

include 'config.php';

if (isset($_GET['sortField']) && isset($_GET['sortOrder'])) {
  $sortField = $_GET['sortField'];
  $sortOrder = $_GET['sortOrder'];

  $sortField = mysqli_real_escape_string($conn, $sortField);

  $sql = "SELECT * FROM Flowers ORDER BY $sortField $sortOrder";
} else {
  $sortField = 'ID_flower';
  $sortOrder = 'ASC';

  $sql = "SELECT * FROM Flowers ORDER BY $sortField $sortOrder";
}

 $result = $conn->query($sql);


  $html = '';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $html .= '<div class="box">';
      $html .= '<div class="name"><a href="pagina_plantei.html" class="product-name"><strong>' . $row['Name'] . '</strong></a></div>';
      $html .= '<img src="' . $row['ImageURL'] . '" alt="' . $row['Name'] . '" class="image" />';
      $html .= '<div class="price">$' . $row['Price'] . '</div>';
      $html .= '<input type="number" name="product_quantity" value="1" min="0" class="qty" />';
      $html .= '<input type="submit" value="Add to Wishlist" name="add_to_wishlist" class="option-btn" />';
      $html .= '<a class="btn add-to-cart" data-product-id="' . $row['ID_flower'] . '">Add to Cart</a>';
      $html .= '</div>';
    }
  }

  if (!empty($html)) {
    echo $html;
  } else {
    echo "Nu există produse disponibile.";
  }


  $conn->close();

?>
