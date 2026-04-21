@extends('layouts.app')

@section('title', 'Liste des sites')

@section('content')

<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 mb-1 fw-bold text-dark">
                <i class="bi bi-building text-primary me-2"></i>

                            Gestion des sites
                    </h1>
                  
                </div>
                <a href="/sites/create" class="btn btn-primary btn-lg shadow-sm">
                    <i class="fas fa-plus-circle me-2"></i>
                    Ajouter un sites
                </a>
            </div>
        </div>
    </div>
<form method="GET" action="{{ route('sites.index') }}" class="mb-4">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Rechercher par nom du site..."
                value="{{ request('search') }}"
            >
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> 
            </button>

            <a href="{{ route('sites.index') }}" class="btn btn-secondary w-100">
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
                        Liste des sites
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(count($sites) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                           <i class="bi bi-building me-2"></i>Nom du site
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                            <i class="fas fa-map-marker-alt me-2"></i>Adresse
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            <i class="fas fa-cog me-2"></i>Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($sites as $site)
                                    <tr class="border-bottom">
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                               
                                                <div>
                                                    <span class="fw-semibold text-dark">{{ $site->nom }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="text-muted">
                                                {{ $site->adresse }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="btn-group" role="group">
                                                <a href="/sites/{{ $site->id }}/edit" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Modifier"
                                                   data-bs-toggle="tooltip">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="/sites/{{ $site->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" 
                                                            type="submit"
                                                            title="Supprimer"
                                                            data-bs-toggle="tooltip"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce site ?')">
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
                            <h5 class="text-muted">Aucun site trouvé</h5>
                            <p class="text-muted mb-3">Commencez par ajouter votre premier site</p>
                            <a href="/sites/create" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Ajouter un site
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
                        <div class="d-flex justify-content-center mt-4">
                                 {{ $sites->links() }}
                        </div>



@endsection
