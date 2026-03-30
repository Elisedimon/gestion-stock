@extends('layouts.app')
@section('titre', 'Nouveau Fournisseur')

@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <i class="fas fa-plus me-2"></i>Nouveau Fournisseur
    </div>
    <div class="card-body">
        <form action="{{ route('fournisseurs.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom') }}" placeholder="Ex: SOBEMAP">
                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Téléphone</label>
                <input type="text" name="telephone" class="form-control"
                       value="{{ old('telephone') }}" placeholder="Ex: +229 97000000">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="Ex: contact@fournisseur.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Adresse</label>
                <textarea name="adresse" class="form-control" rows="2"
                          placeholder="Ex: Cotonou, Bénin">{{ old('adresse') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection