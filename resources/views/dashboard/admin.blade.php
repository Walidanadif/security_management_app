@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <h1 class="h2 fw-bold mb-4">
        📊 Dashboard Admin
    </h1>

    {{-- ALERT ABSENCE --}}
    @if($absent > 0)
        <div class="alert alert-danger">
            ⚠️ {{ $absent }} agent(s) absent(s) aujourd’hui
        </div>
    @endif

    {{-- STATS --}}
    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <p class="text-muted mb-1">Agents</p>
                <h2 class="fw-bold">{{ $agentsCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <p class="text-muted mb-1">Sites</p>
                <h2 class="fw-bold">{{ $sitesCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <p class="text-muted mb-1">Plannings</p>
                <h2 class="fw-bold">{{ $planningsCount }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-4">
                <p class="text-muted mb-1">Présences aujourd’hui</p>
                <h2 class="fw-bold">{{ $todayPresences }}</h2>
            </div>
        </div>

    </div>

    {{-- GRAPH + TABLE --}}
    <div class="row">

        {{-- GRAPH --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    📊 Répartition des présences
                </div>
                <div class="card-body">
                    <canvas id="presenceChart"></canvas>
                </div>
            </div>
        </div>

        {{-- TABLE DERNIÈRES PRÉSENCES --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    🧾 Dernières présences
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Agent</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($lastPresences as $presence)
                            <tr>
                                <td>{{ $presence->agent?->nom ?? '—' }}</td>
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

    </div>

</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('presenceChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Présent', 'Retard', 'Absent'],
            datasets: [{
                data: [
                    {{ $present }},
                    {{ $retard }},
                    {{ $absent }}
                ],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection