<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\EntreeStock;
use App\Models\SortieStock;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{
    public function stock()
    {
        $produits = Produit::with(['categorie', 'fournisseur'])->get();

        $pdf = Pdf::loadView('rapports.stock', compact('produits'))
                  ->setPaper('a4', 'landscape');

        $filename = 'rapport-stock-' . date('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }

    public function mouvements()
    {
        $entrees      = EntreeStock::with('produit')->latest()->get();
        $sorties      = SortieStock::with('produit')->latest()->get();
        $totalEntrees = $entrees->sum('quantite');
        $totalSorties = $sorties->sum('quantite');

        $pdf = Pdf::loadView('rapports.mouvements', compact(
            'entrees', 'sorties', 'totalEntrees', 'totalSorties'
        ))->setPaper('a4', 'portrait');

        $filename = 'rapport-mouvements-' . date('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }
}
