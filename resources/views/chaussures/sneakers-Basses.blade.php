@extends('layout.page')

@section('content')
    <div class="p-10 grid grid-cols-4 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-5">
        <!-- Première partie: type de chaussure, ici on va afficher la liste des types de chaussures que nous proposons -->
        @include('chaussures.filtre')

        <!-- Deuxième partie: chaussures -->
        <div class="col-span-4 sm:col-span-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-x-96">
            @if ($chaussures->count() > 0)
              @foreach ($chaussures as $chaussure)
              @if($chaussure->type_chaussures === 'sneakers Basses')
                <div class="relative mx-auto w-80">
                    <a href="{{ route('chaussures.show', $chaussure->id_chaussure) }}" class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full">
                        <div class=" p-4  bg-white shadow w-80">
                            <div class="flex justify-center relative rounded-lg overflow-hidden h-96 w-72">
                                <div class="absolute inset-0 flex justify-center items-center ">
                                        @if($chaussure->image)
                                            <img src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="object-contain" alt="Image chaussure" >
                                        @endif
                                </div>
                                <div class="absolute flex flex-col top-0 right-0 p-3">
                                    {{-- pour verifier si l'utilisateur a deja like cette chaussure ou non --}}
                                    @if ($chaussure->wishlists()->where('id_utilisateur', Auth::id())->exists())
                                            <a href="{{ route('whislist.supprimerwhislist', $chaussure->id_chaussure) }}" class=" opacity-70 bg-red hover:opacity-100 cursor-pointer hover:text-red-700 shadow hover:shadow-md text-red-700  rounded-full w-8 h-8 text-center p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" fill="red" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                            </a>
                                    @else
                                        <a href="{{ route('whislist.ajoutwhislist', $chaussure->id_chaussure)}}" class=" opacity-70 bg-white hover:opacity-100 cursor-pointer hover:text-red-600 shadow hover:shadow-md text-gray-500 rounded-full w-8 h-8 text-center p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                              <span class="absolute top-0 left-0 inline-flex mt-3 ml-3 px-3 py-2 rounded-lg z-10 bg-green-600 text-sm font-medium text-white select-none">
                                En stock
                              </span>
                            </div>

                            <div class="mt-4">
                                <h2 class="font-medium text-base md:text-lg text-gray-800 line-clamp-2" style="line-height: 1.2em; font-size: 1em;">
                                {{ $chaussure->modele }}
                              </h2>
                              <p class="mt-2 text-sm text-gray-800 line-clamp-1" title="New York, NY 10004, United States">
                                {{ $chaussure->marque }}
                              </p>
                            </div>
                            <div class="grid grid-cols-1">
                            <div class="flex items-center justify-start">
                                <p class="inline-block font-semibold text-primary whitespace-nowrap leading-tight rounded-xl">
                                    <span class="text-lg">{{ $chaussure->prix }}</span>
                                    <span class="text-sm uppercase">
                                    CHF
                                    </span>
                                </p>
                            </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    @endif
                @endforeach
            @else
                    {{-- page a faire pour dire qu'il n'y pas d'artcile ou rien n'a été trouvé --}}
            @endif
        </div>
@endsection
