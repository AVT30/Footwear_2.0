<link rel="stylesheet" type="text/css" href="{{ asset('css/fluxcss.css') }}">

<div class="flex items-center justify-center w-full h-full py-2 sm:py-2 px-0">
    <div class="w-full relative flex items-center justify-center">
        <button aria-label="slide backward" class="absolute z-30 left-0 ml-10 focus:outline-none" id="prev1">
            <!-- Flèche gauche -->
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Précédent</span>
            </span>
        </button>
        <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
            <div id="slider1"
                class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">
                @foreach ($chaussures as $chaussure)
                    <div class="flex flex-shrink-0 relative w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                        <div class="aspect-w-1 aspect-h-1">
                            @if ($chaussure->image)
                                <div class="flex flex-shrink-0 relative w-full sm:w-auto">
                                    <img src="{{ asset('storage/images/' . $chaussure->image->image_chaussure) }}"
                                        class="object-cover object-center w-full" alt="Image chaussure">
                                    <div class="bg-gray-800 bg-opacity-10 absolute w-full h-full ">
                                        <div class="flex h-full items-end  justify-center bg-clip-content ">
                                            <h3
                                                class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900 titleshoes ">
                                                {{ $chaussure->marque }} {{ $chaussure->modele }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button aria-label="slide forward" class="absolute z-30 right-0 mr-10 focus:outline-none " id="next1">
            <!-- Flèche droite -->
            <span
                class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Suivant</span>
            </span>
        </button>
    </div>
</div>




<script>
    (function() {
        let defaultTransform = 0;

        function goNext() {
            defaultTransform = defaultTransform - 398;
            var slider = document.getElementById("slider1");
            if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7) defaultTransform = 0;
            slider.style.transform = "translateX(" + defaultTransform + "px)";
        }

        function goPrev() {
            var slider = document.getElementById("slider1");
            if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
            else defaultTransform = defaultTransform + 398;
            slider.style.transform = "translateX(" + defaultTransform + "px)";
        }

        const next = document.getElementById("next1");
        next.addEventListener("click", goNext);

        const prev = document.getElementById("prev1");
        prev.addEventListener("click", goPrev);
    })();
</script>
