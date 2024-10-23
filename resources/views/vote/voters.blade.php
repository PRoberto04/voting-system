<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Votantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .empty {
            text-align: center;
            font-size: 16px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Lista de Votantes</h1>

        @if ($voters->isEmpty())
            <p class="empty">Nenhum voto registrado ainda.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Função Votada</th>
                        <th>Campeões Escolhidos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($voters as $voter)
                        <tr>
                            <td>{{ $voter->name }}</td>
                            <td>
                                @foreach ($voter->votes as $vote)
                                    {{ $vote->role }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($voter->votes as $vote)
                                    {{ implode(', ', $vote->champions) }}
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
