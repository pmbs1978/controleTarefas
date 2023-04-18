@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adicionar tarefa</div>

                    <div class="card-body">
                        <form action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tarefa</label>
                                <input type="text" class="form-control" name="tarefa" value="{{ old('tarefa') ?? $tarefa->tarefa}}">
                            </div>
                            {{ $errors->has('tarefa') ? $errors->first('tarefa') : '' }}
                            <div class="mb-3">
                                <label class="form-label">Dta limite conclusão</label>
                                <input type="date" class="form-control" name="data_limite_conclusao" value="{{ old('data_limite_conclusao') ?? $tarefa->data_limite_conclusao }}">
                            </div>
                            {{ $errors->has('data_limite_conclusao') ? $errors->first('data_limite_conclusao') : '' }}
                            <button type="submit" style="display: block" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
