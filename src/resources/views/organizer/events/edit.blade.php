@extends('layouts.organizer')
@section('title', 'Edit Acara')
@section('page-title', 'Edit Acara')

@section('content')
    @include('organizer.events.partials.form', [
        'event' => $event,
        'categories' => $categories,
        'action' => route('organizer.events.update', $event),
        'method' => 'PUT',
        'submitLabel' => 'Simpan Perubahan',
    ])
@endsection
