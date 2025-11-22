@props(['customers'])

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                <table class="relative min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Address</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($customers as $customer)
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                <div class="flex items-center">
                                    <div class="ml-1">
                                        <div class="font-medium text-gray-900">{{ $customer->house }}</div>
                                        <div class="mt-1 text-gray-500">{{ $customer->street }}, {{ $customer->area }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                <div class="text-gray-900">{{ $customer->phone }}</div>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                @if($customer->deleted_at)
                                    <x-inactive-label />
                                @else
                                    <x-active-label />
                                @endif
                            </td>
                            <td class="py-4 pr-4 pl-3 text-sm whitespace-nowrap text-gray-500 text-center">
                                 <a class="cursor-pointer underline" href="{{ route('customers.show', $customer) }}">View Customer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-sm text-gray-500 text-center">
                                No customers found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
