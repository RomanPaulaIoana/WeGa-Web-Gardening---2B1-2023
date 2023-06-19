
$(document).ready(function() {
    // Funcția pentru încărcarea și afișarea produselor pe pagina principală
    function loadProducts() {
      // Faceți o cerere AJAX pentru a obține produsele în ordinea implicită din baza de date
      $.ajax({
        url: "get_flowers.php",
        type: "GET",
        dataType: "html",
        success: function(data) {
          // Adăugați rezultatul AJAX în containerul produselor
          var productsContainer = $(".products .box-container");
          productsContainer.html(data);
        },
        error: function(_xhr, _status, error) {
          console.log("Eroare la obținerea datelor din baza de date: " + error);
        }
      });
    }
  
    // Funcția pentru încărcarea și afișarea produselor sortate
    function loadSortedProducts(sortField, sortOrder) {
      // Faceți o cerere AJAX pentru a obține produsele sortate din baza de date
      $.ajax({
        url: "sort.php",
        type: "GET",
        data: { sortField: sortField, sortOrder: sortOrder },
        dataType: "html",
        success: function(data) {
          // Adăugați rezultatul AJAX în containerul produselor
          var productsContainer = $(".products .box-container");
          productsContainer.html(data);
        },
        error: function(_xhr, _status, error) {
          console.log("Eroare la obținerea datelor din baza de date: " + error);
        }
      });
    }
  
    // Ascultă evenimentul de click pe opțiunile de sortare
    $(".sort-dropdown ul").on("click", "li a.sort-option", function(e) {
      e.preventDefault();
      var sortOption = $(this).attr("class").split(" ")[1]; // Obține clasa opțiunii de sortare
  
      var sortField = ""; // Câmpul de sortare
      var sortOrder = ""; // Direcția de sortare
  
      // Verifică opțiunea de sortare selectată și setează câmpul care trebuie sortat și direcția de sortare corespunzătoare
      if (sortOption === "price_asc") {
        sortField = "Price";
        sortOrder = "ASC";
      } else if (sortOption === "price_desc") {
        sortField = "Price";
        sortOrder = "DESC";
      } else if (sortOption === "name_asc") {
        sortField = "Name";
        sortOrder = "ASC";
      } else if (sortOption === "name_desc") {
        sortField = "Name";
        sortOrder = "DESC";
      }
  
      loadSortedProducts(sortField, sortOrder); // Apelează funcția loadSortedProducts cu opțiunile de sortare
    });
  
    // Afișează produsele în ordinea implicită la încărcarea paginii
    loadProducts();
  });

  function showMessage() {
    alert("You cannot access the Wishlist because you are not logged in.");
  }

