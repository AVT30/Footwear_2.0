@extends('layout.page')

@section('content')
<div class="flex justify-center px-6 my-12">
    <!-- Row -->
    <div class="w-full xl:w-3/4 lg:w-11/12 flex">
        <!-- Col -->
        <div class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg">
            @if($chaussure->image)
                <img src="{{ asset('storage/images/'.$chaussure->image->image_chaussure) }}" class="object-contain" alt="Image chaussure" >
            @endif
        </div>
        <!-- Col -->
        <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">Modifier la chaussure</h3>
            <form method="POST" action="{{ route('chaussures.modifierChaussure', $chaussure->id_chaussure) }}">
                @csrf
                @method('PUT')
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Modele
                        </label>
                        <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="modele" name="modele" type="text" value="{{ $chaussure->modele }}">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Marque
                        </label>
                        <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="marque" name="marque" type="text" value="{{ $chaussure->marque }}">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="genre">
                            Genre
                        </label>
                        <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="genre" name="genre" value="{{ $chaussure->prix }}>
                            <option value="homme" {{ $chaussure->genre == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ $chaussure->genre == 'femme' ? 'selected' : '' }}>Femme</option>
                            <option value="mixte" {{ $chaussure->genre == 'mixte' ? 'selected' : '' }}>Mixte</option>
                        </select>
                    </div>
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                        Couleur Primaire
                    </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="couleurP" name="couleurP" type="text" value="{{ $chaussure->couleurP }}">
                </div>
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                        Couleur Secondaire
                    </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="modele" name="modele" type="text" value="{{ $chaussure->couleurS }}">
                </div>
                <div class="mb-4 md:mr-2 md:mb-0">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                        Prix
                    </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="prix" name="prix" type="text" value="{{ $chaussure->prix }}">
                </div>
                <hr class="mb-6 border-t" />
                <div class="text-center">
                    <button type="submit" class="btn btn-primary shadow bg-slate-900 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded">
                        Enregistrer
                      </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
