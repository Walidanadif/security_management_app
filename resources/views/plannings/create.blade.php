@extends('layouts.app')

@section('title', 'Ajouter un Planning')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-calendar-plus me-2"></i>
                        Ajouter un nouveau planning
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="/plannings">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label for="agent_id" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>
                                    Agent <span class="text-danger">*</span>
                                </label>
                                <select
                                    name="agent_id"
                                    id="agent_id"
                                    class="form-select form-select-lg @error('agent_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Choisir un agent --</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="site_id" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Site <span class="text-danger">*</span>
                                </label>
                                <select
                                    name="site_id"
                                    id="site_id"
                                    class="form-select form-select-lg @error('site_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Choisir un site --</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>
                                            {{ $site->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('site_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label for="date" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    Date <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="date"
                                    id="date"
                                    class="form-control form-control-lg @error('date') is-invalid @enderror"
                                    value="{{ old('date') }}"
                                    required
                                >
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="heure_debut" class="form-label fw-semibold">
                                    <i class="bi bi-clock me-1"></i>
                                    Heure début <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="time"
                                    name="heure_debut"
                                    id="heure_debut"
                                    class="form-control form-control-lg @error('heure_debut') is-invalid @enderror"
                                    value="{{ old('heure_debut') }}"
                                    required
                                >
                                @error('heure_debut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="heure_fin" class="form-label fw-semibold">
                                    <i class="bi bi-clock-fill me-1"></i>
                                    Heure fin <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="time"
                                    name="heure_fin"
                                    id="heure_fin"
                                    class="form-control form-control-lg @error('heure_fin') is-invalid @enderror"
                                    value="{{ old('heure_fin') }}"
                                    required
                                >
                                @error('heure_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="/plannings" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i> 
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> 
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
