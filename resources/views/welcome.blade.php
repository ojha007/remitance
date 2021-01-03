<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased">
<div class="container mx-auto bg-purple-400 p-5">
    <nav class="flex justify-between">
        <div>
            <a href="#">Logo</a>
        </div>
        <ul class="flex flex-row">
            <li class="pr-5 hover:bg-black hover:text-white"><a > Services </a></li>
            <li class="pr-5"><a>Porfolio</a></li>
            <li class="pr-5"><a>About</a></li>
            <li><a>Contact</a></li>
        </ul>
    </nav>
</div>
</body>
</html>
