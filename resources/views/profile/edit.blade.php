@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <div class="card shadow-sm border-0">

                <!-- Header -->
                <div class="card-header bg-primary text-white d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white text-primary fw-bold d-flex align-items-center justify-content-center"
                         style="width:50px; height:50px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                        <small class="opacity-75">{{ auth()->user()->role }}</small>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close"  data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div id="passwordError" class="alert alert-danger d-none">
                        Les mots de passe ne correspondent pas !
                    </div>

                    <form id="profileForm">
                        @csrf
                        @method('PATCH')

                        <!-- Nom -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-user me-2"></i>Nom complet</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" readonly>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-envelope me-2"></i>Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                        </div>

                        <hr>

                        <!-- Nouveau mot de passe -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold"><i class="fas fa-lock me-2"></i>Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control" placeholder="Laisser vide pour ne pas changer">
                        </div>

                        <!-- Confirmation -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="fas fa-lock me-2"></i>Confirmer mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary"><i class="fas fa-times me-1"></i></button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i></button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('profileForm');
  const password = form.querySelector('input[name="password"]');
  const confirm  = form.querySelector('input[name="password_confirmation"]');
  const errorDiv = document.getElementById('passwordError');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    if ((password.value || confirm.value) && password.value !== confirm.value) {
      errorDiv.classList.remove('d-none');
      return;
    }
    errorDiv.classList.add('d-none');

    const formData = new FormData(form); 

    try {
      const res = await fetch("{{ route('profile.update') }}", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
          "Accept": "application/json",
        },
        body: formData
      });

      if (!res.ok) {
        const data = await res.json().catch(() => null);
        console.error(data);
        alert("Erreur de validation (voir console).");
        return;
      }

      alert("Profil mis à jour !");
     
    } catch (err) {
      console.error(err);
      alert("Erreur réseau.");
    }
  });
});
</script>

@endsection

@endsection
