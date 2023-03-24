@extends('layout.page')

@section('content')

    @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
    @endif

<div class="flex justify-center px-6 my-12">
        <!-- Col -->
        <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
            <h3 class="pt-4 text-2xl text-center">Creation de chaussure</h3>
                <form  method="POST" action="{{ route('chaussures.creation')}}" enctype="multipart/form-data" class="max-w-md mx-auto my-8" >
                    <!-- Pour eviter les failles website (mettre nos input en hiden avec des token)-->
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Modele
                        </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="modele" name="modele" type="text" placeholder="Modele" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Marque
                        </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="marque" name="marque" type="text" placeholder="Marque" required>
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="genre">
                            Genre
                        </label>
                        <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="genre" name="genre" placeholder="Genre" required>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="mixte">Mixte</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Couleur Primaire
                        </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="couleurP" name="couleurP" type="text" placeholder=" Couleur Primaire" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Couleur Secondaire
                        </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="couleurS" name="couleurS" type="text" placeholder="Couleur Secondaire">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                            Prix
                        </label>
                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="prix" name="prix" type="number" placeholder="Prix" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="genre">
                            Type de chaussures
                        </label>
                    <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="type-chaussures" name="type-chaussures" placeholder="type de chaussures" required>
                        <option value="" disabled selected>Sélectionnez le type de chaussures</option>
                        @foreach($list_type_chaussures as $type_chaussure)
                    <option value="{{ $type_chaussure->id_list_types }}">{{ $type_chaussure->type_chaussures }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block font-medium text-gray-700 mb-2">Images</label>
                        <input type="file" id="images" name="images[]" multiple class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" accept="image/png, image/jpeg" required>
                        </div>
                    <hr class="mb-6 border-t" />
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary shadow bg-slate-900 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded">
                            Créer chaussure
                          </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
