@extends('layouts.app')

@section('title', 'Liste des Plannings')

@section('content')

<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 mb-1 fw-bold text-dark">
                        <i class="bi bi-calendar-plus text-primary me-2"></i>

                        Gestion des plannings
                    </h1>
                  
                </div>
                <a href="/plannings/create" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i>
                    Ajouter un planning
                </a>
            </div>
        </div>
    </div>
<form method="GET" action="{{ route('plannings.index') }}" class="mb-4">
    <div class="row justify-content-center align-items-end g-2">

        <div class="col-md-3">
            <label class="form-label small text-muted">Agent ou Site</label>
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Nom agent ou site"
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-2">
            <label class="form-label small text-muted">Date</label>
            <input
                type="date"
                name="date"
                class="form-control"
                value="{{ request('date') }}"
            >
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> 
            </button>

            <a href="{{ route('plannings.index') }}" class="btn btn-secondary w-100">
                <i class="fas fa-times me-1"></i> 
            </a>
        </div>

    </div>
</form>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-dark fw-semibold">
                        <i class="fas fa-list me-2 text-primary"></i>
                        Liste des plannings
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(count($plannings) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                            <i class="fas fa-phone me-2"></i>Nom Agent
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                        <i class="bi bi-building "></i>Nom site
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-map-marker-alt me-2"></i>Adresse site
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-calendar-day me-2"></i>Date
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-hourglass-start me-2"></i>Heure debut
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-hourglass-end me-2"></i>Heure fin
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-cog me-2"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($plannings as $planning)
                                    <tr class="border-bottom">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                               
                                                <div>
                                                    <span class="fw-semibold text-dark">{{ $planning->agent->nom }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-muted">
                                        {{ $planning->site->nom }}

                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="text-muted">
                                       {{ $planning->site->adresse }}

                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="text-muted">
                                                {{ $planning->date }}

                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="text-muted">
                                                {{ $planning->heure_debut }}

                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="text-muted">
                                                {{ $planning->heure_fin }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="btn-group" role="group">
                                                <a href="/plannings/{{ $planning->id }}/edit" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Modifier"
                                                   data-bs-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/plannings/{{ $planning->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" 
                                                            type="submit"
                                                            title="Supprimer"
                                                            data-bs-toggle="tooltip"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce planning ?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-user-slash fa-3x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted">Aucun planning trouvé</h5>
                            <p class="text-muted mb-3">Commencez par ajouter votre premier planning</p>
                            <a href="/plannings/create" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Ajouter un planning
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $plannings->links() }}
</div>



@endsection
