@extends('layouts.app')

@section('title', 'Modifier un site')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Modifier le site
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="/sites/{{ $site->id }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="nom" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>
                                    Nom Complet
                                </label>
                                <input
                                    type="text"
                                    name="nom"
                                    id="nom"
                                    class="form-control form-control-lg"
                                    value="{{ old('nom', $site->nom) }}"
                                    required
                                >
                            </div>


                            <div class="col-md-6">
                                <label for="adresse" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Adresse
                                </label>
                                <input
                                    type="text"
                                    name="adresse"
                                    id="adresse"
                                    class="form-control"
                                    value="{{ old('adresse', $site->adresse) }}"
                                    required
                                >
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="/sites" class="btn btn-secondary">
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
