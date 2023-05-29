<div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="mx-auto w-full max-w-screen-xl">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">

            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="/accueil" class="flex items-center">
                        <img src="{{ asset('images/FootWear-GrandLogo.png') }}" class="h-50 mr-3" alt="Footwear Logo" />
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Chaussures
                        </h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="/sneakers-hautes" class="hover:underline">Sneakers hautes</a>
                            </li>
                            <li class="mb-4">
                                <a href="/sneakers-basses" class="hover:underline">Sneakers basses</a>
                            </li>
                            <li>
                                <a href="/skate-shoes" class="hover:underline">Skate shoes</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase ">Shopping
                        </h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="{{ route('whislist') }}" class="hover:underline ">Liste
                                    d'envie</a>
                            </li>
                            <li>
                                <a href="{{ route('panier') }}" class="hover:underline">Panier</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Espace client
                        </h2>
                        <ul class="text-gray-600 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="{{ route('profile.edit') }}" class="hover:underline">Profil</a>
                            </li>
                            <li>
                                <a href="{{ route('commandes') }}" class="hover:underline">Commandes</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">Footwear© 2023</span>
</div>
