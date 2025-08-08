@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login ke Akun Anda</h2>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input id="email" type="email"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input id="password" type="password"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember"
                       class="mr-2 leading-tight" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-gray-700 text-sm">
                    Remember Me
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                Login
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a class="text-blue-500 hover:underline text-sm" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                </div>
            @endif

            <div class="text-center mt-2">
                <a class="text-blue-500 hover:underline text-sm" href="{{ route('register') }}">
                    Belum punya akun? Daftar disini
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
