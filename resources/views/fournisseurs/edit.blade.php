@extends('layouts.app')
@section('titre', 'Modifier Fournisseur')

@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <i class="fas fa-edit me-2"></i>Modifier le Fournisseur
    </div>
    <div class="card-body">
        <form action="{{ route('fournisseurs.update', $fournisseur) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom', $fournisseur->nom) }}">
                @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Téléphone</label>
                <input type="text" name="telephone" class="form-control"
                       value="{{ old('telephone', $fournisseur->telephone) }}">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $fournisseur->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Adresse</label>
                <textarea name="adresse" class="form-control" rows="2">{{ old('adresse', $fournisseur->adresse) }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection