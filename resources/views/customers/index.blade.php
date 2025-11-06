@extends('layout.app')

@section('pageTitle')
    <x-page-title title="Customers">
        <x-slot:actions>
            <x-primary-button :href="route('customers.create')">Add Customer</x-primary-button>
        </x-slot:actions>
    </x-page-title>
@endsection

@section('content')

    <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm outline-1 outline-black/2">
                    <table class="relative min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                <div class="flex items-center">
                                    <div class="size-11 shrink-0">
                                        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-11 rounded-full" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">Lindsay Walton</div>
                                        <div class="mt-1 text-gray-500">lindsay.walton@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                <div class="text-gray-900">Front-end Developer</div>
                                <div class="mt-1 text-gray-500">Optimization</div>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Active</span>
                            </td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Member</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">Courtney Henry</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Designer</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">courtney.henry@example.com</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Admin</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Courtney Henry</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">Tom Cook</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Director of Product</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">tom.cook@example.com</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Member</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Tom Cook</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">Whitney Francis</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Copywriter</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">whitney.francis@example.com</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Admin</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Whitney Francis</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">Leonard Krasner</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Senior Designer</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">leonard.krasner@example.com</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Owner</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Leonard Krasner</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-6">Floyd Miles</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Principal Designer</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">floyd.miles@example.com</td>
                            <td class="px-3 py-4 text-sm whitespace-nowrap text-gray-500">Member</td>
                            <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Floyd Miles</span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
