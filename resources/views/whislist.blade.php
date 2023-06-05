@extends('layout.page')

@section('content')

<div class="grid sm:px-10 lg:grid-cols-1 lg:px-20 xl:px-32">
  <div class="px-4 pt-20">
    <div class="max-w-xl">
        <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Votre Wishlist</h1>
        <p class="mt-2 text-sm text-gray-500">Vous trouverez ici toutes les chaussures qui vous plaisent réunies au même endroit</p>
    </div>
    <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
        <ul>
            @if (count($chaussures) > 0)
            @foreach ($chaussures as $chaussure)
        <div class="flex flex-col rounded-lg bg-white sm:flex-row">
            @if($chaussure->image)
                <img src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="m-2 h-24 w-28 rounded-md border object-cover object-center" alt="Image chaussure" >
            @endif
            <div class="flex w-full flex-col px-4 py-4">
            <span class="font-semibold">{{$chaussure->modele}}</span>
            <span class="float-right text-gray-400">{{$chaussure->marque}}</span>
            <p class="text-lg font-bold">{{ number_format($chaussure->prix, 2) }} CHF</p>
            <div class="flex space-x-2">
                <a class="inline-block text-sm text-red-600 align-baseline hover:text-red-900" href="{{ route('whislist.supprimerwhislist', $chaussure->id_chaussure) }}">Supprimer</a>
                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800" href="{{ route('chaussures.show', $chaussure->id_chaussure) }}">Voir produit</a>

            </div>
            </div>
        </div>
            @endforeach
                </ul>
            @else
                <p>Votre wishlist est vide.</p>
            @endif
    </div>
  </div>
</div>

@endsection
