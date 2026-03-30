<?php

namespace App\Http\Controllers;

use App\Models\SortieStock;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SortieStockController extends Controller
{
    public function index()
    {
        $sorties = SortieStock::with(['produit', 'user'])->latest()->paginate(10);
        return view('sorties.index', compact('sorties'));
    }

    public function create()
    {
        $produits = Produit::where('stock_actuel', '>', 0)->get();
        return view('sorties.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id'    => 'required|exists:produits,id',
            'quantite'      => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
            'date_sortie'   => 'required|date',
            'note'          => 'nullable|string',
        ]);

        $produit = Produit::find($request->produit_id);

        if ($request->quantite > $produit->stock_actuel) {
            return back()->withErrors([
                'quantite' => 'Stock insuffisant ! Stock disponible : ' . $produit->stock_actuel
            ])->withInput();
        }

        DB::transaction(function () use ($request, $produit) {
            SortieStock::create([
                'produit_id'    => $request->produit_id,
                'quantite'      => $request->quantite,
                'prix_unitaire' => $request->prix_unitaire,
                'date_sortie'   => $request->date_sortie,
                'note'          => $request->note,
                'user_id'       => Auth::id(),
            ]);

            $produit->decrement('stock_actuel', $request->quantite);
        });

        return redirect()->route('sorties.index')
                         ->with('success', 'Sortie de stock enregistrée avec succès !');
    }

    public function destroy(SortieStock $sortie)
    {
        DB::transaction(function () use ($sortie) {
            $sortie->produit->increment('stock_actuel', $sortie->quantite);
            $sortie->delete();
        });

        return redirect()->route('sorties.index')
                         ->with('success', 'Sortie annulée avec succès !');
    }
}