<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EntreeStock extends Model
{
    protected $fillable = [
        'produit_id', 'quantite',
        'prix_unitaire', 'date_entree',
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