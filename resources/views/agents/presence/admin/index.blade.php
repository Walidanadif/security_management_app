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
                        Liste de presence
                    </h1>
                </div>

               
            </div>
        </div>
    </div>
<form method="GET" action="{{ route('admin.presence') }}" class="mb-4">
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

        <!-- Boutons -->
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> 
            </button>

            <a href="{{ route('admin.presence') }}" class="btn btn-secondary w-100">
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
                        Liste de presence
                    </h5>
                </div>

                <div class="card-body p-0">

                    @if($presences->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-user me-2"></i>Agent
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="bi bi-building me-2"></i>Nom Site
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-calendar-day me-2"></i>Date
                                        </th>

                                        <th class="px-4 py-3 text-uppercase text-muted" style="font-size: .75rem;">
                                            <i class="fas fa-user-slash text-danger"></i>Status
                                        </th>

                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($presences as $presence)
                                    <tr>

                                        <td class="px-4 py-3 fw-semibold">
                                            {{ $presence->agent?->nom ?? '—' }}

                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                            {{ $presence->agent?->plannings?->first()?->site?->nom ?? '—' }}


                                        </td>
    
                                        <td class="px-4 py-3 text-muted">
                                            {{ $presence->date}}
                                        </td>

                                        <td class="px-4 py-3 text-muted">
                                                @if($presence['statut'] === 'present')
                                                    <span class="badge bg-success px-3">
                                                        Présent
                                                    </span>
                                                @elseif($presence['statut'] === 'retard')
                                                    <span class="badge bg-warning text-dark px-3">
                                                        Retard
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger px-3">
                                                        Absent
                                                    </span>
                                                @endif
                                            </td>


                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                  
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-4">
    {{ $presences->links() }}
</div>
@endsection