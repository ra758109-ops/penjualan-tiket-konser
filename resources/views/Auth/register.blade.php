<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KPOP TIX</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">

    <div class="min-h-screen flex">

        <!-- Kiri: Form Registrasi -->
        <div class="flex-1 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-md w-full space-y-8">

                <div class="bg-white p-8 rounded-2xl shadow-lg">

                    <div>
                        <h2 class="text-center text-3xl font-bold text-blue-600">
                            KPOP TIX
                        </h2>
                        <h3 class="mt-2 text-center text-xl font-semibold text-gray-800">
                            Buat Akun Baru Anda
                        </h3>
                    </div>

                    {{-- FORM REGISTER --}}
                    <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-6">
                        @csrf

                        <div class="space-y-4">

                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    required
                                    value="{{ old('name') }}"
                                    class="w-full px-3 py-2.5 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    required
                                    value="{{ old('email') }}"
                                    class="w-full px-3 py-2.5 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan alamat email">
                            </div>

                            {{-- Password --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full px-3 py-2.5 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Buat password baru">
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    class="w-full px-3 py-2.5 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Ulangi password baru">
                            </div>

                        </div>

                        {{-- Error message --}}
                        @if ($errors->any())
                            <div class="text-red-500 text-sm">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        {{-- Tombol Daftar --}}
                        <button
                            type="submit"
                            class="w-full py-3 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700">
                            Daftar
                        </button>

                    </form>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Background Gambar -->
        <div class="hidden lg:block relative flex-1">
            <img class="absolute inset-0 w-full h-full object-cover" src="/image/bg5.jpg" alt="K-Pop Concert">
            <div class="absolute inset-0 bg-blue-900 bg-opacity-60"></div>

            <div class="relative min-h-full flex flex-col items-center justify-center p-12">
                <h2 class="text-4xl font-bold text-white text-center">
                    Temukan Konser Idola Anda.
                </h2>
                <p class="text-xl text-blue-200 mt-4 text-center">
                    Daftar sekarang dan dapatkan update event serta promo eksklusif.
                </p>
            </div>
        </div>

    </div>

</body>
</html>
