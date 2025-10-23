<nav class=" flex justify-center  p-5 space-x-2 bg-gray-800"    >
    <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>

    <x-nav-link href="{{ route('customers.index') }}" :active="request()->is('customers')">Customers</x-nav-link>

    <x-nav-link href="{{ route('cleaningJobs.index') }}" :active="request()->is('cleaningJobs')">Jobs</x-nav-link>

</nav>
