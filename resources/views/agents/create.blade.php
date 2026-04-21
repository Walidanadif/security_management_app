@extends('layouts.app')

@section('title', 'Ajouter un agent')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Card principale -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-plus-fill me-2"></i>
                        Ajouter un nouvel agent
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="/agents">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="nom" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>
                                    Nom Complet <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="nom" 
                                    id="nom"
                                    class="form-control form-control-lg @error('nom') is-invalid @enderror" 
                                    placeholder="Ex: Jean Dupont"
                                    value="{{ old('nom') }}"
                                    required
                                    autofocus
                                >
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1"></i>
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="agent@example.com"
                                    value="{{ old('email') }}"
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6">
                                <label for="telephone" class="form-label fw-semibold">
                                    <i class="bi bi-telephone me-1"></i>
                                    Téléphone <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    name="telephone" 
                                    id="telephone"
                                    class="form-control @error('telephone') is-invalid @enderror" 
                                    placeholder="+33 6 12 34 56 78"
                                    value="{{ old('telephone') }}"
                                    required
                                >
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mot de passe -->
                            <div class="col-md-6 justify-content-center">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1"></i>
                                    Mot de passe <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        class="form-control @error('password') is-invalid @enderror" 
                                        placeholder="Minimum 8 caractères"
                                        required
                                    >
                                  
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                            <a href="/agents" class="btn btn-secondary">
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
