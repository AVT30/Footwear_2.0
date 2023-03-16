@extends('layout.page')

@section('content')
    <div class="">
        {{-- Carousel --}}
        @include('carousel.carousel')
    </div>
    {{-- Carousel pour les chasssures  --}}
    <div class="">
        @include('carousel.chaussures')
    </div>
@endsection
