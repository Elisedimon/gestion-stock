<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\Produit;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Utilisateur de démo
        User::create([
            'name'     => 'ALL SOLUTION TECH',
            'email'    => 'demo@gestionstock.com',
            'password' => Hash::make('demo1234'),
        ]);

        // Catégories
        $cat1 = Categorie::create(['nom' => 'Informatique', 'description' => 'Matériels informatiques']);
        $cat2 = Categorie::create(['nom' => 'Bureautique', 'description' => 'Fournitures de bureau']);
        $cat3 = Categorie::create(['nom' => 'Électronique', 'description' => 'Appareils électroniques']);

        // Fournisseurs
        $f1 = Fournisseur::create(['nom' => 'SOBEMAP', 'telephone' => '+229 64 07 06 36', 'email' => 'contact@sobemap.bj', 'adresse' => 'Cotonou, Bénin']);
        $f2 = Fournisseur::create(['nom' => 'TechImport', 'telephone' => '+229 97 00 00 00', 'email' => 'info@techimport.bj', 'adresse' => 'Parakou, Bénin']);

        // Produits
        Produit::create(['nom' => 'Ordinateur HP', 'reference' => 'HP-001', 'prix_achat' => 175000, 'prix_vente' => 200000, 'stock_actuel' => 10, 'stock_minimum' => 3, 'categorie_id' => $cat1->id, 'fournisseur_id' => $f1->id]);
        Produit::create(['nom' => 'Imprimante Canon', 'reference' => 'CN-001', 'prix_achat' => 85000, 'prix_vente' => 100000, 'stock_actuel' => 5, 'stock_minimum' => 2, 'categorie_id' => $cat1->id, 'fournisseur_id' => $f1->id]);
        Produit::create(['nom' => 'Ramette de papier A4', 'reference' => 'PP-001', 'prix_achat' => 3500, 'prix_vente' => 5000, 'stock_actuel' => 2, 'stock_minimum' => 5, 'categorie_id' => $cat2->id, 'fournisseur_id' => $f2->id]);
        Produit::create(['nom' => 'Clé USB 32GB', 'reference' => 'USB-001', 'prix_achat' => 5000, 'prix_vente' => 7500, 'stock_actuel' => 15, 'stock_minimum' => 5, 'categorie_id' => $cat3->id, 'fournisseur_id' => $f2->id]);
    }
}