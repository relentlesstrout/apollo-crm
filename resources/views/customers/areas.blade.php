
@extends('layout.app')

@section('content')

    <div class="container mx-auto p-6">
        <x-breadcrumb :items="[
    ['title' => 'Areas', 'url' => route('customers.areas')],
]" />

        <div class="grid grid-cols-2 gap-6">
            @foreach ($areas as $area)
                <a href="{{ route('customers.index', $area) }}">
                <div class="h-50 relative rounded-lg overflow-hidden shadow-md">
                    <!-- Background Image -->
                    <div
                        class="absolute inset-0 bg-cover bg-center filter blur-sm"
                        style="background-image: url('/images/{{ $area }}.jpeg');">
                    </div>

                    <!-- Overlay with area title -->
                    <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                        <span class="text-xl font-bold text-white text-center">{{ $area }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
