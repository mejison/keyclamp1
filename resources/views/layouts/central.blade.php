<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>
<body class="bg-gray-100 h-screen antialiased font-sans">
    <nav class="bg-gray-900 py-2">
        <div class="container mx-auto flex justify-between">
            <div>
                <a href="/" class="block py-2 px-4 text-white font-medium">
                    Home
                </a>
            </div>
            <div class="flex">
                <a href="{{ route('central.tenants.login') }}" class="block py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    Login
                </a>
                <a href="{{ route('central.tenants.register') }}" class="block ml-2 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    Register
                </a>
            </div>
        </div>
    </nav>
    <div class="min-h-screen bg-gray-100">
        <div class="py-10">
            <main class="container mx-auto">
                <div class="max-w-7xl sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
  </div>
</body>
</html>
