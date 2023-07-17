<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comments</title>
</head>

<body>
    <h1>Criar novo Comentário</h1>
    <form action="/comment" method="POST">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"/> --}}
        <table>
            <tr>
                <td>Mensagem:</td>
                <td><input type="text" name="text"/></td>
            </tr>
            <tr>
                <td>Curtidas:</td>
                <td><input type="text" name="likes"/></td>
            </tr>
            <tr>
                <td>Descutidas:</td>
                <td><input type="text" name="dislikes"/></td>
            </tr>
            <tr>
                <td>Editado:</td>
                <td><input type="checkbox" name="edited"/></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" value="Criar"/></td>
            </tr>
            <tr align="center">
                <td colspan="2"><a href="/comments" style="display: inline">&#9664;&nbsp;Voltar</a></td>
            </tr>
        </table>
    </form>
</body>

</html>