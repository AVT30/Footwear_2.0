{{-- page pour l'inscription --}}
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- genre -->
        <div>
            <x-input-label for="genre" :value="__('genre')" />
            <select id="genre" name="genre" class="block mt-1 w-full" ng-model="selectedGenre" required autofocus>
                <option value="">Sélectionnez un genre</option>
                <option value="Monsieur">Homme</option>
                <option value="Madame">Femme</option>
            </select>
            <x-input-error :messages="$errors->get('genre')" class="mt-2" />
        </div>


        <!-- non -->
        <div>
            <x-input-label for="nom" :value="__('nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="nom" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- prenom -->
        <div>
            <x-input-label for="prenom" :value="__('prenom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- mdp -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- confirmation du mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmez le Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- captcha -->
        <div class="mt-4">
            <x-input-label for="captcha" :value="__('Captcha')" />
            <div class="captcha">
                <span>{!! captcha_img() !!}</span>
                <button type="button" class="btn btn-danger" class="reload" id="reload">
                    &#x21bb;
                </button>
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="captcha_input" :value="__('Captcha Input')" />
            <x-text-input id="captcha_input" class="block mt-1 w-full"
                            type="text"
                            name="captcha" required />
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Dejà menbre ?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Inscription') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
