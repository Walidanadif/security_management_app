@extends('layouts.app')

@section('title', 'Pointage')

@section('content')

<div class="container-fluid px-4 py-4">

    <h4 class="mb-3">
        <i class="fas fa-clock text-primary me-2"></i>
        Pointage du {{ now()->format('d/m/Y') }}
    </h4>

    @if(!$available)
        <div class="alert alert-warning">
            {{ $message }}
        </div>

    @elseif($presence)
        <div class="alert alert-success">
            Pointage effectué :
            <strong>{{ ucfirst($presence->statut) }}</strong>
        </div>

    @else
        <div class="alert alert-info mb-3">
            <strong>Affectation en cours</strong><br>
            {{ $planning->heure_debut }} -> {{ $planning->heure_fin }}
        </div>

        <form method="POST" action="{{ route('agent.pointage.store') }}">
            @csrf
       <button type="submit" class="btn btn-primary btn-lg border border-primary text-white">
         <i class="fas fa-check-circle me-2"></i>
        Confirmer ma présence
       </button>


        </form>
    @endif

<hr class="my-4 opacity-75">

<div class="container-fluid px-0">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-dark fw-semibold">
                        <i class="fas fa-history me-2 text-primary"></i>
                        Historique des pointages
                    </h5>
                </div>

                <div class="card-body p-0">

                    @if(isset($historique) && count($historique) > 0)

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                            Date de pointage
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                            Site
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted" style="font-size: 0.75rem;">
                                            Horaire
                                        </th>
                                        <th class="px-4 py-3 fw-semibold text-uppercase text-muted text-center" style="font-size: 0.75rem;">
                                            Statut
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($historique as $h)
                                        <tr class="border-bottom">
                                            <td class="px-4 py-3">
                                                {{ \Carbon\Carbon::parse($h['date'])->format('d/m/Y') }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <span class="fw-semibold text-dark">
                                                    {{ $h['site_nom'] }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $h['heure_debut'] ?? '--' }}
                                                ->
                                                {{ $h['heure_fin'] ?? '--' }}
                                            </td>

                                            <td class="px-4 py-3 text-center">
                                                @if($h['statut'] === 'present')
                                                    <span class="badge bg-success px-3">
                                                        Présent
                                                    </span>
                                                @elseif($h['statut'] === 'retard')
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

                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-calendar-times fa-3x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted">Aucun pointage trouvé</h5>
                            <p class="text-muted mb-0">
                                Aucun historique de pointage disponible
                            </p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $historique->links() }}
</div>

@endsection