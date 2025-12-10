<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPOP TIX - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- LEFT SIDE - FORM -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6">
            <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-md">

                <h1 class="text-3xl font-bold text-center text-blue-700">KPOP TIX</h1>
                <p class="text-center text-gray-600 mt-2 mb-6 text-lg">Login ke Akun Anda</p>

                {{-- Error Message --}}
                @if ($errors->any())
                    <p class="text-red-600 text-sm mb-3">{{ $errors->first() }}</p>
                @endif

                @if (session('success'))
                    <p class="text-green-600 text-sm mb-3">{{ session('success') }}</p>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" name="email" placeholder="Masukkan alamat email"
                        class="w-full px-4 py-3 mt-1 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                        required>

                    <!-- Password -->
                    <label class="text-sm font-semibold">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password Anda"
                        class="w-full px-4 py-3 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                        required>

                    <a href="#" class="text-blue-600 text-sm mt-2 inline-block hover:underline">Lupa password?</a>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg mt-6">
                        Login
                    </button>
                </form>

                <p class="text-center text-gray-700 mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar gratis di sini</a>
                </p>
            </div>
        </div>

        <!-- RIGHT SIDE - IMAGE -->
        <div class="hidden md:block md:w-1/2 relative">
            <img src="/image/bg3.jpg" class="w-full h-full object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-center p-6">
                <div>
                    <h2 class="text-white text-4xl font-bold mb-4">Selamat Datang Kembali!</h2>
                    <p class="text-gray-200 text-lg max-w-md">
                        Login untuk melihat riwayat pesanan Anda dan checkout lebih cepat.
                    </p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
