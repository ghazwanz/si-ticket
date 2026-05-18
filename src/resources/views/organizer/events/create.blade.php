@extends('layouts.organizer')
@section('title', 'Buat Acara Baru')
@section('page-title', 'Buat Acara Baru')

@section('content')
    @include('organizer.events.partials.form', [
        'event' => null,
        'categories' => $categories,
        'action' => route('organizer.events.store'),
        'method' => 'POST',
        'submitLabel' => 'Simpan Acara',
    ])
@endsection