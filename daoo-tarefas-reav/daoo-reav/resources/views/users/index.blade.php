<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Usuários</h1>
    @if ($users->count()>0)
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Tópicos</th>
                <th>Email</th>
                <th>Senha</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    <a target=_blank href="/user/{{$user->id}}">
                        {{$user->id}}
                    </a>
                </td>
                <td>{{$user->name}}</td>
                <td><ul>
                        @foreach ($user->topics as $topic)
                        <li>
                            <a href="/topic/{{$topic->id}}">
                                {{$topic->title}}
                            </a>
                        </li>
                        @endforeach
                    </ul></td>
                <td>{{$user->email}}</td>
                <td>{{$user->password}}</td>
                <td>
                    <a href="{{ route('user.edit',$user->id) }}">
                        <button>Editar</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('user.delete',$user->id) }}">
                        <button>Deletar</button>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="6"><hr></td>
            </tr>
            @endforeach

        </tbody>
    </table>
    @else
    <p>Usuários não encontrados! </p>
    @endif
    <div>
        <a href="/user">
            <button>Criar</button>
        </a>
    </div>
</body>
</html>