<!-- resources/views/vote/step2.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votação - Etapa 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1.5rem;
        }

        .champion-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            /* Ajusta o grid */
            gap: 15px;
        }

        .champion {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .champion img {
            width: 60px;
            /* Tamanho reduzido */
            height: 60px;
            /* Tamanho reduzido */
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: border 0.2s ease;
        }

        .champion label {
            display: block;
            font-size: 14px;
            margin-top: 0.5rem;
            text-align: center;
        }

        .champion.selected img {
            border: 3px solid #4CAF50;
            /* Borda verde quando selecionado */
        }

        input[type="checkbox"] {
            display: none;
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
            margin-top: 1.5rem;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .container {
                padding: 1rem;
            }

            .champion img {
                width: 50px;
                /* Ícones ainda menores em telas menores */
                height: 50px;
            }

            .champion label {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Escolha 3 campeões para a função {{ $vote->role }}:</h1>

        <form action="{{ route('vote.storeStep2', $vote) }}" method="POST">
            @csrf

            <div class="champion-list">
                @foreach ($champions as $champion)
                    <div class="champion">
                        <input type="checkbox" name="champions[]" id="champion-{{ $champion }}"
                            value="{{ $champion }}">
                        <label for="champion-{{ $champion }}">
                            <img src="{{ app('App\Http\Controllers\VoteController')->getChampionImage($champion) }}"
                                alt="{{ $champion }}">
                            {{ $champion }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit">Finalizar Votação</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const maxSelection = 3;

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    // Contar quantos campeões foram selecionados
                    const selectedCount = document.querySelectorAll(
                        'input[type="checkbox"]:checked').length;

                    // Adicionar ou remover a classe 'selected' ao pai (.champion)
                    if (checkbox.checked) {
                        checkbox.closest('.champion').classList.add('selected');
                    } else {
                        checkbox.closest('.champion').classList.remove('selected');
                    }

                    // Desativar checkboxes se 3 já foram selecionados
                    if (selectedCount >= maxSelection) {
                        checkboxes.forEach(function(cb) {
                            if (!cb.checked) {
                                cb.disabled = true;
                            }
                        });
                    } else {
                        checkboxes.forEach(function(cb) {
                            cb.disabled = false;
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>