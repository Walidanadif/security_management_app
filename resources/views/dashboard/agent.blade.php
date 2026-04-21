@extends('layouts.app')

@section('title', 'Dashboard Agent')

@section('content')
<div class="container-fluid px-4 py-4">

    <h1 class="h2 fw-bold mb-4">👮 Dashboard Agent</h1>

    {{-- STATUT DU JOUR --}}
    <div class="alert
        @if(!$todayPresence) alert-secondary
        @elseif($todayPresence->statut === 'present') alert-success
        @elseif($todayPresence->statut === 'retard') alert-warning
        @else alert-danger
        @endif
    ">
        @if(!$todayPresence)
            ⏳ Pas encore pointé aujourd’hui
        @elseif($todayPresence->statut === 'present')
            🟢 Vous êtes présent aujourd’hui
        @elseif($todayPresence->statut === 'retard')
            🟡 Vous êtes en retard aujourd’hui
        @else
            🔴 Vous êtes absent aujourd’hui
        @endif
    </div>

    {{-- STATS PERSONNELLES --}}
    <div class="row g-4 mb-4">

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <p class="text-muted">Présences (mois)</p>
                <h3>{{ $presentCount }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <p class="text-muted">Absences</p>
                <h3>{{ $absentCount }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <p class="text-muted">Retards</p>
                <h3>{{ $retardCount }}</h3>
            </div>
        </div>

    </div>

    {{-- PROCHAIN PLANNING --}}
    @if($nextPlanning)
        <div class="card shadow-sm mb-4">
            <div class="card-header fw-bold">
                📅 Prochain planning
            </div>
            <div class="card-body">
                <p><strong>Site :</strong> {{ $nextPlanning->site->nom ?? '—' }}</p>
                <p><strong>Date :</strong> {{ $nextPlanning->date }}</p>
                <p><strong>Heure :</strong> {{ $nextPlanning->heure_debut }} - {{ $nextPlanning->heure_fin }}</p>
            </div>
        </div>
    @endif

    {{-- HISTORIQUE RÉCENT --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            🧾 Historique récent
        </div>
        <div class="card-body p-0">
            <table class="table mb-0 table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lastPresences as $presence)
                    <tr>
                        <td>{{ $presence->date }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection