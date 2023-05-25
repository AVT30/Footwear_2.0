<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>PDF Commande</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>

<body class="font-sans">
    <header class="bg-gray-800 text-white py-4 px-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Footwear</h1>
        </div>
        <div>
            <p class="text-sm">Date: {{ date('d/m/Y') }}</p>
        </div>
    </header>

    <footer class="bg-gray-200 text-gray-700 py-2 px-6 text-center">
        <p>Footwear - Marchez jusqu'au étoiles</p>
    </footer>

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Détails de la commande</h1>

        <div class="grid grid-cols-2 gap-8 mb-6">
            <div class="text-right">
                <p class="text-sm">{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</p>
                <p class="text-sm">{{ $adresse->adresse }}</p>
                <p class="text-sm">{{ $adresse->code_postal }} {{ $adresse->ville }}</p>
                <p class="text-sm">{{ $adresse->pays->pays }}</p>
            </div>
            <div>
                <p class="text-sm">Commande No: #{{ $numeroCommande }}</p>
                <p class="text-sm">Date de commande: {{ date_format($datecommande, 'Y-m-d H:i') }}</p>
            </div>
        </div>


        <table class="w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left bg-gray-100">Chaussure</th>
                    <th class="py-2 px-4 text-left bg-gray-100">Marque</th>
                    <th class="py-2 px-4 text-left bg-gray-100">Genre</th>
                    <th class="py-2 px-4 text-left bg-gray-100">Statut</th>
                    <th class="py-2 px-4 text-left bg-gray-100">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                <tr>
                    <td class="py-4 px-4 text-sm">{{$commande->chaussure->modele}}</td>
                    <td class="py-4 px-4 text-sm">{{$commande->chaussure->marque}}</td>
                    <td class="py-4 px-4 text-sm">{{$commande->chaussure->genre}}</td>
                    <td class="py-4 px-4 text-sm">{{$commande->status}}</td>
                    <td class="py-4 px-4 text-sm">{{$commande->montant}} CHF</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-8 flex justify-end">
            <table class="w-1/3">
                <tr>
                    <td class="py-2 text-right pr-4">Total:</td>
                    <td class="py-2 text-right">{{$montant}} CHF</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
