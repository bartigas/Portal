@extends('layouts.auth')

@section('content')
<div class="p-8">
    <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
            <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Sign in to {{ config('app.name') }}</h2>
    </div>

    <form class="space-y-6" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Email address
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                autocomplete="email" 
                required 
                value="{{ old('email') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 @error('email') border-red-500 @enderror"
            >
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Password
            </label>
            <input 
                id="password" 
                name="password" 
                type="password" 
                autocomplete="current-password" 
                required 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 @error('password') border-red-500 @enderror"
            >
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input 
                    id="remember-me" 
                    name="remember" 
                    type="checkbox" 
                    class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300"
                >
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                    Remember me
                </label>
            </div>

            @if (Route::has('password.request'))
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-700 transition duration-300">
                        Forgot password?
                    </a>
                </div>
            @endif
        </div>

        <div>
            <button 
                type="submit" 
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105"
            >
                Sign in
            </button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="mt-6 text-center border-t pt-6">
            <p class="text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700 transition duration-300">
                    Register here
                </a>
            </p>
        </div>
    @endif
</div>
@endsection
