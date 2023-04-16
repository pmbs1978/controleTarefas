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
                                    <th></th>
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
                                        <td>
                                            <a href="{{ route('tarefa.edit', $tarefa->id) }}"><i class="bi bi-pencil-square fs-4 text-primary"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <svg class="bi" width="32" height="32" fill="currentColor">
                            <use xlink:href="{{asset('bootstrap-icons/bootstrap-icons.svg#pencil-square')}}"/>
                        </svg> --}}
                        {{-- {{ $tarefas->appends($request)->links('pagination::bootstrap-5') }} --}}
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item {{ $tarefas->currentPage() == 1 ? 'disabled' : ''}}">
                                    <a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item">
                                        <a class="page-link {{ $tarefas->currentPage() == $i ? 'active' : ''}}" href="{{$tarefas->url($i)}}">{{$i}}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $tarefas->currentPage() == $tarefas->lastPage() ? 'disabled' : ''}}">
                                    <a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
