<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Topics</title>
</head>

<body>
    <h1>Criar novo Tópico</h1>
    <form action="/topic" method="POST">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"/> --}}
        <table>
            <tr>
                <td>Título:</td>
                <td><input type="text" name="title"/></td>
            </tr>
            <tr>
                <td>Categoria:</td>
                <td><input type="text" name="category"/></td>
            </tr>
            <tr>
                <td>Conteúdo:</td>
                <td><input type="textarea" name="content"/></td>
            </tr>
            <tr>
                <td>Editado:</td>
                <td><input type="checkbox" name="edited"/></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" value="Criar"/></td>
            </tr>
            <tr align="center">
                <td colspan="2"><a href="/topics" style="display: inline">&#9664;&nbsp;Voltar</a></td>
            </tr>
        </table>
    </form>
</body>

</html>