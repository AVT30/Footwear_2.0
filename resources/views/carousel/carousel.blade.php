{{-- Carousel dans une blade à part pour purifier le code dans la page accueil --}}
<<div class="relative w-screen flex justify-center mx-auto items-center py-10 hidden md:flex">
    <div class="flex-row overflow-hidden z-0">
        <div id="carousel2" class="flex flex-no-wrap w-screen transition-all duration-500">
            <a href="/afficheRabais" class="w-full h-auto flex-shrink-0">
                <img src="images/Banner2.svg" alt="Image 2" class="w-full h-auto flex-shrink-0">
            </a>
            <a href="/priximbatables" class="w-full h-auto flex-shrink-0">
                <img src="images/Banner3.svg" alt="Image 3" class="w-full h-auto flex-shrink-0">
            </a>
            <a href="/pairesexeptionels" class="w-full h-auto flex-shrink-0">
                <img src="images/Banner4.svg" alt="Image 4" class="w-full h-auto flex-shrink-0">
            </a>
            <a href="/afficheRabais">
                <object data="images/Banner2.svg" class="w-full h-auto flex-shrink-0"></object>
            </a>
            <a href="/priximbatables">
                <object data="images/Banner3.svg" class="w-full h-auto flex-shrink-0"></object>
            </a>
            <a href="/pairesexeptionels">
                <object data="images/Banner4.svg" class="w-full h-auto flex-shrink-0"></object>
            </a>
        </div>
    </div>

    <div class="z-0 absolute bottom-0 left-0 right-0 flex justify-center space-x-2 pb-2">
        <button id="prev2"
            class="p-2 rounded-full hover:bg-gray-300 focus:outline-none focus:bg-gray-300 hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd"
                    d="M12.707 3.293a1 1 0 011.414 1.414L8.414 10l5.707 5.707a1 1 0 01-1.414 1.414l-6-6a1 1 0 010-1.414l6-6z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <button id="next2"
            class="p-2 rounded-full hover:bg-gray-300 focus:outline-none focus:bg-gray-300 hidden md:block">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd"
                    d="M7.293 16.707a1 1 0 01-1.414-1.414L11.586 10 6.293 4.293a1 1 0 011.414-1.414l6 6a1 1 0 010 1.414l-6 6z"
                    clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    </div>




    <script>
        (function() {
            const carousel = document.getElementById("carousel2");
            const images = carousel.getElementsByTagName("img");
            const imageWidth = images[0].offsetWidth;
            let currentImage = 0;
            let intervalId = null;

            function showNextImage() {
                currentImage = (currentImage + 1) % images.length;
                carousel.style.transform = `translateX(-${currentImage * imageWidth}px)`;
                resetInterval();
            }

            function showPrevImage() {
                currentImage = (currentImage - 1 + images.length) % images.length;
                carousel.style.transform = `translateX(-${currentImage * imageWidth}px)`;
                resetInterval();
            }

            function resetInterval() {
                clearInterval(intervalId);
                intervalId = setInterval(showNextImage, 6000);
            }

            const prev = document.getElementById("prev2");
            prev.addEventListener("click", showPrevImage);

            const next = document.getElementById("next2");
            next.addEventListener("click", showNextImage);

            intervalId = setInterval(showNextImage, 6000);
        })();
    </script>
