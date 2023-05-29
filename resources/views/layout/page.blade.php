<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['public/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>

<body class="flex flex-col min-h-screen">
    <nav class="z-10 h-32 py-2">
        {{-- Ajout d'un include ici pour le header et le footer pour eviter la repetition de code  --}}
        @include('HeaderFooter.header')
    </nav>

    <main class="flex-grow container z-0 py-3 max-w-full" style="margin-top: auto;">
        @yield('content')
    </main>

    <footer class=" w-full bg-gray-200 p-4">
        @include('HeaderFooter.footer')
    </footer>
</body>

</html>
