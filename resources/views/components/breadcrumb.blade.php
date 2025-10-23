<nav class="text-gray-500 text-sm mb-4">
    <ol class="list-none m-0 p-0 flex">
        @foreach($item as $items)
            @if(!$loop->last)
                <li>
                    <a href=" {{ $item['url'] }}" class="text-blue-600 hover:underline">{{ $item['title'] }}</a>
                    <span class="mx-2">/</span>
                </li>
            @else()
                <li class="text-gray-700">{{ $item['title'] }}</li>
            @endif
        @endforeach
    </ol>
</nav>
