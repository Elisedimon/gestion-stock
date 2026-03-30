@extends('layouts.app')
@section('titre', 'Nouvelle Sortie Stock')

@section('content')
<div class="card" style="max-width:600px">
    <div class="card-header">
        <i class="fas fa-arrow-circle-up text-danger me-2"></i>Nouvelle Sortie de Stock
    </div>
    <div class="card-body">
        <form action="{{ route('sorties.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Produit <span class="text-danger">*</span></label>
                <select name="produit_id" class="form-select @error('produit_id') is-invalid @enderror">
                    <option value="">-- Choisir un produit --</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}"
                            {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                            {{ $produit->nom }} (Stock: {{ $produit->stock_actuel }})
                        </option>
                    @endforeach
                </select>
                @error('produit_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Quantité <span class="text-danger">*</span></label>
                <input type="number" name="quantite" min="1"
                       class="form-control @error('quantite') is-invalid @enderror"
                       value="{{ old('quantite') }}" placeholder="Ex: 2">
                @error('quantite')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Prix Unitaire (FCFA) <span class="text-danger">*</span></label>
                <input type="number" name="prix_unitaire" step="0.01"
                       class="form-control @error('prix_unitaire') is-invalid @enderror"
                       value="{{ old('prix_unitaire') }}" placeholder="Ex: 200000">
                @error('prix_unitaire')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Date de sortie <span class="text-danger">*</span></label>
                <input type="date" name="date_sortie"
                       class="form-control @error('date_sortie') is-invalid @enderror"
                       value="{{ old('date_sortie', date('Y-m-d')) }}">
                @error('date_sortie')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Note</label>
                <textarea name="note" class="form-control" rows="2"
                          placeholder="Observation optionnelle...">{{ old('note') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('sorties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection