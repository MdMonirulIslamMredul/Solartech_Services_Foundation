@extends('backend.layouts.app')

@section('title', __('Contact Messages'))

@section('content')
<x-backend.card>
  <x-slot name="header">
    @lang('Contact Messages List')
  </x-slot>
  <x-slot name="body">
    <livewire:backend.contacts-table />
  </x-slot>
</x-backend.card>
@endsection