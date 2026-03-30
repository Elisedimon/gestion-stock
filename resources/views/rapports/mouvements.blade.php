<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Mouvements</title>
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
        .date { float: right; text-align: right; }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 10px;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .entree-title { background: #e8f5e9; color: #2e7d32; }
        .sortie-title { background: #ffebee; color: #c62828; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1a237e; color: white; padding: 8px; font-size: 11px; }
        td { padding: 7px 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        tr:nth-child(even) { background: #f9f9f9; }
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
        <h1>Rapport des Mouvements de Stock</h1>
        <p>ALL SOLUTION TECH — Système de Gestion de Stock</p>
    </div>

    <div class="section-title entree-title">
        &gt;&gt; Entrées de Stock — Total : {{ $totalEntrees }} unités
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Date</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entrees as $entree)
            <tr>
                <td>{{ $entree->id }}</td>
                <td>{{ $entree->produit->nom ?? '-' }}</td>
                <td>+{{ $entree->quantite }}</td>
                <td>{{ number_format($entree->prix_unitaire, 0, ',', ' ') }} F</td>
                <td>{{ number_format($entree->quantite * $entree->prix_unitaire, 0, ',', ' ') }} F</td>
                <td>{{ \Carbon\Carbon::parse($entree->date_entree)->format('d/m/Y') }}</td>
                <td>{{ $entree->note ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center">Aucune entrée</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title sortie-title">
        &gt;&gt; Sorties de Stock — Total : {{ $totalSorties }} unités
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Date</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sorties as $sortie)
            <tr>
                <td>{{ $sortie->id }}</td>
                <td>{{ $sortie->produit->nom ?? '-' }}</td>
                <td>-{{ $sortie->quantite }}</td>
                <td>{{ number_format($sortie->prix_unitaire, 0, ',', ' ') }} F</td>
                <td>{{ number_format($sortie->quantite * $sortie->prix_unitaire, 0, ',', ' ') }} F</td>
                <td>{{ \Carbon\Carbon::parse($sortie->date_sortie)->format('d/m/Y') }}</td>
                <td>{{ $sortie->note ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center">Aucune sortie</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Rapport généré automatiquement par ALL SOLUTION TECH — {{ date('d/m/Y à H:i') }}
    </div>
</body>
</html>