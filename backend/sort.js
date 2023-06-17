
$(document).ready(function() {
     function loadProducts() {
         $.ajax({
        url: "get_flowers.php",
        type: "GET",
        dataType: "html",
        success: function(data) {
          var productsContainer = $(".products .box-container");
          productsContainer.html(data);
        },
        error: function(_xhr, _status, error) {
          console.log("Eroare la obținerea datelor din baza de date: " + error);
        }
      });
    }
  
       function loadSortedProducts(sortField, sortOrder) {
        $.ajax({
        url: "sort.php",
        type: "GET",
        data: { sortField: sortField, sortOrder: sortOrder },
        dataType: "html",
        success: function(data) {
          var productsContainer = $(".products .box-container");
          productsContainer.html(data);
        },
        error: function(_xhr, _status, error) {
          console.log("Eroare la obținerea datelor din baza de date: " + error);
        }
      });
    }
  
      $(".sort-dropdown ul").on("click", "li a.sort-option", function(e) {
      e.preventDefault();
      var sortOption = $(this).attr("class").split(" ")[1]; // Obține clasa opțiunii de sortare
  
      var sortField = ""; // Campul de sortare
      var sortOrder = ""; // Directia de sortare
  
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
  
      loadSortedProducts(sortField, sortOrder); 
    });
  
     loadProducts();
  });
 
 