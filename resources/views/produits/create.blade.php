@extends('layouts.app')
@section('titre', 'Nouveau Produit')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">
        <i class="fas fa-plus me-2"></i>Nouveau Produit
    </div>
    <div class="card-body">
        <form action="{{ route('produits.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" placeholder="Ex: Ordinateur HP">
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Référence <span class="text-danger">*</span></label>
                    <input type="text" name="reference"
                           class="form-control @error('reference') is-invalid @enderror"
                           value="{{ old('reference') }}" placeholder="Ex: HP-001">
                    @error('reference')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Catégorie <span class="text-danger">*</span></label>
                    <select name="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror">
                        <option value="">-- Choisir --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fournisseur <span class="text-danger">*</span></label>
                    <select name="fournisseur_id" class="form-select @error('fournisseur_id') is-invalid @enderror">
                        <option value="">-- Choisir --</option>
                        @foreach($fournisseurs as $f)
                            <option value="{{ $f->id }}" {{ old('fournisseur_id') == $f->id ? 'selected' : '' }}>
                                {{ $f->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('fournisseur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix Achat (FCFA) <span class="text-danger">*</span></label>
                    <input type="number" name="prix_achat" step="0.01"
                           class="form-control @error('prix_achat') is-invalid @enderror"
                           value="{{ old('prix_achat') }}" placeholder="0">
                    @error('prix_achat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix Vente (FCFA) <span class="text-danger">*</span></label>
                    <input type="number" name="prix_vente" step="0.01"
                           class="form-control @error('prix_vente') is-invalid @enderror"
                           value="{{ old('prix_vente') }}" placeholder="0">
                    @error('prix_vente')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock Actuel <span class="text-danger">*</span></label>
                    <input type="number" name="stock_actuel"
                           class="form-control @error('stock_actuel') is-invalid @enderror"
                           value="{{ old('stock_actuel', 0) }}">
                    @error('stock_actuel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock Minimum <span class="text-danger">*</span></label>
                    <input type="number" name="stock_minimum"
                           class="form-control @error('stock_minimum') is-invalid @enderror"
                           value="{{ old('stock_minimum', 5) }}">
                    @error('stock_minimum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="2"
                              placeholder="Description optionnelle...">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </form>
    </div>
</div>
@endsection