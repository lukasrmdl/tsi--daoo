<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tópicos</title>
</head>

<body>
    <h1>Editar Tópico</h1>
    <form action="{{route('topic.update',$topic->id)}}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Título:</td>
                <td><input type="text" name="title" value="{{$topic->title}}"/></td>
            </tr>
            <tr>
                <td>Conteúdo:</td>
                <td><input type="text" name="content" value="{{$topic->content}}"/></td>
            </tr>
            <tr>
                <td>Categoria:</td>
                <td><input type="text" name="category" value="{{$topic->category}}"/></td>
            </tr>
            <tr>
                <td>Editado:</td>
                <td><input type="checkbox" name="edited" {{($topic->edited)?'checked':''}}/></td>
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" value="Salvar"/>
                    <a href="/topics">
                        <button form=cancel >Cancelar</button>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>