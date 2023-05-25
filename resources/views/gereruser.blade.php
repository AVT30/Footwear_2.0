@extends('layout.page')

@section('content')
    <section class="container px-4 mx-auto py-10">
        <h2 class="text-center text-4xl py-4 font-bold tracking-tight sm:text-5xl">
            Tableau des utilisateurs
        </h2>
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <input type="checkbox"
                                                class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                            <button class="flex items-center gap-x-2">
                                                <span>ID utilisateur</span>
                                            </button>
                                        </div>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Date d'inscription
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        statut
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        utilisateur
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Genre
                                    </th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @foreach ($users as $user)
                                    <tr>
                                        <td
                                            class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                                <input type="checkbox"
                                                    class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                <span>{{ $user->id_utilisateur }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ $user->created_at }}</td>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                            @if ($user->isActive == true)
                                                <div
                                                    class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-emerald-500 bg-emerald-100/60 dark:bg-gray-800">
                                                    <h2 class="text-sm font-normal">Actif</h2>
                                                </div>
                                            @else
                                                <div
                                                    class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 text-red-500 bg-red-100/60 dark:bg-gray-800">
                                                    <h2 class="text-sm font-normal">Désactivé</h2>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            <div class="flex items-center gap-x-2">
                                                @if ($user->genre == 'homme')
                                                    <img class="object-cover w-8 h-8 rounded-full"
                                                        src="storage/images/man.png" alt="Avatar">
                                                @else
                                                    <img class="object-cover w-8 h-8 rounded-full"
                                                        src="storage/images/woman.png" alt="Avatar">
                                                @endif
                                                <div>
                                                    <h2 class="text-sm font-medium text-gray-800 dark:text-white ">
                                                        {{ $user->prenom }} {{ $user->nom }}</h2>
                                                    <p class="text-xs font-normal text-gray-600 dark:text-gray-400">
                                                        {{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{ $user->genre }}</td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            @if ($user->isActive == true)
                                                <div class="flex items-center gap-x-6">
                                                    <form
                                                        action="{{ route('gerer-users.desactiver', ['id' => $user->id_utilisateur]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="text-red-400 transition-colors duration-200 hover:text-red-700 focus:outline-none">
                                                            Désactiver
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-x-6">
                                                    <form
                                                        action="{{ route('gerer-users.activer', ['id' => $user->id_utilisateur]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="text-green-400 transition-colors duration-200 hover:text-green-700 focus:outline-none">
                                                            Activer
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            {{ $users->links() }}
        </div>
    </section>
@endsection
