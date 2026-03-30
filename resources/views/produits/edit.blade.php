@extends('layouts.app')
@section('titre', 'Modifier Produit')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">
        <i class="fas fa-edit me-2"></i>Modifier le Produit
    </div>
    <div class="card-body">
        <form action="{{ route('produits.update', $produit) }}" method="POST">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $produit->nom) }}">
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Référence <span class="text-danger">*</span></label>
                    <input type="text" name="reference"
                           class="form-control @error('reference') is-invalid @enderror"
                           value="{{ old('reference', $produit->reference) }}">
                    @error('reference')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Catégorie <span class="text-danger">*</span></label>
                    <select name="categorie_id" class="form-select">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('categorie_id', $produit->categorie_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fournisseur <span class="text-danger">*</span></label>
                    <select name="fournisseur_id" class="form-select">
                        @foreach($fournisseurs as $f)
                            <option value="{{ $f->id }}"
                                {{ old('fournisseur_id', $produit->fournisseur_id) == $f->id ? 'selected' : '' }}>
                                {{ $f->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix Achat (FCFA)</label>
                    <input type="number" name="prix_achat" step="0.01"
                           class="form-control"
                           value="{{ old('prix_achat', $produit->prix_achat) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix Vente (FCFA)</label>
                    <input type="number" name="prix_vente" step="0.01"
                           class="form-control"
                           value="{{ old('prix_vente', $produit->prix_vente) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock Actuel</label>
                    <input type="number" name="stock_actuel" class="form-control"
                           value="{{ old('stock_actuel', $produit->stock_actuel) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock Minimum</label>
                    <input type="number" name="stock_minimum" class="form-control"
                           value="{{ old('stock_minimum', $produit->stock_minimum) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description', $produit->description) }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection