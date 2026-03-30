<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 'description', 'reference',
        'prix_achat', 'prix_vente',
        'stock_actuel', 'stock_minimum',
        'categorie_id', 'fournisseur_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function entreesStock()
    {
        return $this->hasMany(EntreeStock::class);
    }

    public function sortiesStock()
    {
        return $this->hasMany(SortieStock::class);
    }
}