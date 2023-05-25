@extends('layout.page')

@section('content')
    <div class="container mx-auto">
        {{-- Carousel --}}
        @include('carousel.carousel')
    </div>
    {{-- Carousel pour les chaussures --}}
    <div class="container mx-auto">
        <div class="titreflux">
            <span>Nos dernières nouveautées</span>
        </div>
        @include('carousel.chaussures')
    </div>
@endsection
