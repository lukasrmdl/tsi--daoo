<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comentários</title>
</head>
<body>
    <h1>Comentários</h1>
    @if ($comments->count()>0)
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Mensagem</th>
                <th>Curtidas</th>
                <th>Descurtidas</th>
                <th>Editado</th>
                <th>Usuário</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>
                    <a target=_blank href="/comment/{{$comment->id}}">
                        {{$comment->id}}
                    </a>
                </td>
                <td>{{$comment->text}}</td>
                <td>{{$comment->likes}}</td>
                <td>{{$comment->dislikes}}</td>
                <td>{{($comment->edited)?'Sim':'Não'}}</td>
                <td>{{$comment->user_id}}</td>
                <td>
                    <a href="{{ route('comment.edit',$comment->id) }}">
                        <button>Editar</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('comment.delete',$comment->id) }}">
                        <button>Deletar</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Comentários não encontrados! </p>
    @endif
    <div>
        <a href="/comment">
            <button>Criar</button>
        </a>
    </div>
</body>
</html>