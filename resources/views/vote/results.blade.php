<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Votação</title>
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
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1.5rem;
        }

        .champions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .champion {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .champion img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
        }

        .champion label {
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Votação Completa</h1>
        <h2>A função mais votada foi: {{ $mostVotedRole }}</h2>

        <h3>Campeões mais votados dessa função:</h3>
        <div class="champions">
            @foreach ($topThreeChampions as $champion)
                <div class="champion">
                    <img src="{{ app('App\Http\Controllers\VoteController')->getChampionImage($champion) }}"
                        alt="{{ $champion }}">
                    <label>{{ $champion }}</label>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
