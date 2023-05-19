@extends('layout.page')

@section('content')
    <div class="">
        {{-- Carousel --}}
        @include('carousel.carousel')
    </div>
    {{-- Carousel pour les chasssures  --}}
    <div class="">
        <h1 class=""> Voici les derniers articles que vous avons en vente !!!</h1>
        @include('carousel.chaussures')
    </div>
@endsection
