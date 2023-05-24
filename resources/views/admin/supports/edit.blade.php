@extends('layouts.app')

@section('title', 'Editar tópico')

@section('header')
    <h1 class="text-lg text-black-500 ">Editar Dúvida</h1>
@endsection

@section('content')
    <form action="{{ route('supports.update', $support->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.supports._partials.form')
    </form>
@stop
