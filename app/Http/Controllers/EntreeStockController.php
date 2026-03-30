<?php

namespace App\Http\Controllers;

use App\Models\EntreeStock;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntreeStockController extends Controller
{
    public function index()
    {
        $entrees = EntreeStock::with(['produit', 'user'])->latest()->paginate(10);
        return view('entrees.index', compact('entrees'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('entrees.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id'    => 'required|exists:produits,id',
            'quantite'      => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'date_entree'   => 'required|date',
            'note'          => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            EntreeStock::create([
                'produit_id'    => $request->produit_id,
                'quantite'      => $request->quantite,
                'prix_unitaire' => $request->prix_unitaire,
                'date_entree'   => $request->date_entree,
                'note'          => $request->note,
                'user_id'       => Auth::id(),
            ]);

            // Mettre à jour le stock du produit
            $produit = Produit::find($request->produit_id);
            $produit->increment('stock_actuel', $request->quantite);
        });

        return redirect()->route('entrees.index')
                         ->with('success', 'Entrée de stock enregistrée avec succès !');
    }

    public function destroy(EntreeStock $entree)
    {
        DB::transaction(function () use ($entree) {
            // Décrémenter le stock
            $entree->produit->decrement('stock_actuel', $entree->quantite);
            $entree->delete();
        });

        return redirect()->route('entrees.index')
                         ->with('success', 'Entrée supprimée avec succès !');
    }
}