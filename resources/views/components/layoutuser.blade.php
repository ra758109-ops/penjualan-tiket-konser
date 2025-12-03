<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'KPOP TIX' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="bg-gray-900 text-white py-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold">KPOP TIX</h1>

            <ul class="flex space-x-8 font-medium">
                <li><a href="/" class="hover:text-purple-400">Home</a></li>
                <li><a href="/events" class="hover:text-purple-400">Events</a></li>
                <li><a href="/tickets" class="hover:text-purple-400">Tickets</a></li>
                <li><a href="/shop" class="hover:text-purple-400">Shop</a></li>
            </ul>

            <a href="/login" class="px-4 py-2 bg-purple-500 hover:bg-purple-600 rounded-lg">
                Login
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white text-center py-4 mt-16">
        © 2025 KPOP TIX. All rights reserved.
    </footer>

</body>
</html>
