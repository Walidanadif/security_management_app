@extends('layouts.app')

@section('title', 'Liste des agents')

@section('content')

<div class="container-fluid px-4 py-4">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 mb-1 fw-bold text-dark">
                        <i class="fas fa-users text-primary me-2"></i>
                        Gestion des agents
                    </h1>
                </div>

                {{-- Bouton Ajouter : ADMIN UNIQUEMENT --}}
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('agents.create') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i>
                        Ajouter un agent
                    </a>
                @endif
            </div>
        </div>
    </div>
<form method="GET" action="{{ route('agents.index') }}" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Rechercher par nom complet..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> 
            </button>

            <a href="{{ route('agents.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-times me-1"></i> 
            </a>
        </div>
    </div>
</form>


    <!-- Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-dark fw-semibold">
                        <i class="fas fa-list me-2 text-primary"></i>
                        Liste des agents
                    </h5>
                </div>

                <div class="card-body p-0">

                    @if($agents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-user me-2"></i>Nom Complet
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-phone me-2"></i>Téléphone
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-envelope me-2"></i>Email
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-map-marker-alt me-2"></i>Adresse
                                        </th>

                                        {{-- Colonne Actions : ADMIN UNIQUEMENT --}}
                                        @if(auth()->user()->role === 'admin')
                                            <th class="px-4 py-3 text-uppercase text-muted text-center" style="font-size: .75rem;">
                                                <i class="fas fa-cog me-2"></i>Actions
                                            </th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($agents as $agent)
                                    <tr>

                                        <td class="px-4 py-3 fw-semibold">
                                            {{ $agent->nom }}
                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                            {{ $agent->telephone }}
                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                            {{ $agent->user->email ?? '—' }}
                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                            {{ $agent->adresse }}
                                        </td>

                                        {{-- Boutons Modifier / Supprimer : ADMIN UNIQUEMENT --}}
                                        @if(auth()->user()->role === 'admin')
                                        <td class="px-4 py-3 text-center">
                                            <div class="btn-group">

                                                <a href="{{ route('agents.edit', $agent->id) }}"
                                                   class="btn btn-sm btn-outline-warning"
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('agents.destroy', $agent->id) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Supprimer cet agent ?')"
                                                            title="Supprimer">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun agent trouvé</h5>

                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('agents.create') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Ajouter un agent
                                </a>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $agents->links() }}
</div>
@endsection