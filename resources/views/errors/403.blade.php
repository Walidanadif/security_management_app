@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[70vh]">
    <div class="text-center">
        <h1 class="text-7xl font-bold text-red-600">403</h1>
        <p class="text-xl mt-4 font-semibold">Accès refusé</p>
        <p class="text-gray-600 mt-2">
            Vous n’avez pas les droits pour accéder à cette page.
        </p>

        <a href="{{ route('dashboard') }}"
           class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
            ⬅ Retour au dashboard
        </a>
    </div>
</div>
@endsection