@extends('layout.page')

@section('content')
    <div class="container max-w-full">
        {{-- Carousel --}}
        @include('carousel.carousel')
    </div>
    {{-- Carousel pour les chaussures --}}
    <div class="container  relative width-full justify-center max-w-full">
        <div class="contenaireflux ">
            <span class="titreflux ">Nos dernières nouveautées</span>
        </div>
        @include('carousel.chaussures')
    </div>
@endsection
