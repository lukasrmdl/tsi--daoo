<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comentários</title>
</head>
<body>
    @if ($comment)
        <h1>{{ $comment->id }}</h1>
        <p>{{ $comment->text }}</p>
        <ul>
            <li>Curtidas: {{ $comment->likes }}</li>
            <li>Descurtidas: {{ $comment->dislikes }}</li>
            <li>Editado: {{ $comment->edited ? 'Sim' : 'Não' }}</li>
        </ul>
    @else
        <p>Comentários não encontrados! </p>
    @endif
    <a href="/comments">&#9664;Voltar</a>
</body>
</html>