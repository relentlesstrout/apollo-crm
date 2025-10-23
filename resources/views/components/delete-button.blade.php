<form action="{{ $link }}" method="POST" class="inline-flex items-center"
      onsubmit="return confirm('Delete this item?')">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 font-medium text-sm transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Delete
    </button>
</form>
