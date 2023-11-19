<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Harmony Hub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
    <main>
        <section class="w-full py-12 md:py-24 lg:py-32 xl:py-48">
            <div class="container mx-auto px-4 md:px-6">
                    <div class="flex flex-col items-center space-y-4 text-center">
                        <div class="space-y-2">
                            <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none">
                                Welcome to Harmony Hub
                            </h1>
                            <p class="mx-auto max-w-[700px] text-zinc-500 md:text-xl dark:text-zinc-400">
                                Your ultimate platform for create, share, and discover playlists.
                            </p>
                        </div>
                        <div class="space-x-4">
                            <button class="bg-zinc-900 text-white px-5 py-2 rounded-md hover:bg-zinc-800 dark:bg-zinc-50 dark:text-zinc-900">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
