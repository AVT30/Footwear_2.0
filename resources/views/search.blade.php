@extends('layout.page')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-10">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400 divide-y divide-gray-200 sm:table-auto sm:min-w-full sm:px-6">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                <tr>
                    <th scope="col" class="px-6 py-7">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-7">
                        Article
                    </th>
                    <th scope="col" class="px-6 py-7">
                        Qty
                    </th>
                    <th scope="col" class="px-6 py-7">
                        Taille
                    </th>
                    <th scope="col" class="px-6 py-7">
                        Prix
                    </th>
                    <th scope="col" class="px-6 py-7">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($chaussures) > 0)
                    @foreach ($chaussures as $chaussure)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="w-32 p-4">
                                <a href="{{ route('chaussures.show', $chaussure->id_chaussure) }}"
                                    class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full">
                                    <img src="{{ asset('storage/images/' . $chaussure->image->image_chaussure) }}"
                                        alt="Apple Watch">
                                </a>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $chaussure->modele }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <button
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantité</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <div>
                                        <input type="number" id="first_product"
                                            class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="1" required>
                                    </div>
                                    <button
                                        class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center space-x-3  ">
                                    <select name="taille">
                                        <option value="">Taille Chaussure</option>

                                        <?php for ($i = 30; $i <= 52; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $chaussure->prix }} CHF
                            </td>
                            <td class="px-6 py-4">
                                <button type="submit" form="panier_add"
                                    class=" ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Ajouter
                                    au panier</button>
                            </td>
                    @endforeach
                    </tr>
            </tbody>
        </table>
    </div>
@else
    <h1 class="font-bold text-lg py-10 px-20">Aucun résultat trouvé pour "{{ $_GET['query'] }}"</h1>
    <h1 class="font-bold text-lg px-20">voici une liste de chaussures qui pourraient vous plaire</h1>
    <div class="col-span-4 sm:col-span-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 ">
        @foreach ($listchaussures as $chaussure)
            <div class="relative mx-auto w-80">
                <a href="{{ route('chaussures.show', $chaussure->id_chaussure) }}"
                    class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full">
                    <div class=" p-4  bg-white shadow w-80">
                        <div class="flex justify-center relative rounded-lg overflow-hidden h-96 w-72">
                            <div class="absolute inset-0 flex justify-center items-center ">
                                @if ($chaussure->image)
                                    <img src="{{ asset('storage/images/' . $chaussure->image->image_chaussure) }}"
                                        class="object-contain" alt="Image chaussure">
                                @endif
                            </div>
                            <div class="absolute flex flex-col top-0 right-0 p-3">
                                {{-- pour verifier si l'utilisateur a deja like cette chaussure ou non --}}
                                @if ($chaussure->wishlists()->where('id_utilisateur', Auth::id())->exists())
                                    <a href="{{ route('whislist.supprimerwhislist', $chaussure->id_chaussure) }}"
                                        class=" opacity-70 bg-red hover:opacity-100 cursor-pointer hover:text-red-600 shadow hover:shadow-md text-red-600  rounded-full w-8 h-8 text-center p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" fill="red" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('whislist.ajoutwhislist', $chaussure->id_chaussure) }}"
                                        class=" opacity-70 bg-white hover:opacity-100 cursor-pointer hover:text-red-600 shadow hover:shadow-md text-gray-500 rounded-full w-8 h-8 text-center p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                            <span
                                class="absolute top-0 left-0 inline-flex mt-3 ml-3 px-3 py-2 rounded-lg z-10 bg-green-600 text-sm font-medium text-white select-none">
                                En stock
                            </span>
                        </div>

                        <div class="mt-4">
                            <h2 class="font-medium text-base md:text-lg text-gray-800 line-clamp-2"
                                style="line-height: 1.2em; font-size: 1em;">
                                {{ $chaussure->modele }}
                            </h2>
                            <p class="mt-2 text-sm text-gray-800 line-clamp-1" title="New York, NY 10004, United States">
                                {{ $chaussure->marque }}
                            </p>
                        </div>
                        <div class="grid grid-cols-1">
                            <div class="flex items-center justify-start">
                                <p
                                    class="inline-block font-semibold text-primary whitespace-nowrap leading-tight rounded-xl">
                                    <span class="text-lg">{{ number_format($chaussure->prix, 2) }}</span>
                                    <span class="text-sm uppercase">
                                        CHF
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    @endif
@endsection
