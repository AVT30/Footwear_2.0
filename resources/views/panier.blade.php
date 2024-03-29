@extends('layout.page')

@section('content')

    <body>
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:pb-24 lg:px-8">
            <div class="max-w-xl">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Votre panier </h1>
                <p class="mt-2 text-sm text-gray-500">N'hezitez pas à remplir votre panier avec les meilleurs paires </p>
            </div>
            @if (count($items) > 0)
                <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                    <div class="rounded-lg md:w-2/3">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($items as $item)
                            <div class="rounded-lg mb-6 md:w-1/1 flex flex-col">
                                <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                                    @if ($item->attributes->image)
                                        <img class="h-36 w-36" src="{{ asset('storage/images/' . $item->attributes->image) }}"
                                            alt="Image of the selected chaussure">
                                    @endif
                                    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                        <div class="mt-5 sm:mt-0">
                                            <h2 class="text-lg font-bold text-gray-900">{{ $item->name }}</h2>
                                            <p class="mt-1 text-xs text-gray-700">Taille chaussure :
                                                {{ $item->attributes->taille }}</p>
                                            @if ($item->attributes->prixrabais)
                                                <p class="mt-1 text-xs text-red-600">
                                                    {{ number_format(floatval($item->attributes->prixrabais), 2) }} CHF
                                                <p class="mt-1 text-xs line-through text-gray-700">
                                                    {{ number_format(floatval($item->price), 2) }} CHF</p>
                                                </p>
                                            @else
                                                <p class="mt-1 text-xs text-gray-700">{{ number_format($item->price, 2) }}
                                                    CHF</p>
                                            @endif
                                        </div>
                                        <div
                                            class="mt-4 flex justify-between im sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                            <div class="flex items-center border-gray-100">
                                                <input type="number" name="quantity" id="quantity"
                                                    class="w-16 h-8 text-center text-gray-700 font-semibold rounded-lg border border-gray-300 focus:outline-none focus:border-indigo-500"
                                                    value="{{ $item->quantity }}" min="1" readonly>
                                            </div>
                                            <div class="flex justify-end">
                                                <a href="{{ route('supprimerArticle', ['id' => $item->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Sub total -->
                    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        <div class="flex justify-between">
                            <p class="text-lg font-bold">Total</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold">{{ number_format($totalpanier, 2) }} CHF</p>
                                <p class="text-sm text-gray-700">including VAT</p>
                            </div>
                        </div>
                        <a href="{{ route('adresse') }}" class="mt-6 w-50 rounded-md bg-blue-500 py-1.5 px-4 font-medium text-blue-50 hover:bg-blue-600 inline-block">Acheter</a>

                    </div>
                </div>
            @else
                <p class="text-center py-4 font-bold text-lg px-20">Votre panier est vide</p>
            @endif
        </div>
    </body>


@endsection
