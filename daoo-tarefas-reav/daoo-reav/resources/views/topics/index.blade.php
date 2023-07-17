<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tópicos</title>
</head>
<body>
    <h1>Tópicos</h1>
    @if ($topics->count()>0)
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Conteúdo</th>
                <th>Categoria</th>
                <th>Usuário</th>
                <th>Editado</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topics as $topic)
            <tr>
                <td>
                    <a target=_blank href="/topic/{{$topic->id}}">
                        {{$topic->id}}
                    </a>
                </td>
                <td>{{$topic->title}}</td>
                <td>{{$topic->content}}</td>
                <td>{{$topic->category}}</td>
                <td>{{$topic ->user_id}}</td>
                <td>{{($topic->edited)?'Sim':'Não'}}</td>
                <td>
                    <a href="{{ route('topic.edit',$topic->id) }}">
                        <button>Editar</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('topic.delete',$topic->id) }}">
                        <button>Deletar</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Tópicos não encontrados! </p>
    @endif
    <div>
        <a href="/topic">
            <button>Criar</button>
        </a>
    </div>
</body>
</html>