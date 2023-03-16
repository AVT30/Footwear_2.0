@extends('layout.page')

@section('content')

@if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
@endif

<form  method="POST" action="{{ route('chaussures.creation')}}" enctype="multipart/form-data" class="max-w-md mx-auto my-8" >
    <!-- Pour eviter les failles website (mettre nos input en hiden avec des token)-->
    @csrf
    <div class="mb-4">
      <label for="modele" class="block font-medium text-gray-700 mb-2">Modèle:</label>
      <input type="text" id="modele" name="modele" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
    </div>
    <div class="mb-4">
      <label for="marque" class="block font-medium text-gray-700 mb-2">Marque:</label>
      <input type="text" id="marque" name="marque" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
    </div>
    <div class="mb-4">
      <label for="genre" class="block font-medium text-gray-700 mb-2">Genre:</label>
      <select id="genre" name="genre" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
        <option value="homme">Homme</option>
        <option value="femme">Femme</option>
        <option value="mixte">Mixte</option>
      </select>
    </div>
    <div class="mb-4">
      <label for="couleurP" class="block font-medium text-gray-700 mb-2">Couleur Primaire:</label>
      <input type="text" id="couleurP" name="couleurP" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
    </div>
    <div class="mb-4">
      <label for="couleurS" class="block font-medium text-gray-700 mb-2">Couleur Secondaire:</label>
      <input type="text" id="couleurS" name="couleurS" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full">
    </div>
    <div class="mb-4">
      <label for="prix" class="block font-medium text-gray-700 mb-2">Prix:</label>
      <input type="number" id="prix" name="prix" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
    </div>
    <div class="mb-4">
      <label for="images" class="block font-medium text-gray-700 mb-2">Images:</label>
      <input type="file" id="images" name="images[]" multiple class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" accept="image/png, image/jpeg" required>
    </div>
    <div class="mb-4">
      <label for="type-chaussures" class="block font-medium text-gray-700 mb-2">Type de Chaussures:</label>
      <select id="type-chaussures" name="type-chaussures" class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full" required>
        <option value="" disabled selected>Sélectionnez le type de chaussures</option>
        @foreach($list_type_chaussures as $type_chaussure)
      <option value="{{ $type_chaussure->id_list_types }}">{{ $type_chaussure->type_chaussures }}</option>
        @endforeach
      </select>
    </div>
        <div class="text-center">
          <button type="submit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Créer la paire de chaussures</button>
        </div>
      </form>



@endsection
