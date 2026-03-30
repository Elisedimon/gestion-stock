@extends('layouts.app')
@section('titre', 'Tableau de bord')

@section('content')

{{-- CARTES STATISTIQUES --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:55px;height:55px;background:#e8eaf6">
                    <i class="fas fa-box fa-lg" style="color:#1a237e"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Produits</div>
                    <div class="fw-bold fs-4">{{ $totalProduits }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:55px;height:55px;background:#e8f5e9">
                    <i class="fas fa-tags fa-lg" style="color:#2e7d32"></i>
                </div>
                <div>
                    <div class="text-muted small">Catégories</div>
                    <div class="fw-bold fs-4">{{ $totalCategories }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:55px;height:55px;background:#fff3e0">
                    <i class="fas fa-truck fa-lg" style="color:#e65100"></i>
                </div>
                <div>
                    <div class="text-muted small">Fournisseurs</div>
                    <div class="fw-bold fs-4">{{ $totalFournisseurs }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                     style="width:55px;height:55px;background:#ffebee">
                    <i class="fas fa-exclamation-triangle fa-lg" style="color:#c62828"></i>
                </div>
                <div>
                    <div class="text-muted small">Stock Faible</div>
                    <div class="fw-bold fs-4">{{ $produitsStockFaible }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- BOUTONS RAPPORTS --}}
<div class="card mb-4">
    <div class="card-body d-flex gap-3 align-items-center">
        <span class="fw-semibold"><i class="fas fa-file-pdf text-danger me-2"></i>Exporter en PDF :</span>
        <a href="{{ route('rapports.stock') }}" target="_blank" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-download me-1"></i> Rapport Stock
        </a>
        <a href="{{ route('rapports.mouvements') }}" target="_blank" class="btn btn-outline-success btn-sm">
            <i class="fas fa-download me-1"></i> Rapport Mouvements
        </a>
    </div>
</div>

{{-- ALERTES STOCK FAIBLE --}}
@if($alertes->count() > 0)
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="fas fa-exclamation-triangle text-danger"></i>
        <span>Alertes Stock Faible</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Référence</th>
                    <th>Stock Actuel</th>
                    <th>Stock Minimum</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alertes as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td><code>{{ $produit->reference }}</code></td>
                    <td><span class="badge bg-danger">{{ $produit->stock_actuel }}</span></td>
                    <td>{{ $produit->stock_minimum }}</td>
                    <td>
                        <a href="{{ route('entrees.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Approvisionner
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- DERNIERS MOUVEMENTS --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-arrow-circle-down text-success"></i>
                <span>Dernières Entrées</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dernieresEntrees as $entree)
                        <tr>
                            <td>{{ $entree->produit->nom ?? '-' }}</td>
                            <td><span class="badge bg-success">+{{ $entree->quantite }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($entree->date_entree)->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Aucune entrée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-arrow-circle-up text-danger"></i>
                <span>Dernières Sorties</span>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dernieresSorties as $sortie)
                        <tr>
                            <td>{{ $sortie->produit->nom ?? '-' }}</td>
                            <td><span class="badge bg-danger">-{{ $sortie->quantite }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($sortie->date_sortie)->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Aucune sortie</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection