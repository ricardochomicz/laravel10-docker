@extends('layouts.app')

@section('title', "Detalhes do tópico {{ $support->subject }}")

@section('header')
    <h1 class="text-lg text-black-500 my-4">Tópico {{ $support->subject }}</h1>
@endsection

@section('content')

    <div class="w-1/2 sm:w-auto md:w-full lg:w-32 xl:w-3/4 rounded overflow-hidden shadow-lg border border-gray-400">

        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $support->subject }}</div>
            <p class="text-gray-700 text-base">
                {{ $support->content }}
            </p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ getStatusSupport($support->status) }}</span>
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><small>Criado
                    em: </small>{{ \Carbon\Carbon::parse($support->created_at)->format('d/m/Y') }}</span>
            <span
                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><small>Atualizado
                    em: </small>{{ \Carbon\Carbon::parse($support->updated_at)->format('d/m/Y') }}</span>
        </div>
        <div class="flex">
            <div class="flex-initial p-2">
                <form action="{{ route('supports.destroy', $support->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Excluir</button>
                </form>
            </div>
            <div class="flex-initial p-4">
                <a href="{{ route('supports.index') }}"
                    class="shadow bg-gray-500 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Voltar</a>
            </div>

        </div>
    </div>
@stop
