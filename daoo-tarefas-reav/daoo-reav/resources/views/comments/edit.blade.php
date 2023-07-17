<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comentários</title>
</head>

<body>
    <h1>Editar Comentário</h1>
    <form action="{{route('comment.update',$comment->id)}}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Mensagem:</td>
                <td><input type="text" name="text" value="{{$comment->text}}"/></td>
            </tr>
            <tr>
                <td>Curtidas:</td>
                <td><input type="text" name="likes" value="{{$comment->likes}}"/></td>
            </tr>
            <tr>
                <td>Descurtidas:</td>
                <td><input type="text" name="dislikes" value="{{$comment->dislikes}}"/></td>
            </tr>
            <tr>
                <td>Editado:</td>
                <td><input type="checkbox" name="edited" {{($comment->edited)?'checked':''}}/></td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" value="Salvar"/>
                    <a href="/comments">
                        <button form=cancel >Cancelar</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>