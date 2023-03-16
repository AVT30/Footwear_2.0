@extends('layout.page')

@section('content')
    <h1>{{ $chaussure->modele }}</h1>
    <p>Couleur : {{ $chaussure->couleurP }}</p>
    <p>Taille : {{ $chaussure->prix }}</p>
    <!-- etc. -->
@endsection


