<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação - Etapa 1</title>
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
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Votação - Etapa 1</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vote.step1') }}" method="POST">
            @csrf
            <label for="name">Nome:</label>
            <input type="text" name="name" placeholder="Seu nome" required>

            <label for="role">Escolha a função:</label>
            <select name="role" required>
                <option value="Toplaner">Toplaner</option>
                <option value="Jungler">Jungler</option>
                <option value="Midlaner">Midlaner</option>
                <option value="Adcarry">Adcarry</option>
                <option value="Support">Support</option>
            </select>

            <button type="submit">Próxima Etapa</button>
        </form>
    </div>
</body>

</html>
