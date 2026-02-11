<div>
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

        <div class="flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                        <table class="relative min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th wire:click="sortBy('email')" scope="col" class="cursor-pointer py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Email
                                    @if ($sortColumn === 'email')
                                        {{ $sortDirection === 'asc' ? '↑' : '↓'}}
                                    @endif
                                </th>
                                <th wire:click="sortBy('created_at')" scope="col" class="cursor-pointer px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Created At
                                    @if ($sortColumn === 'created_at')
                                        {{ $sortDirection === 'asc' ? '↑' : '↓'}}
                                    @endif
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($admins as $admin)
                                <tr>
                                    <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="ml-1">
                                                <div class="font-medium text-gray-900">{{ $admin->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                        <div class="text-gray-900">{{ $admin->created_at }}</div>
                                    </td>
                                    <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                        @if($admin->deleted_at)
                                            <x-inactive-label />
                                        @else
                                            <x-active-label />
                                        @endif
                                    </td>
                                    <td class="py-4 pr-4 pl-3 text-sm whitespace-nowrap text-gray-500 text-left">
                                        <a class="cursor-pointer underline" href="{{ route('admins.show', $admin) }}">View Customer</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-3 py-4 text-sm text-gray-500 text-center">
                                        No admins found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="m-4">
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
