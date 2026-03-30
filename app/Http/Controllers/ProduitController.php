<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with(['categorie', 'fournisseur'])->latest()->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.create', compact('categories', 'fournisseurs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'           => 'required|string|max:255',
            'reference'     => 'required|string|unique:produits',
            'prix_achat'    => 'required|numeric|min:0',
            'prix_vente'    => 'required|numeric|min:0',
            'stock_actuel'  => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
            'categorie_id'  => 'required|exists:categories,id',
            'fournisseur_id'=> 'required|exists:fournisseurs,id',
        ]);
        Produit::create($request->all());
        return redirect()->route('produits.index')
                         ->with('success', 'Produit ajouté avec succès !');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        $fournisseurs = Fournisseur::all();
        return view('produits.edit', compact('produit', 'categories', 'fournisseurs'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom'           => 'required|string|max:255',
            'reference'     => 'required|string|unique:produits,reference,'.$produit->id,
            'prix_achat'    => 'required|numeric|min:0',
            'prix_vente'    => 'required|numeric|min:0',
            'stock_actuel'  => 'required|integer|min:0',
            'stock_minimum' => 'required|integer|min:0',
            'categorie_id'  => 'required|exists:categories,id',
            'fournisseur_id'=> 'required|exists:fournisseurs,id',
        ]);
        $produit->update($request->all());
        return redirect()->route('produits.index')
                         ->with('success', 'Produit modifié avec succès !');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')
                         ->with('success', 'Produit supprimé avec succès !');
    }
}