@extends('layout.page')

@section('content')

    <section id="gerer-avis" class="bg-white">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <h2 class="text-center text-4xl font-bold tracking-tight sm:text-5xl">
                Gérer les avis des utilisateurs
            </h2>
            @if ($avisusers->count() > 0)
                <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-8">
                    @foreach ($avisusers as $avis)
                        <blockquote class="rounded-lg bg-gray-100 p-8">
                            <div class="flex items-center gap-4">
                                @if ($avis->user->genre == 'homme')
                                    <img class="h-16 w-16 rounded-full object-cover" src="storage/images/man.png"
                                        alt="Avatar">
                                @else
                                    <img class="h-16 w-16 rounded-full object-cover" src="storage/images/woman.png"
                                        alt="Avatar">
                                @endif
                                <div>
                                    <div class="flex justify-center gap-0.5 text-green-500">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $avis->etoile)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M10 0l3.09 6.31 6.92 1L14.09 11.25l1.54 7.03L10 14.36l-5.63 3.93L6.91 11.25.99 8.31l6.92-1L10 0z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M10 0l3.09 6.31 6.92 1L14.09 11.25l1.54 7.03L10 14.36l-5.63 3.93L6.91 11.25.99 8.31l6.92-1L10 0z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="mt-1 text-lg font-medium text-gray-700">
                                        {{ $avis->user->nom . ' ' . $avis->user->prenom }}</p>
                                    <p class="mt-1 text-sm font-light text-gray-400">
                                        {{ $avis->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <p class="line-clamp-2 sm:line-clamp-none mt-4 text-gray-500"> {{ $avis->commentaire }} </p>
                            <div class="flex items-center gap-x-4">
                                <form action="{{ route('avis.accepter', $avis->id_avis) }}" method="POST"
                                    onsubmit="scrollToSection('gerer-avis')">
                                    @csrf
                                    <button type="submit"
                                        class="text-green-500 hover:text-green-700 focus:outline-none">Accepter</button>
                                </form>

                                <form action="{{ route('avis.supprimer', $avis->id_avis) }}" method="POST"
                                    onsubmit="scrollToSection('gerer-avis')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 focus:outline-none">Supprimer</button>
                                </form>
                            </div>
                        </blockquote>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-lg text-center py-5">Trie des avis terminé.</p>
            @endif
        </div>
        <div class="flex justify-center py-3">
            {{ $avisusers->links() }}
        </div>
    </section>
@endsection
