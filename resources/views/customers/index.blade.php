@extends('layout.app')

@section('pageTitle')
    <x-page-title title="All Customers">
        <x-slot:actions>
            <x-primary-button :href="route('customers.create')">Add Customer</x-primary-button>
        </x-slot:actions>
    </x-page-title>
@endsection

@section('content')

    <livewire:table.filterable-customer-table />

@endsection
