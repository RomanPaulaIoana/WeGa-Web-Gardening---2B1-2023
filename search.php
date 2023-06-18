<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Results</title>
  <link rel="stylesheet" href="styles/search-result.css">
  <link rel="stylesheet" href="styles/styles-home.css">
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
        <a class="account-a" href="login.html">
          <img class="account-img" src="https://static.thenounproject.com/png/4038155-200.png" alt="account">
        </a>
      </div>
      
      <div class="favorite-a">
        <a href="favorite.html">
          <img class="fav-img" src="styles/resources/favorite.png" alt="favorite">
        </a>
      </div>
      <div class="dropdown2">
        <img class="shopping-cart-img" src="https://icons.veryicon.com/png/o/miscellaneous/jd-app-icon/shopping-cart-296.png" alt="shopping cart">
      </div>
    </div>
  </header>
  <div class="menu">
    <a class="active" href="home-not-logged.html">H O M E</a>
    <a href="shop.html">S H O P</a>
    <a href="about.html">A B O U T</a>
    <a href="help.html">H E L P</a>
  </div>

  <div class="search-results">
    <?php

    include 'config.php';

    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];

       
        $searchTerm = mysqli_real_escape_string($conn, $searchTerm);

      
        $query = "SELECT * FROM flowers WHERE Name LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row['Name'];
                $description = $row['Description'];
                $price = $row['Price'];
                $imageURL = $row['ImageURL'];
        
                echo "<div class='result-box'>";
                echo "<h3>$name</h3>";
                echo "<p>$description</p>";
                echo "<p>Price: $price</p>";
                echo "<img src='$imageURL' alt='$name' />";
                echo "</div>";
            }
        } else {
            echo "<p>No results found.</p>";
        }
        
    }

  
    $conn->close();
    ?>
  </div>
  <script>const resultBoxes = document.querySelectorAll('.result-box');

resultBoxes.forEach((box) => {
  box.addEventListener('mouseover', () => {
    box.style.transform = 'translateY(-5px)';
    box.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
  });

  box.addEventListener('mouseout', () => {
    box.style.transform = 'translateY(0)';
    box.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.1)';
  });
});
const resultTitles = document.querySelectorAll('.result-box h3');

resultTitles.forEach((title) => {
  title.addEventListener('click', () => {
    title.style.color = '#ff7eb6';
    title.style.textDecoration = 'underline';
  });
});

</script>

</body>

</html>
