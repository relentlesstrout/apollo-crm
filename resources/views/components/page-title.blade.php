@props([
    'title' => null,
    'description' => null,
])

<header class="mb-2">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="min-w-0 flex-1">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:truncate">
                    {{ $title ?? $slot }}
                </h1>
                @if($description)
                    <p class="mt-2 text-sm text-gray-600">{{ $description }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="mt-4 flex gap-3 md:mt-0 md:ml-4">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</header>
