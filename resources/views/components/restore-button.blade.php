<form action="{{ $link }}" method="POST" class="inline-flex items-center"
      onsubmit="return confirm('Restore this item?')">
    @csrf
    @method('PATCH')
    <button type="submit"
            class="inline-flex items-center gap-1 text-green-600 hover:text-green-800 font-medium text-sm transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 15l-3-3m0 0l3-3m-3 3h12a6 6 0 1 1 0 12" />
        </svg>
        Restore
    </button>
</form>
