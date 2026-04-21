@extends('layouts.app')

@section('title', 'Ajouter un site')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-building text-white me-2"></i>
                        Ajouter un nouvel site
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="/sites">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="nom" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>
                                    Nom de site <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nom" 
                                    id="nom"
                                    class="form-control form-control-lg @error('nom') is-invalid @enderror" 
                                    placeholder="Ex: Site Principal"
                                    value="{{ old('nom') }}"
                                    required
                                    autofocus
                                >
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 just">
                                <label for="adresse" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    Adresse <span class="text-danger">*</span>
                                </label>
                                <textarea 
                                    name="adresse" 
                                    id="adresse"
                                    class="form-control @error('adresse') is-invalid @enderror" 
                                    rows="3"
                                    placeholder="123 Rue de la Paix, 75001 Paris"
                                    required
                                >{{ old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
