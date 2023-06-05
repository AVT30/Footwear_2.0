@php
    use App\Models\Rabais;
@endphp

@extends('layout.page')

@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:pb-24 lg:px-8">
            <div class="max-w-xl">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Historique achats</h1>
                <p class="mt-2 text-sm text-gray-500">retrouvez tous vos achats faits sur notre boutique</p>
            </div>
            @foreach ($chaussuresParCommande as $numeroCommande => $commandes)
                <div class="mt-16">
                    <h2 class="sr-only">achats</h2>
                    <div class="space-y-20">
                        <div>
                            <div
                                class="bg-gray-200 rounded-lg py-6 px-4 sm:px-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 lg:space-x-8">
                                <dl
                                    class="divide-y divide-gray-200 space-y-6 text-sm text-gray-600 flex-auto sm:divide-y-0 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-x-6 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                    <div class="flex justify-between sm:block">
                                        <dt class="font-medium text-gray-900">Achat fait le</dt>
                                        <dd class="sm:mt-1">
                                            <time datetime="2021-01-22">{{ $commandes->first()->created_at }}</time>
                                        </dd>
                                    </div>
                                    <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                        <dt class="font-medium text-gray-900">Numéro de commande</dt>
                                        <dd class="sm:mt-1">{{ $numeroCommande }}</dd>
                                    </div>
                                    <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                        <dt>Total commande</dt>
                                        <dd class="sm:mt-1">{{ $commandes->first()->montant }} CHF</dd>
                                    </div>
                                </dl>
                                <a href="{{ route('commande.pdf', ['numeroCommande' => $numeroCommande]) }}"
                                    class="w-full flex items-center justify-center bg-white mt-6 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:mt-0">
                                    Imprimer commande
                                    <span class="sr-only">for order WU88191111</span>
                                </a>
                            </div>

                            <table class="mt-4 w-full text-gray-500 sm:mt-6">
                                <caption class="sr-only">Products</caption>
                                <thead class="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
                                    <tr>
                                        <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">Chaussure</th>
                                        <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Prix
                                        </th>
                                        <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Statut</th>
                                        <th scope="col" class="w-0 py-3 font-normal text-right">Info</th>
                                    </tr>
                                </thead>
                                <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                    @foreach ($commandes as $commande)
                                        <tr>
                                            <td class="py-6 pr-8">
                                                <div class="flex items-center">
                                                    <img src="{{ asset('storage/images/' . $commande->chaussure->image->image_chaussure) }}"
                                                        alt="{{ $commande->chaussure->modele }}"
                                                        class="w-16 h-16 object-center object-cover rounded mr-6">
                                                    <div>
                                                        <div class="font-medium text-gray-900">
                                                            {{ $commande->chaussure->modele }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- juste ici pour afficher le prix d'achat si ça été fait avec un rabais ou non. j'ai fait tout cela ici car en fait si j'essaye de prendre le prix depuis le controller, il va prendre le prix de base et pas le prix avec rabais car $commande->chaussure->prix prends le prix de la relation commande /chaussure donc le prix de base et non pas le prix que j'attribue dans le controller  --}}
                                            @if ($rabais = Rabais::where('id_chaussure', $commande->chaussure->id_chaussure)->first())
                                                <td class="hidden py-6 pr-8 sm:table-cell">
                                                    {{ number_format($commande->chaussure->prix - ($commande->chaussure->prix * $rabais->rabais) / 100, 2) }}
                                                    CHF</td>
                                            @else
                                                <td class="hidden py-6 pr-8 sm:table-cell">
                                                    {{ number_format($commande->chaussure->prix, 2) }} CHF</td>
                                            @endif
                                            <td class="hidden py-6 pr-8 sm:table-cell">{{ $commande->status }}</td>
                                            <td class="py-6 font-medium text-right whitespace-nowrap">
                                                <a class="text-indigo-600"
                                                    href="{{ route('chaussures.show', $commande->id_chaussure) }}"> voir
                                                    produit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
