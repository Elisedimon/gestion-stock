<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SortieStock extends Model
{
    protected $fillable = [
        'produit_id', 'quantite',
        'prix_unitaire', 'date_sortie',
        'note', 'user_id'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}