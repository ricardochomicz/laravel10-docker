@extends('layouts.app')

@section('title', 'Criar novo tópico')

@section('header')
    <h1 class="text-lg text-black-500 ">Nova Dúvida</h1>
@endsection

@section('content')

    <form action="{{ route('supports.store') }}" method="POST">
        @csrf
        @include('admin.supports._partials.form')
    </form>
@stop
