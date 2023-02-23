<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</head>
<body>
    {{-- Ajout d'un include ici pour le header et le footer pour eviter la repetition de code  --}}
    @include('HeaderFooter.header')
        {{-- code qui sert a lier les pages contenu avec le reste de la page (header et footer) --}}
        @yield('content')
    @include('HeaderFooter.footer')
</body>
</html>





