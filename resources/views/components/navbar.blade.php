<nav class="border-b border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <img src="{{ asset('logo.png') }}" alt="Apollo CRM" class="h-14 w-auto" />
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    <x-nav-link href="{{ url('/') }}" :active="request()->is('/') || request()->is('')" >
                        Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('customers.index') }}" :active="request()->is('customers*')">
                        Customers
                    </x-nav-link>
                    <x-nav-link href="{{ route('cleaningJobs.index') }}" :active="request()->is('cleaningJobs*')">
                        Jobs
                    </x-nav-link>
                    <x-nav-link href="{{ route('scheduling') }}" :active="request()->is('scheduling*')">
                        Scheduling
                    </x-nav-link>
                </div>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600" aria-controls="mobile-menu" aria-expanded="false" data-mobile-menu-toggle>
                    <span class="sr-only">Open main menu</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="h-6 w-6">
                        <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden sm:hidden">
        <div class="space-y-1 pt-2 pb-3">
            <x-nav-link variant="mobile" href="{{ url('/') }}" :active="request()->is('/') || request()->is('')">
                Dashboard
            </x-nav-link>
            <x-nav-link variant="mobile" href="{{ route('customers.index') }}" :active="request()->is('customers*')">
                Customers
            </x-nav-link>
            <x-nav-link variant="mobile" href="{{ route('cleaningJobs.index') }}" :active="request()->is('cleaningJobs*')">
                Jobs
            </x-nav-link>
            <x-nav-link variant="mobile" href="{{ route('scheduling') }}" :active="request()->is('scheduling*')">
                Scheduling
            </x-nav-link>
        </div>
    </div>
</nav>

@once
    @push('scripts')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('[data-mobile-menu-toggle]').forEach((toggle) => {
                    toggle.addEventListener('click', () => {
                        const targetId = toggle.getAttribute('aria-controls');
                        const menu = document.getElementById(targetId);
                        if (!menu) {
                            return;
                        }

                        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                        toggle.setAttribute('aria-expanded', (!isExpanded).toString());
                        menu.classList.toggle('hidden', isExpanded);
                    });
                });
            });
        </script>
    @endpush
@endonce
