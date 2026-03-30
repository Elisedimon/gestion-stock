@extends('layouts.app')
@section('titre', 'Fournisseurs')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-truck me-2"></i>Liste des Fournisseurs</span>
        <a href="{{ route('fournisseurs.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nouveau Fournisseur
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Produits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fournisseurs as $fournisseur)
                <tr>
                    <td>{{ $fournisseur->id }}</td>
                    <td><strong>{{ $fournisseur->nom }}</strong></td>
                    <td>{{ $fournisseur->telephone ?? '-' }}</td>
                    <td>{{ $fournisseur->email ?? '-' }}</td>
                    <td>{{ $fournisseur->adresse ?? '-' }}</td>
                    <td><span class="badge bg-primary">{{ $fournisseur->produits_count }}</span></td>
                    <td>
                        <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce fournisseur ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Aucun fournisseur trouvé
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($fournisseurs->hasPages())
    <div class="card-footer">
        {{ $fournisseurs->links() }}
    </div>
    @endif
</div>
@endsection