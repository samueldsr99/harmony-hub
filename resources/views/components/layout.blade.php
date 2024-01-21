<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Harmony Hub | {{ $title ?? "" }}</title>

    <!-- JS Alpine scripting -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
<div class="pb-12">
    {{$slot}}
</div>
<x-footer></x-footer>
</body>

</html>
