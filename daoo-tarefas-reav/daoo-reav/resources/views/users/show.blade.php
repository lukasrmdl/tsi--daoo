<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    @if ($user)
        <h1>{{ $user->id }}</h1>
        <p>{{ $user->name }}</p>
        <ul>
            <li>Email: {{ $user->email }}</li>
            <li>Senha: {{ $user->password }}</li>
        </ul>
    @else
        <p>Usuários não encontrados! </p>
    @endif
    <a href="/users">&#9664;Voltar</a>
</body>
</html>