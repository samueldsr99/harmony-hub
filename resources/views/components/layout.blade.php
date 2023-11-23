<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Harmony Hub | {{ $title ?? "" }}</title>

    <!-- JS Alpine scripting -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            plugins: [require('@tailwindcss/forms')]
        }
    </script>
</head>

<body class="bg-white">
    <div class="pb-12">
        {{$slot}}
    </div>
    <x-footer></x-footer>
</body>

</html>
