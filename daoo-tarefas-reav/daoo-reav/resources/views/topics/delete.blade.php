<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tópicos</title>
</head>
<body>
    @if ($topic)
        <h2>{{ $topic->id }}</h2>
        <h1>{{ $topic->title }}</h1>
        <p>{{ $topic->content }}</p>
        <ul>
            <li>Categoria: {{ $topic->category }}</li>
            <li>Editado: {{ $topic->edited ? 'Sim' : 'Não' }}</li>
        </ul>
        <table>
            <tr>
                <td>
                    <form action="{{ route('topic.remove',$topic->id) }}" method='post'>
                        @csrf
                        <input type="submit" name='confirmar' value="Remover" />
                    </form>
                </td>
                <td>
                    <a href="/topics"><button>Cancelar</button></a>
                </td>
            </tr>
        </table>
    @else
        <p>Tópicos não encontrados! </p>
    @endif
    <a href="/topics">&#9664;Voltar</a>
</body>
</html>