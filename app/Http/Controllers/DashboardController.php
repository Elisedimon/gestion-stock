<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\EntreeStock;
use App\Models\SortieStock;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduits = Produit::count();
        $totalCategories = Categorie::count();
        $totalFournisseurs = Fournisseur::count();
        $produitsStockFaible = Produit::whereColumn('stock_actuel', '<=', 'stock_minimum')->count();
        $dernieresEntrees = EntreeStock::with('produit')->latest()->take(5)->get();
        $dernieresSorties = SortieStock::with('produit')->latest()->take(5)->get();
        $alertes = Produit::whereColumn('stock_actuel', '<=', 'stock_minimum')->get();

        return view('dashboard', compact(
            'totalProduits',
            'totalCategories',
            'totalFournisseurs',
            'produitsStockFaible',
            'dernieresEntrees',
            'dernieresSorties',
            'alertes'
        ));
    }
}