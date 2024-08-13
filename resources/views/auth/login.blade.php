<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        .login-banner {
            flex: 1;
            background: url('assets/img/latar.png') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .login-form {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 1rem;
        }
        .blur-logo {
            filter: blur(5px);
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 99, 22, 0.5); /* warna hijau dengan opasitas 50% */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .overlay h1 {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="antialiased">
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('alert') }}
    </div>
@endif

    <div class="login-container">
        <div class="login-banner">
            <div class="overlay">
                <img src="assets/img/man.png" alt="Logo" class="logo mx-auto mb-4">
                <h1>Selamat Datang di Perpustakaan MAN 1 Dumai</h1>
            </div>
        </div>
        <div class="login-form">
            <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-center text-xl font-bold mb-6" style="color: #006316;">Masuk Pemustaka</h1>
                
                <!-- Session Status -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- ID Anggota -->
                    <div class="mb-4">
                        <label for="id_anggota" class="block font-medium text-sm text-gray-700 mb-2">ID Anggota</label>
                        <input id="id_anggota" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 text-lg" type="text" name="email" :value="old('id_anggota')" required autofocus autocomplete="username" />
                        @error('id_anggota')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 mb-2">Kata Sandi</label>
                        <input id="password" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 text-lg" type="password" name="password" required autocomplete="current-password" />
                        @error('password')
                            <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Login with Google -->
                    <div class="mb-4">
                    <a href="{{ route('google.redirect') }}" class="w-full bg-white text-gray-800 py-2 px-4 border border-gray-300 rounded shadow-sm hover:bg-gray-100 flex items-center justify-center text-lg">
    <img src="https://img.icons8.com/color/16/000000/google-logo.png" class="mr-2" alt="Google Logo"/> Masuk dengan Google
</a>


                        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded shadow-sm hover:bg-green-700 mt-4 text-lg">
                            Masuk
                        </button>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
