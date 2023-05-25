@extends('layout.page')

@section('content')
    <div class="flex justify-center px-6 my-12">
        <!-- Row -->
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
            <!-- Col -->
            <div class="w-full h-auto  hidden lg:block lg:w-5/12 bg-cover rounded-l-lg">
                @if ($chaussure->image)
                    <img src="{{ asset('storage/images/' . $chaussure->image->image_chaussure) }}" class="object-contain"
                        alt="Image chaussure">
                @endif
            </div>
            <!-- Col -->
            <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                <h3 class="pt-4 text-2xl text-center">Modifier la chaussure</h3>
                <form method="POST" action="{{ route('chaussures.modifierChaussure', $chaussure->id_chaussure) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="modele">
                            Modele
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="modele" name="modele" type="text" value="{{ $chaussure->modele }}" maxlength="30"
                            required>
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="marque">
                            Marque
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="marque" name="marque" type="text" value="{{ $chaussure->marque }}"required
                            maxlength="20">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="genre">
                            Genre
                        </label>
                        <select
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="genre" name="genre" value="{{ $chaussure->genre }}"required maxlength="20">
                            <option value="homme" {{ $chaussure->genre == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ $chaussure->genre == 'femme' ? 'selected' : '' }}>Femme</option>
                            <option value="mixte" {{ $chaussure->genre == 'mixte' ? 'selected' : '' }}>Mixte</option>
                        </select>
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="genre">
                            Type de chaussure
                        </label>
                        <select
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="type-chaussures" name="type-chaussures"value=" {{ $chaussure->id_list_types }}" required
                            maxlength="20">
                            <option value="" disabled selected>Sélectionnez le type de chaussure</option>
                            @foreach ($listTypeChaussures as $typeChaussure)
                                <option value="{{ $typeChaussure->id_list_types }}"
                                    {{ $chaussure->id_list_types == $typeChaussure->id_list_types ? 'selected' : '' }}>
                                    {{ $typeChaussure->type_chaussures }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="couleurP">
                            Couleur Primaire
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="couleurP" name="couleurP" type="text" value="{{ $chaussure->couleurP }}"required
                            maxlength="20">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="couleurS">
                            Couleur Secondaire
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="couleurS" name="couleurS" type="text" value="{{ $chaussure->couleurS }}"
                            maxlength="20">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="peix">
                            Prix
                        </label>
                        <input
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="prix" name="prix" type="text" value="{{ $chaussure->prix }}"required
                            maxlength="4">
                    </div>
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="rabais">
                            Rabais
                        </label>
                        <select
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="rabais" name="rabais">
                            <option value="" disabled selected>Sélectionnez un rabais</option>
                            @for ($i = 5; $i <= 75; $i += 5)
                                <option value="{{ $i }}" {{ $i == $pourcentage ? 'selected' : '' }}>
                                    {{ $i }}%
                                </option>
                            @endfor
                        </select>
                        @error('rabais')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 md:mr-2 md:mb-0">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="date">
                            Date
                        </label>
                        <div class="relative">
                            <input type="date" name="daterabaisexpiration" id="daterabaisexpiration"
                                class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                min="{{ date('Y-m-d') }}" value="{{ $rabais ? $rabais->expiration_rabais : '' }}">
                            @error('daterabaisexpiration')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-6 border-t" />
                    <div class="text-center">
                        <button type="submit"
                            class="btn btn-primary shadow bg-slate-900 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded">
                            Enregistrer
                        </button>
                </form>
                <form action="/chaussures/{{ $chaussure->id_chaussure }}/supprimer" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="text-center mt-4">
                        <button type="button"
                            class="btn btn-primary shadow bg-red-600 hover:bg-slate-600 text-white font-bold py-2 px-4 rounded"
                            onclick="openModal()">
                            Supprimer
                        </button>
                        <div id="myModal" class="fixed inset-0 z-10 overflow-y-auto hidden">
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="relative bg-white w-96 rounded-md shadow-lg">
                                    <div class="text-right">
                                        <button type="button"
                                            class="text-gray-500 hover:text-gray-800 absolute top-0 right-0 mt-4 mr-4"
                                            onclick="closeModal()">
                                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <p>Êtes-vous sûr de vouloir supprimer cette chaussure ?</p>
                                        <div class="mt-4 flex justify-end">
                                            <button type="button"
                                                class="btn btn-secondary bg-blue-100 hover:bg-blue-400 px-4 py-2 mr-4"
                                                onclick="closeModal()">Annuler</button>
                                            <form action="/chaussures/{{ $chaussure->id_chaussure }}/supprimer"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger px-4 py-2 bg-red-400 hover:bg-red-700">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- script pour l'ouverture et fermeture du pop up --}}
    <script>
        function openModal() {
            document.getElementById("myModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("myModal").classList.add("hidden");
        }
    </script>
@endsection
