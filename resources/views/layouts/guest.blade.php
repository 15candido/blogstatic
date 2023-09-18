<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Condensed&display=swap" rel="stylesheet">
    <!-- Links  css and js files -->
    @vite('resources/css/app.css')
</head>

<body>

    {{-- Menu navigation section --}}

    <head></head>

    {{-- Body section --}}
    <main class="antialiased w-full min-h-screen bg-white/80">
        {{ $slot }}
    </main>

    {{-- Footer section --}}
    <footer></footer>

</body>

</html>