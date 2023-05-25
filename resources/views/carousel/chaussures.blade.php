<div class="flex items-center justify-center w-full h-full py-24 sm:py-8 px-4">
    <div class="w-full relative flex items-center justify-center">
        <button aria-label="slide backward"
            class="absolute z-30 left-0 ml-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
            id="prev1">
            <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
        <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
            <div id="slider1"
                class="h-full flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">
                @foreach ($chaussures as $chaussure)
                    <div class="flex flex-shrink-0 relative w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                        <div class="aspect-w-1 aspect-h-1">
                            @if ($chaussure->image)
                                <div class="flex flex-shrink-0 relative w-full sm:w-auto">
                                    @if (Storage::disk('public')->exists('storage/images/' . $chaussure->image->image_chaussure))
                                        <img src="{{ asset('storage/images/' . $chaussure->image->image_chaussure) }}"
                                            class="object-contain" alt="Image chaussure">
                                    @else
                                        <img src="images/{{ $chaussure->image->image_chaussure }}"
                                            class="object-contain" alt="Image chaussure">
                                    @endif
                                    <div class="bg-gray-800 bg-opacity-30 absolute w-full h-full p-6">
                                        <div class="flex h-full items-end pb-6">
                                            <h3
                                                class="text-xl lg:text-2xl font-semibold leading-5 lg:leading-6 text-white dark:text-gray-900">
                                                {{ $chaussure->modele }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <button aria-label="slide forward"
            class="absolute z-30 right-0 mr-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
            id="next1">
            <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
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
