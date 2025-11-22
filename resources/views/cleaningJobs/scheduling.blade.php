@extends('layout.app')

@section('pageTitle')
    <x-page-title title="Scheduling" description="Jobs due over the next week" />
@endsection

@section('content') <div class="container mx-auto p-6"> <h1 class="text-2xl font-bold mb-4">Jobs Due</h1>

    <livewire:completed-button />

@endsection
