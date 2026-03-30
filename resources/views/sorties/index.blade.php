@extends('layouts.app')
@section('titre', 'Sorties Stock')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-arrow-circle-up text-danger me-2"></i>Sorties de Stock</span>
        <a href="{{ route('sorties.create') }}" class="btn btn-danger btn-sm">
            <i class="fas fa-plus me-1"></i> Nouvelle Sortie
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
                @forelse($sorties as $sortie)
                <tr>
                    <td>{{ $sortie->id }}</td>
                    <td><strong>{{ $sortie->produit->nom ?? '-' }}</strong></td>
                    <td><span class="badge bg-danger">-{{ $sortie->quantite }}</span></td>
                    <td>{{ number_format($sortie->prix_unitaire, 0, ',', ' ') }} F</td>
                    <td>{{ number_format($sortie->quantite * $sortie->prix_unitaire, 0, ',', ' ') }} F</td>
                    <td>{{ \Carbon\Carbon::parse($sortie->date_sortie)->format('d/m/Y') }}</td>
                    <td>{{ $sortie->note ?? '-' }}</td>
                    <td>
                        <form action="{{ route('sorties.destroy', $sortie) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Annuler cette sortie ?')">
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
                        Aucune sortie de stock
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($sorties->hasPages())
    <div class="card-footer">
        {{ $sorties->links() }}
    </div>
    @endif
</div>
@endsection