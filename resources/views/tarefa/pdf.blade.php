<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h2 {
            padding: 10px;
            border: 1px solid blue;
            border-radius: 5px;
            background-color: blue;
        }

        table {
            width: 100%;
        }

        .page-break {
            page-break-after: always;
            /* ou
            page-break-before: always; */
        }
    </style>
</head>
<body>

    <h2>Lista de tarefas</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tarefa</th>
                <th>Data criação</th>
                <th>Data modificação</th>
                <th>Data limite conclusão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa)
                <tr>
                    <th scope="row">{{$tarefa->id}}</th>
                    <td>{{$tarefa->tarefa}}</td>
                    <td>{{$tarefa->created_at}}</td>
                    <td>{{$tarefa->updated_at}}</td>
                    <td>{{$tarefa->data_limite_conclusao}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2>Lista de tarefas</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tarefa</th>
                <th>Data criação</th>
                <th>Data modificação</th>
                <th>Data limite conclusão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $tarefa)
                <tr>
                    <th>{{$tarefa->id}}</th>
                    <td>{{$tarefa->tarefa}}</td>
                    <td>{{$tarefa->created_at}}</td>
                    <td>{{$tarefa->updated_at}}</td>
                    <td>{{$tarefa->data_limite_conclusao}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


