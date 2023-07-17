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
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        <ul>
            <li>Senha: {{ $user->password }}</li>
        </ul>
        <table>
            <tr>
                <td>
                    <form action="{{ route('user.remove',$user->id) }}" method='post'>
                        @csrf
                        <input type="submit" name='confirmar' value="Remover" />
                    </form>
                </td>
                <td>
                    <a href="/users"><button>Cancelar</button></a>
                </td>
            </tr>
        </table>
    @else
        <p>Usuários não encontrados! </p>
    @endif
    <a href="/users">&#9664;Voltar</a>
</body>
</html>