<link rel="stylesheet" type="text/css" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">


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
        <ul
            class="hidden absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2  lg:mx-auto lg:flex lg:items-center lg:w-auto lg:space-x-6">
            <form class="flex" action="{{ route('search') }}" method="GET">
                <label for="query"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="query" name="query" id="query" style="width:800px"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Rechercher..." autocomplete="on" required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Go
                        !</button>
                </div>
            </form>
        </ul>
        <div class="flex flex-col md:flex-row md:mx-6">

            <a class="my-1 text-sm md:mx-4 md:my-0" href="{{ route('whislist') }}"><img
                    class="object-cover h-5 w-5 flex space-x-5" src="{{ asset('icones/heart.png') }}"
                    alt="Favoris"></a>
            <a class="my-1 text-sm md:mx-4 md:my-0" href="{{ route('panier') }}"><img
                    class="object-cover h-5 w-5 flex space-x-5" src="{{ asset('icones/panier.png') }}"
                    alt="Panier"></a>

            <button type="button"
                class="flex mr-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 bg-white"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="sr-only">Open user menu</span>
                <img class="object-cover h-7 w-7 flex space-x-5" src="{{ asset('icones/usericon.png') }}"
                    alt="iconuser">
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                id="user-dropdown">
                <div class="px-4 py-3">
                    {{-- un IF si il n'y a pas d'utilisateur connecté  --}}
                    @if (Auth::check())
                        <span>Bonjour {{ Auth::user()->prenom }}</span>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="bg-black text-white py-2 font-bold text-xl  rounded-md m-4 text-center"
                                style="width:215px;height:50px;">Connexion</button>
                        </a>
                        <div class="px-3">
                            <a href="{{ route('register') }}">
                                <span class="text-black cursor-default">Nouveau client ? <span
                                        class="hover:underline text-purple-600 cursor-pointer">Incrivez-vous
                                    </span></span>
                            </a>
                        </div>
                    @endif
                </div>

                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('commandes') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Commandes</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Aide
                            & contact</a>
                    </li>

                    <li>
                        {{-- un if si l'utilisateur n'est pas connecte, il y a pas d'option deconnexion --}}
                        @if (Auth::check())
                            <!-- Déconnexion -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();this.closest('form').submit();"><span
                                        class="text-red-600 hover:text-red-400 hover:underline">Déconnexion</span>
                                </x-dropdown-link>
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
                            <a href="/creation"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Nouvelle
                                chaussure</a>
                        </li>
                        <li>
                            <a href="{{ route('modification') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Gérer
                                chaussures</a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    {{-- Le contenu de l'hamburger --}}
    <div class="navbar-menu relative z-50 hidden">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav
            class="fixed top-0 left-0 bottom-0 flex flex-col w-6/6 max-w-sm py-6 px-3 bg-white border-r overflow-y-auto">
            <div class="burgerParcourir">
                <h1>Parcourir</h1>
            </div>
            {{-- Catégorie "SkateShooes" --}}
            <div class="skateshoes">
                <img class="imgSkateshoes" src="{{ asset('images/burgermenuskateshoes.jpg') }}" alt="">
                <span class="titreSkateshoes">Skate Shoes</span>
            </div>
            {{-- Sneakers" --}}
            <div class="sneakersBurgerMenu">
                {{-- Catégorie "Basket Haute" --}}
                <div class="sneakerscontenaire">
                    <img class="imgsSneakers" src="{{ asset('images/burgermenubasse.jpg') }}" alt="">
                    <span class="titresSneakers">Sneakers Basses</span>
                </div>
                {{-- Catégorie "Basket Basse" --}}
                <div class="sneakerscontenaire">
                    <img class="imgsSneakers" src="{{ asset('images/burgermenuhaute.jpg') }}" alt="">
                    <span class="titresSneakers">Sneakers Hautes</span>
                </div>
            </div>
            {{-- Toutes catégories --}}
            <div class="skateshoes">
                <img class="imgSkateshoes" src="{{ asset('images/burgermenuskateshoes.jpg') }}" alt="">
                <span class="titresSneakers">Toutes catégories</span>
            </div>

            <div class=" mt-auto">
                {{-- Bouton s'inscrire --}}
                <div class=" pt-6">
                    <a class="block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100"
                        href="#">S'inscrire</a>
                </div>
                {{-- Bouton se connecter --}}
                <div>
                    <a class="block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-blue-600 hover:bg-blue-700"
                        href="#">Se connecter</a>
                </div>
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
    <nav class="relative w-screen flex justify-center mx-auto items-center bg-gray-100 text-black h-6 drop-shadow-md"
        style="z-index:20">
        <!-- menu des produits -->
        <div class="flex items-center self-center">
            <div class="group">
                <button class="px-5  group-hover:underline  group-hover:text-black">Homme
                </button>
                <div
                    class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Sneakers</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="/sneakers-hautes"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Sneakers hautes</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="/sneakers-basses"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers basses</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Sneakers basses</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">sandales</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Sneakers de skate</p>
                                    </a>
                                </li>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Bottes</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines à lacet</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Bottines à lacet</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Bottines</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes de pluie</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Bottes de pluie</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes moto</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                        <p>Bottes moto</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chassures basses</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Loafers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Loafers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Mocassins</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Mocassins</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Espadrilles</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Espadrilles</p>
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Running</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Running</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Football</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Football</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Golf</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Golf</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Tennis</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
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
                <div
                    class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-5 ">
                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Sneakers</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Sneakers hautes</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers basses</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Sneakers basses</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">sandales</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Sneakers de skate</p>
                                    </a>
                                </li>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Talons</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Escarpain</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Escarpain</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Football</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Talons haut</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Golf</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Talons bas</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Bottes</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines à lacet</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Bottines à lacet</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Bottines</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes de pluie</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Bottes de pluie</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes moto</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                        <p>Bottes moto</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chassures basses</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Loafers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Loafers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Mocassins</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Mocassins</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Espadrilles</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Espadrilles</p>
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Running</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Running</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Football</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Football</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Golf</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Golf</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Tennis</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
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
                <div
                    class="hidden group-hover:flex flex-col absolute left-0 p-5 w-full bg-white text-black duration-300">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Sneakers</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Sneakers hautes</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Sneakers basses</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Sneakers basses</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">sandales</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Sneakers de skate</p>
                                    </a>
                                </li>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Bottes</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines à lacet</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Bottines à lacet</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottines</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Bottines</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes de pluie</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Bottes de pluie</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Bottes moto</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
                                        <p>Bottes moto</p>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chassures basses</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Loafers</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Loafers</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Mocassins</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Mocassins</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Espadrilles</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Espadrilles</p>
                                    </a>
                                </li>
                            </ul>
                        </div>



                        <div class="flex flex-col">
                            <h3 class="mb-4 text-xl">Chaussures de sport</h3>
                            <ul class="mt-4 text-[15px] space-y-3">
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Running</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/sneakers.png') }}" alt="Sneakers">
                                        <p>Running</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Football</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/boot.png') }}" alt="Sneakers">
                                        <p>Football</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Golf</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/flip-flops.png') }}" alt="Sneakers">
                                        <p>Golf</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group gap-2">
                                        <span class="sr-only">Tennis</span>
                                        <img class="object-cover h-7 w-7 flex space-x-5"
                                            src="{{ asset('icones/leather-work.png') }}" alt="Sneakers">
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
