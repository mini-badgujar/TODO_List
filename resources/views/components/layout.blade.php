<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="m-5 p-5 bg-slate-900">
    {{-- <img class="h-auto w-96 mx-auto" src="{{ asset('storage/todo.png') }}" />
 --}}

    {{ $slot }}
</body>

</html>
