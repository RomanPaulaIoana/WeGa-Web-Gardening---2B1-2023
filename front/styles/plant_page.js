document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const flowerName = urlParams.get('name');
    
    // Verifică dacă există un nume de floare în parametrul de interogare
    if (flowerName) {
      // Realizează o cerere către "plant.php" pentru a obține detaliile despre floare
      fetch(`get_det_flower.php?name=${encodeURIComponent(flowerName)}`)
        .then(response => response.text())
        .then(data => {
          // Afișează răspunsul (detaliile despre floare) în elementul HTML corespunzător
          const plantDetailsContainer = document.getElementById('plant-details');
          plantDetailsContainer.innerHTML = data;
        })
        .catch(error => {
          console.error('A apărut o eroare:', error);
        });
    }
  });
  