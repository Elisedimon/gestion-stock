<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport de Stock</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .header {
            background: #1a237e;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .header h1 { font-size: 20px; margin-bottom: 5px; }
        .header p { font-size: 11px; opacity: 0.8; }
        .header .date { float: right; text-align: right; }
        .stats {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .stat-box {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }
        .stat-box .number { font-size: 24px; font-weight: bold; color: #1a237e; }
        .stat-box .label { font-size: 10px; color: #666; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #1a237e;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        td { padding: 7px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        tr:nth-child(even) { background: #f9f9f9; }
        .badge-ok {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
        }
        .badge-low {
            background: #ffebee;
            color: #c62828;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="date">
            <strong>Date :</strong> {{ date('d/m/Y') }}<br>
            <strong>Heure :</strong> {{ date('H:i') }}
        </div>
        <h1>Rapport de Stock</h1>
        <p>ALL SOLUTION TECH — Système de Gestion de Stock</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <div class="number">{{ $produits->count() }}</div>
            <div class="label">Total Produits</div>
        </div>
        <div class="stat-box">
            <div class="number">{{ $produits->sum('stock_actuel') }}</div>
            <div class="label">Total Unités en Stock</div>
        </div>
        <div class="stat-box">
            <div class="number" style="color:#c62828">
                {{ $produits->filter(fn($p) => $p->stock_actuel <= $p->stock_minimum)->count() }}
            </div>
            <div class="label">Produits Stock Faible</div>
        </div>
        <div class="stat-box">
            <div class="number" style="color:#2e7d32">
                {{ number_format($produits->sum(fn($p) => $p->stock_actuel * $p->prix_vente), 0, ',', ' ') }} F
            </div>
            <div class="label">Valeur Totale Stock</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Référence</th>
                <th>Produit</th>
                <th>Catégorie</th>
                <th>Prix Achat</th>
                <th>Prix Vente</th>
                <th>Stock Actuel</th>
                <th>Stock Min</th>
                <th>Valeur Stock</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->reference }}</td>
                <td><strong>{{ $produit->nom }}</strong></td>
                <td>{{ $produit->categorie->nom ?? '-' }}</td>
                <td>{{ number_format($produit->prix_achat, 0, ',', ' ') }} F</td>
                <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }} F</td>
                <td><strong>{{ $produit->stock_actuel }}</strong></td>
                <td>{{ $produit->stock_minimum }}</td>
                <td>{{ number_format($produit->stock_actuel * $produit->prix_vente, 0, ',', ' ') }} F</td>
                <td>
                    @if($produit->stock_actuel <= $produit->stock_minimum)
                        <span class="badge-low">Stock Faible</span>
                    @else
                        <span class="badge-ok">OK</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Rapport généré automatiquement par ALL SOLUTION TECH — {{ date('d/m/Y à H:i') }}
    </div>
</body>
</html>