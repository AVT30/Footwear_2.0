@extends('layout.page')

@section('content')
    <div class="container mx-auto">
        {{-- Carousel --}}
        @include('carousel.carousel')
    </div>
    {{-- Carousel pour les chaussures --}}
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Voici les derniers articles que nous avons en vente !!!</h1>
        @include('carousel.chaussures')
    </div>
@endsection
