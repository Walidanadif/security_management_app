@extends('layouts.app')

@section('title', 'Mon historique')

@section('content')
<div class="container-fluid px-4">

    <h2 class="fw-bold mb-4">
        <i class="fas fa-history text-primary me-2"></i>
        Mon historique de présence
    </h2>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Site</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($presences as $presence)
                    <tr>
                        <td>{{ $presence->date }}</td>
                        <td>{{ $presence->agent?->plannings?->first()?->site?->nom ?? '—' }}</td>
                        <td>
                            @if($presence->statut === 'present')
                                <span class="badge bg-success">Présent</span>
                            @elseif($presence->statut === 'retard')
                                <span class="badge bg-warning text-dark">Retard</span>
                            @else
                                <span class="badge bg-danger">Absent</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            Aucun historique disponible
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $presences->links() }}
    </div>

</div>
@endsection