<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en-GB">

<head>
    <meta charset="UTF-8" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Apollo CRM</title>
</head>

<body class="h-full">
<div class="min-h-screen bg-[#1a2b4a] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/colourlogo.png') }}" alt="Apollo Professional Window Cleaners" class="max-w-[600px] w-full h-auto mx-auto">
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h2>
            <p class="text-sm text-gray-600 mb-6">Sign in to continue to your dashboard</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="admin@apollocrm.com"
                        required
                        autofocus
                    >
                    @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-[#1a2b4a] hover:underline font-medium">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-[#1a2b4a] text-white px-4 py-2.5 text-sm font-medium rounded-lg hover:bg-[#2d4a7c] focus:ring-4 focus:ring-blue-300 transition-colors"
                >
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@stack('scripts')
</body>

</html>
