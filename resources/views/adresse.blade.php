@extends('layout.page')

@section('content')
<div class="max-w-screen-xl mx-auto px-5 bg-white min-h-sceen">

	<div class="grid divide-y divide-neutral-200 max-w-xl mx-auto mt-8">
		<div class="py-5">
            <details class="group">
                <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                    <span>Adresses</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                {{-- juste pour expliquer disposition un peu farfelu ou j'ai crée un script pour supprimer une adresse car j'ai eu des soucis avec la suppresion d adresse par la voie classique --}}
                @if ($adresses->count() > 0)
                <form id="delete-form" action="{{ route('adresses.destroy', 0) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" hidden class="px-4 py-2 text-sm text-red-600 hover:bg-gray-100 hover:text-red-800 rounded-lg">Delete</button>
                </form>

                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <div class="space-y-4">
                        @foreach ($adresses as $adresse)
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="adresse_id" value="{{ $adresse->id_adresse }}" required>
                                    <span class="ml-2">{{ $adresse->adresse }} {{ $adresse->code_postal }} {{ $adresse->ville }} {{ $adresse->pays->pays }}</span>
                                </label>
                                <div class="flex space-x-4">
                                    <a href="{{ route('adresse', $adresse->id_adresse) }}" class="px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 hover:text-blue-800 rounded-lg">Edit</a>
                                    <button type="button" class="px-4 py-2 text-sm text-red-600 hover:bg-gray-100 hover:text-red-800 rounded-lg delete-button" data-id="{{ $adresse->id_adresse }}">Delete</button>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex justify-center">
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuer</button>
                        </div>
                    </div>
                </form>


                    @else
                    <p>Vous n'avez pas encore d'adresse enregistrée. Veuillez en ajouter une en cliquant sur le bouton juste en dessous</p>
                @endif
            </details>
        </div>

		<div class="py-5">
			<details class="group">
				<summary class="flex justify-between items-center font-medium cursor-pointer list-none">
					<span>Ajouter une nouvelle adresse</span>
					<span class="transition group-open:rotate-180">
                <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
              </span>
				</summary>
				<div class="flex justify-center px-6 my-12">
                    <!-- Col -->
                    <div class="w-full lg:w-1/1 bg-white p-5 rounded-lg lg:rounded-l-none">
                        <h3 class="pt-4 text-2xl text-center">Nouvelle adresse</h3>
                            <form  method="POST" action="{{ route('creationadresse')}}" class="max-w-md mx-auto my-8" >
                                <!-- Pour eviter les failles website (mettre nos input en hiden avec des token)-->
                                @csrf
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">Nom</label>
                                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="nom" name="nom" type="text" value="{{ $user->nom }}" readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">Prenom</label>
                                    <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="prenom" name="prenom" type="text" value="{{ $user->prenom }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        Adresse
                                    </label>
                                <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="adresse" name="adresse" type="text" placeholder=" Adresse" maxlength="30" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        NPA
                                    </label>
                                <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="npa" name="npa" type="number" placeholder="NPA" maxlength="8" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        Ville
                                    </label>
                                <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="ville" name="ville" type="text" placeholder="Ville" maxlength="20" required>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        Pays
                                    </label>
                                    <select class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="pays" name="pays" placeholder="Pays de domicile" required>
                                        <option value="" disabled selected>Sélectionnez votre pays domicile</option>
                                        @foreach($pays as $unPays)
                                            <option value="{{ $unPays->id_pays }}" {{ ($unPays->id_pays == $user->id_pays) ? 'selected' : '' }}>{{ $unPays->pays }}</option>
                                        @endforeach
                                    </select>
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
			</details>
		</div>
	</div>

</div>

<script>
    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteForm = document.getElementById('delete-form');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const adresseId = button.getAttribute('data-id');
            deleteForm.action = deleteForm.action.replace('0', adresseId);
            deleteForm.submit();
        });
    });
</script>


@endsection
