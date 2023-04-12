@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-end">
                    <a class="link-success text-decoration-none" href="{{ route('tarefa.create') }}">Nova Tarefa</a>
                </div>
                <div class="card">
                    <div class="card-header">Lista tarefas</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data criação</th>
                                    <th scope="col">Data modificação</th>
                                    <th scope="col">Data limite conclusão</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa)
                                    <tr>
                                        <td>{{$tarefa->id}}</td>
                                        <td>{{$tarefa->tarefa}}</td>
                                        <td>{{$tarefa->created_at}}</td>
                                        <td>{{$tarefa->updated_at}}</td>
                                        <td>{{$tarefa->data_limite_conclusao}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
