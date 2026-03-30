@extends('layouts.app')
@section('titre', 'Entrées Stock')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-arrow-circle-down text-success me-2"></i>Entrées de Stock</span>
        <a href="{{ route('entrees.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nouvelle Entrée
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($entrees as $entree)
                <tr>
                    <td>{{ $entree->id }}</td>
                    <td><strong>{{ $entree->produit->nom ?? '-' }}</strong></td>
                    <td><span class="badge bg-success">+{{ $entree->quantite }}</span></td>
                    <td>{{ number_format($entree->prix_unitaire, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($entree->quantite * $entree->prix_unitaire, 0, ',', ' ') }} F</td>
                    <td>{{ \Carbon\Carbon::parse($entree->date_entree)->format('d/m/Y') }}</td>
                    <td>{{ $entree->note ?? '-' }}</td>
                    <td>
                        <form action="{{ route('entrees.destroy', $entree) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Annuler cette entrée ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Aucune entrée de stock
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($entrees->hasPages())
    <div class="card-footer">
        {{ $entrees->links() }}
    </div>
    @endif
</div>
@endsection