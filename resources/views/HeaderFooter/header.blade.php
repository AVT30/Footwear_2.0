<div class="" style="height:88px;">
    <!-- component -->
    <nav class="relative px-4 py-4 flex justify-between items-center bg-white">
		<a class="text-3xl font-bold leading-none" href="/accueil">
            <img class="h-24" alt="logo" src="images/FootWear-removebg-preview (1).png">
          </a>
		<div class="lg:hidden">
			<button class="navbar-burger flex items-center text-blue-600 p-3">
				<svg class="block h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<title>Mobile menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</button>
		</div>
        {{-- Barre de recherche --}}
		<ul class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2  lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
            <form class="flex" action="{{ route('search') }}" method="GET">
                <label for="query" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="query" name="query" id="query" style="width:800px" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rechercher..." autocomplete="on" required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go !</button>
                </div>
            </form>
		</ul>
		<div class="flex flex-col md:flex-row md:mx-6">

        <a class="my-1 text-sm md:mx-4 md:my-0" href="{{ route('whislist') }}"><img class="object-cover h-5 w-5 flex space-x-5" src="{{ asset('icones/heart.png') }}" alt="Favoris"></a>
        <a class="my-1 text-sm md:mx-4 md:my-0" href="{{ route('panier') }}"><img class="object-cover h-5 w-5 flex space-x-5" src="{{ asset('icones/panier.png') }}" alt="Panier"></a>

      <button type="button" class="flex mr-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 bg-white" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/usericon.png') }}" alt="iconuser">
      </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
        <div class="px-4 py-3">
          {{-- un IF si il n'y a pas d'utilisateur connecté  --}}
          @if (Auth::check())
              <span>Bonjour {{ Auth::user()->prenom }}</span>
          @else
          <a href="{{ route('login') }}">
              <button class="bg-black text-white py-2 font-bold text-xl  rounded-md m-4 text-center" style="width:215px;height:50px;">Connexion</button>
          </a>
          <div class="px-3">
            <a href="{{ route('register') }}">
                <span class="text-black cursor-default">Nouveau client ? <span class="hover:underline text-purple-600 cursor-pointer">Incrivez-vous </span></span>
            </a>
          </div>
          @endif
        </div>

        <ul class="py-2" aria-labelledby="user-menu-button">
          <li>
            <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profil</a>
          </li>
          <li>
            <a href="{{route('commandes')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Commandes</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Aide & contact</a>
          </li>

          <li>
            {{-- un if si l'utilisateur n'est pas connecte, il y a pas d'option deconnexion --}}
            @if (Auth::check())
              <!-- Déconnexion -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"><span class="text-red-600 hover:text-red-400 hover:underline">Déconnexion</span> </x-dropdown-link>
            </form>
          @else
          @endif
          </li>
        </ul>
        <div class="px-4 py-3">
            {{-- un IF si il n'y a pas d'utilisateur connecté et que l'utilisateur n'est pas un admin  --}}
           <ul>
                <span class="text-red-900">Admin</span>
                <li>
                    <a href="/creation" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Nouvelle chaussure</a>
                </li>
                <li>
                    <a href="{{ route('modification') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Gérer chaussures</a>
                </li>
                <li>
                    <a href="{{ route('gereruser') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Gérer utilisateurs</a>
                </li>
                <li>
                    <a href="{{ route('gereravis') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Gérer Avis</a>
                </li>
           </ul>
          </div>
    </div>
	</nav>
    {{-- Le contenu de l'hamburger --}}
	<div class="navbar-menu relative z-50 hidden">
		<div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
		<nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-3 bg-white border-r overflow-y-auto">
			<div class="flex items-center mb-8">
				<a class="mr-auto text-3xl font-bold leading-none" href="#">
					<svg class="h-12" alt="logo" viewBox="0 0 10240 10240">
				        <path xmlns="http://www.w3.org/2000/svg" d="M8284 9162 c-2 -207 -55 -427 -161 -667 -147 -333 -404 -644 -733 -886 -81 -59 -247 -169 -256 -169 -3 0 -18 -9 -34 -20 -26 -19 -344 -180 -354 -180 -3 0 -29 -11 -58 -24 -227 -101 -642 -225 -973 -290 -125 -25 -397 -70 -480 -80 -22 -3 -76 -9 -120 -15 -100 -13 -142 -17 -357 -36 -29 -2 -98 -7 -153 -10 -267 -15 -436 -28 -525 -40 -14 -2 -45 -7 -70 -10 -59 -8 -99 -14 -130 -20 -14 -3 -41 -7 -60 -11 -19 -3 -39 -7 -45 -8 -5 -2 -28 -6 -50 -10 -234 -45 -617 -165 -822 -257 -23 -10 -45 -19 -48 -19 -7 0 -284 -138 -340 -170 -631 -355 -1107 -842 -1402 -1432 -159 -320 -251 -633 -308 -1056 -26 -190 -27 -635 -1 -832 3 -19 7 -59 10 -89 4 -30 11 -84 17 -120 6 -36 12 -77 14 -91 7 -43 33 -174 39 -190 3 -8 7 -28 9 -45 6 -35 52 -221 72 -285 7 -25 23 -79 35 -120 29 -99 118 -283 189 -389 67 -103 203 -244 286 -298 75 -49 178 -103 196 -103 16 0 27 16 77 110 124 231 304 529 485 800 82 124 153 227 157 230 3 3 28 36 54 74 116 167 384 497 546 671 148 160 448 450 560 542 14 12 54 45 90 75 88 73 219 172 313 238 42 29 77 57 77 62 0 5 -13 34 -29 66 -69 137 -149 405 -181 602 -7 41 -14 82 -15 90 -1 8 -6 46 -10 83 -3 37 -8 77 -10 88 -2 11 -7 65 -11 122 -3 56 -8 104 -9 107 -2 3 0 12 5 19 6 10 10 8 15 -10 10 -34 167 -346 228 -454 118 -210 319 -515 340 -515 4 0 40 18 80 40 230 128 521 255 787 343 118 40 336 102 395 113 28 5 53 11 105 23 25 5 59 12 75 15 17 3 41 8 55 11 34 7 274 43 335 50 152 18 372 29 565 29 194 0 481 -11 489 -19 2 -3 -3 -6 -12 -6 -9 -1 -20 -2 -24 -3 -33 -8 -73 -16 -98 -21 -61 -10 -264 -56 -390 -90 -649 -170 -1243 -437 -1770 -794 -60 -41 -121 -82 -134 -93 l-24 -18 124 -59 c109 -52 282 -116 404 -149 92 -26 192 -51 220 -55 17 -3 64 -12 105 -21 71 -14 151 -28 230 -41 19 -3 46 -7 60 -10 14 -2 45 -7 70 -10 25 -4 56 -8 70 -10 14 -2 53 -7 88 -10 35 -4 71 -8 81 -10 10 -2 51 -6 92 -9 101 -9 141 -14 147 -21 3 -3 -15 -5 -39 -6 -24 0 -52 -2 -62 -4 -21 -4 -139 -12 -307 -22 -242 -14 -700 -7 -880 13 -41 4 -187 27 -250 39 -125 23 -274 68 -373 111 -43 19 -81 34 -86 34 -4 0 -16 -8 -27 -17 -10 -10 -37 -33 -59 -52 -166 -141 -422 -395 -592 -586 -228 -257 -536 -672 -688 -925 -21 -36 -43 -66 -47 -68 -4 -2 -8 -7 -8 -11 0 -5 -24 -48 -54 -97 -156 -261 -493 -915 -480 -935 2 -3 47 -21 101 -38 54 -18 107 -36 118 -41 58 -25 458 -138 640 -181 118 -27 126 -29 155 -35 14 -2 45 -9 70 -14 66 -15 137 -28 300 -55 37 -7 248 -33 305 -39 28 -3 84 -9 125 -13 163 -16 792 -8 913 12 12 2 58 9 102 15 248 35 423 76 665 157 58 19 134 46 170 60 86 33 344 156 348 166 2 4 8 7 13 7 14 0 205 116 303 184 180 126 287 216 466 396 282 281 511 593 775 1055 43 75 178 347 225 455 100 227 236 602 286 790 59 220 95 364 120 485 6 28 45 245 50 275 2 14 7 41 10 60 3 19 8 49 10 65 2 17 6 46 9 65 15 100 35 262 40 335 3 39 8 89 10 112 22 225 33 803 21 1043 -3 41 -7 129 -11 195 -3 66 -8 136 -10 155 -2 19 -6 76 -10 125 -3 50 -8 101 -10 115 -2 14 -6 57 -10 95 -7 72 -12 113 -20 175 -2 19 -7 55 -10 80 -6 46 -43 295 -51 340 -2 14 -9 54 -15 90 -5 36 -16 97 -24 135 -8 39 -17 84 -20 100 -12 68 -18 97 -50 248 -19 87 -47 204 -61 260 -14 56 -27 109 -29 117 -30 147 -232 810 -253 832 -4 4 -7 -23 -8 -60z"></path>
			        </svg>
				</a>
				<button class="navbar-close">
					<svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>
			<div>
				<ul>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Home</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">About Us</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Services</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Pricing</a>
					</li>
					<li class="mb-1">
						<a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Contact</a>
					</li>
				</ul>
			</div>
			<div class="mt-auto">
				<div class="pt-6">
					<a class="block px-4 py-3 mb-3  text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" href="#">Sign in</a>
					<a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700  rounded-xl" href="#">Sign Up</a>
				</div>
				<p class="my-4 text-xs text-center text-gray-400">
					<span>Copyright © 2021</span>
				</p>
			</div>
		</nav>
	</div>
</body>

<script>
// Burger menus
document.addEventListener('DOMContentLoaded', function() {
    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function() {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }
});
</script>


      {{-- //dexieme navbar pour le mega-menu --}}
      <nav class="relative w-screen flex justify-center mx-auto items-center bg-gray-100 text-black h-6 drop-shadow-md" style="z-index:20">        <!-- menu des produits -->
            <div class="flex items-center self-center">
                <div class="group">
                    <button class="px-5  group-hover:underline  group-hover:text-black">Homme
                    </button>
                    <div class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                            <div class="flex flex-col">
                                <h3 class="mb-4 text-xl">Sneakers</h3>
                                <ul class="mt-4 text-[15px] space-y-3">
                                    <li>
                                        <a href="/sneakers-hautes" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Sneakers</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                            <p>Sneakers hautes</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sneakers-basses" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Sneakers basses</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                            <p>Sneakers basses</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">sandales</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                            <p>Sneakers de skate</p>
                                        </a>
                                    </li>
                            </div>

                            <div class="flex flex-col">
                                <h3 class="mb-4 text-xl">Bottes</h3>
                                <ul class="mt-4 text-[15px] space-y-3">
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Bottines à lacet</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                            <p>Bottines à lacet</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Bottines</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                            <p>Bottines</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Bottes de pluie</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                            <p>Bottes de pluie</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Bottes moto</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                            <p>Bottes moto</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="flex flex-col">
                                <h3 class="mb-4 text-xl">Chassures basses</h3>
                                <ul class="mt-4 text-[15px] space-y-3">
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Loafers</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                            <p>Loafers</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Mocassins</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                            <p>Mocassins</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Espadrilles</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                            <p>Espadrilles</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>



                            <div class="flex flex-col">
                                <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                                    <ul class="mt-4 text-[15px] space-y-3">
                                        <li>
                                            <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                                <span class="sr-only">Running</span>
                                                <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                                <p>Running</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                                <span class="sr-only">Football</span>
                                                <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                                <p>Football</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                                <span class="sr-only">Golf</span>
                                                <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                                <p>Golf</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                                <span class="sr-only">Tennis</span>
                                                <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                                <p>Tennis</p>
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                    </div>
                </div>
            </div> <!-- end of dropdown -->

            <div class="group">
                <button class="px-5  group-hover:underline  group-hover:text-black">Femme
                </button>
                <div class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-5 ">
                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Sneakers</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Sneakers hautes</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers basses</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Sneakers basses</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">sandales</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Sneakers de skate</p>
                                    </a>
                                </li>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Talons</h3>
                                <ul class="mt-4 text-[15px] space-y-3">
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Escarpain</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                            <p>Escarpain</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Football</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                            <p>Talons haut</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Golf</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                            <p>Talons bas</p>
                                        </a>
                                    </li>
                                </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Bottes</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines à lacet</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Bottines à lacet</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Bottines</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes de pluie</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Bottes de pluie</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes moto</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                        <p>Bottes moto</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chassures basses</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Loafers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Loafers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Mocassins</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Mocassins</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Espadrilles</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Espadrilles</p>
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                                <ul class="mt-4 text-[15px] space-y-3">
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Running</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                            <p>Running</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Football</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                            <p>Football</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Golf</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                            <p>Golf</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                            <span class="sr-only">Tennis</span>
                                            <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                            <p>Tennis</p>
                                        </a>
                                    </li>
                                </ul>
                        </div>
                </div>
            </div>
        </div> <!-- end of dropdown -->

        <div class="group">
            <button class="px-5  group-hover:underline  group-hover:text-black">Enfant
            </button>
            <div class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <div class="flex flex-col">
                        <h3 class="mb-4 text-xl">Sneakers</h3>
                        <ul class="mt-4 text-[15px] space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Sneakers</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                    <p>Sneakers hautes</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Sneakers basses</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                    <p>Sneakers basses</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">sandales</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                    <p>Sneakers de skate</p>
                                </a>
                            </li>
                    </div>

                    <div class="flex flex-col">
                        <h3 class="mb-4 text-xl">Bottes</h3>
                        <ul class="mt-4 text-[15px] space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Bottines à lacet</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                    <p>Bottines à lacet</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Bottines</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                    <p>Bottines</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Bottes de pluie</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                    <p>Bottes de pluie</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Bottes moto</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                    <p>Bottes moto</p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="flex flex-col">
                        <h3 class="mb-4 text-xl">Chassures basses</h3>
                        <ul class="mt-4 text-[15px] space-y-3">
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Loafers</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                    <p>Loafers</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Mocassins</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                    <p>Mocassins</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                    <span class="sr-only">Espadrilles</span>
                                    <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                    <p>Espadrilles</p>
                                </a>
                            </li>
                        </ul>
                    </div>



                    <div class="flex flex-col">
                        <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Running</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Running</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Football</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Football</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Golf</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Golf</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Tennis</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                        <p>Tennis</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div> <!-- end of dropdown -->
            </div>
        </div>

    </nav>

</div>
