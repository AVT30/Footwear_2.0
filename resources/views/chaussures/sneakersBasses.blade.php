@extends('layout.page')

@section('content')
    <h1> Mes chaussures</h1>
        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @if ($chaussures->count() > 0)
                @foreach ($chaussures as $chaussure )
                    <div class="rounded overflow-hidden shadow-lg">
                        <a href="{{ route('chaussures.show', ['id' => $chaussure->id_chaussure]) }}">
                            <img class="w-full" src="/mountain.jpg" alt="Mountain">
                        </a>
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $chaussure->modele }}</div>
                            <p class="text-gray-700 text-base">{{ $chaussure->marque }}</p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $chaussure->couleurS }}</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $chaussure->couleurP }}</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $chaussure->genre }}</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $chaussure->prix }} CHF</span>
                        </div>
                    </div>
                @endforeach
            @else
                    {{-- page a faire pour dire qu'il n'y pas d'artcile ou rien n'a été trouvé --}}
            @endif
        </div>
@endsection
