@extends('layout.app')

@section('pageTitle')
    <x-page-title title="Today's Jobs" />
@endsection

@section('content')
    <livewire:filterable-job-cards/>
@endsection
