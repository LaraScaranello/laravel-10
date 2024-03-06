
@extends('admin.layouts.app')

@section('title', "Editar Suporte: $support->subject ")

@section('header')

    <h1 class="text-lg text-black-500">Suporte: {{ $support->subject }}</h1>

@endsection

@section('content')
    <form action="{{ route('supports.update', $support->id) }}" method="POST">
        @method('PUT')
        @include('admin.supports.partials.form', [
            'support' => $support
        ])
    </form>
@endsection
