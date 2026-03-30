<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::withCount('produits')->latest()->paginate(10);
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);
        Fournisseur::create($request->all());
        return redirect()->route('fournisseurs.index')
                         ->with('success', 'Fournisseur ajouté avec succès !');
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'adresse' => 'nullable|string',
        ]);
        $fournisseur->update($request->all());
        return redirect()->route('fournisseurs.index')
                         ->with('success', 'Fournisseur modifié avec succès !');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')
                         ->with('success', 'Fournisseur supprimé avec succès !');
    }
}