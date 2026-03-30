@extends('layouts.app')
@section('titre', 'Produits')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-box me-2"></i>Liste des Produits</span>
        <a href="{{ route('produits.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nouveau Produit
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Référence</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Prix Achat</th>
                    <th>Prix Vente</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produits as $produit)
                <tr>
                    <td>{{ $produit->id }}</td>
                    <td><code>{{ $produit->reference }}</code></td>
                    <td><strong>{{ $produit->nom }}</strong></td>
                    <td>{{ $produit->categorie->nom ?? '-' }}</td>
                    <td>{{ number_format($produit->prix_achat, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }} F</td>
                    <td><span class="badge bg-secondary">{{ $produit->stock_actuel }}</span></td>
                    <td>
                        @if($produit->stock_actuel <= $produit->stock_minimum)
                            <span class="badge bg-danger">Stock Faible</span>
                        @else
                            <span class="badge bg-success">OK</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('produits.edit', $produit) }}"
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('produits.destroy', $produit) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        Aucun produit trouvé
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($produits->hasPages())
    <div class="card-footer">
        {{ $produits->links() }}
    </div>
    @endif
</div>
@endsection