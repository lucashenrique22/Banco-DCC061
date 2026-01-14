<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Extrato Bancário</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

    <h1>Extrato Bancário</h1>

    <div class="info">
        <p><strong>Cliente:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Conta:</strong> {{ $account->account_number }}</p>
        <p><strong>Saldo Atual:</strong> R$ {{ number_format($account->balance, 2, ',', '.') }}</p>
        <p><strong>Data de emissão:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td>{{ $t->created_at->format('d/m/Y') }}</td>
                <td>{{ ucfirst($t->type) }}</td>
                <td>R$ {{ number_format($t->amount, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>