<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en-GB">

<head>
    <meta charset="UTF-8" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Apollo CRM</title>
</head>

<body class="h-full">
<div class="min-h-full bg-gray-100">
    <x-navbar />

    <div class="py-10">
        @hasSection('pageTitle')
            @yield('pageTitle')
        @endif
        <main>
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
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
