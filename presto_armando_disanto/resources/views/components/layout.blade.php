<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Presto.it</title>
</head>

<body>
    <x-navbar></x-navbar>
    <div class="min-vh-100">
        {{ $slot }}
    </div>
    <x-footer></x-footer>
</body>

</html>
