@extends('layout.page')

@section('content')
    @foreach ($chaussures as $chaussure)

        <table>
            <ul>
                <li>
                    <p>{{ $chaussure->modele }}</p>
                </li>
            </ul>
        </table>


    @endforeach
@endsection
