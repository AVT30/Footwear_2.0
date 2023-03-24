@extends('layout.page')

@section('content')

<div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
    <a href="#" class="text-2xl font-bold text-gray-800">Favoris</a>
</div>

<div class="grid sm:px-10 lg:grid-cols-1 lg:px-20 xl:px-32">
  <div class="px-4 pt-8">
    <p class="text-xl font-medium">Liste des favoris</p>
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
            <span class="float-right text-gray-400">42EU - 8.5US</span>
            <p class="text-lg font-bold">{{$chaussure->prix}} CHF </p>
            <div class="flex space-x-2">
                <a class="inline-block text-sm text-red-600 align-baseline hover:text-red-900" href="{{ route('whislist.supprimerwhislist', $chaussure->id_chaussure) }}">Supprimer</a>
                <a class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800" href="./index.html">Ajouter au panier</a>
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
