@extends('layout.app')

@section('pageTitle')
    <x-page-title title="Manage Accounts">
        <x-slot:actions>
            <x-primary-button :href="route('admins.create')">Invite New Admin</x-primary-button>
        </x-slot:actions>
    </x-page-title>
@endsection

@section('content')
    <livewire:table.sortable-admin-table/>
@endsection

