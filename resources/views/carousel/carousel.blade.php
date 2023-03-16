{{-- Carousel dans une blade à part pour purifier le code dans la page accueil --}}
<div class="relative z-10 ">
    <div class="hidden md:block flex-row overflow-hidden z-0">
        <div id="carousel" class="flex flex-no-wrap transition-all duration-500">
            <img src="images/rabais1.jpg" alt="Image 1" class="w-screen h-64 flex-shrink-0">
            <img src="images/rabais2.jpg" alt="Image 2" class="w-screen h-64 flex-shrink-0">
            <img src="images/rabais5.png" alt="Image 3" class="w-screen h-64 flex-shrink-0">
        </div>
    </div>

    <div class="z-0 absolute bottom-0 left-0 right-0 flex justify-center space-x-2 pb-2 ">
      <button id="prev" class="p-2 rounded-full hover:bg-gray-300 focus:outline-none focus:bg-gray-300 hidden md:block">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
          <path fill-rule="evenodd" d="M12.707 3.293a1 1 0 011.414 1.414L8.414 10l5.707 5.707a1 1 0 01-1.414 1.414l-6-6a1 1 0 010-1.414l6-6z" clip-rule="evenodd" />
        </svg>
      </button>
      <button id="next" class="p-2 rounded-full hover:bg-gray-300 focus:outline-none focus:bg-gray-300 hidden md:block">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
          <path fill-rule="evenodd" d="M7.293 16.707a1 1 0 01-1.414-1.414L11.586 10 6.293 4.293a1 1 0 011.414-1.414l6 6a1 1 0 010 1.414l-6 6z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>
  </div>



  <script>
  const carousel = document.getElementById("carousel");
  const images = carousel.getElementsByTagName("img");
  const imageWidth = images[0].offsetWidth;
  let currentImage = 0;
  let intervalId = null;

  // Fonction pour afficher l'image suivante
  function showNextImage() {
    currentImage = (currentImage + 1) % images.length;
    carousel.style.transform = `translateX(-${currentImage * imageWidth}px)`;
    resetInterval();
  }

  // Fonction pour afficher l'image précédente
  function showPrevImage() {
    currentImage = (currentImage - 1 + images.length) % images.length;
    carousel.style.transform = `translateX(-${currentImage * imageWidth}px)`;
    resetInterval();
  }

  //fonction que remet a zero le compte a rebours si on change de slide manuellement
  function resetInterval() {
  clearInterval(intervalId);
  intervalId = setInterval(showNextImage, 6000);
  }


  // Écouteurs d'événements pour les boutons de navigation
  document.getElementById("prev").addEventListener("click", showPrevImage);
  document.getElementById("next").addEventListener("click", showNextImage);

// Boucle pour le carousel de 6 secondes
intervalId = setInterval(showNextImage, 6000);
  </script>
