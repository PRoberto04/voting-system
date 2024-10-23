<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo à Votação</title>
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
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 1.5rem;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bem-vindo à Votação</h1>
        <p>
            Ajude seu amigo Paulin a escolher qual rota e quais campeões ele irá usar
            durante essa season. Durante toda a season terei como primeira opção de rota a 
            que for mais votada e só poderei jogar com um dos três campeões mais votados.
            A única condição para não jogar com um desses campeões é uma comp das estrelas.
        </p>
        <ul>
            <li>Escolha uma rota com o seu coração</li>
            <li>Escolher três campões da rota que</li>
        </ul>
        <p>Quando estiver pronto, clique no botão abaixo para iniciar a votação!</p>
        <button>
            <a href="{{ route('vote.create') }}">Iniciar Votação</a>
        </button>
    </div>
</body>

</html>
