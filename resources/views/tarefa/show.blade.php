@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tarefa</div>

                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-4 text-end">
                                ID:
                            </div>
                            <div class="col-4 text-start">
                                {{ $tarefa->id }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-end">
                                TAREFA:
                            </div>
                            <div class="col-4 text-start">
                                {{ $tarefa->tarefa }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-end">
                                DATA LIMITE CONCLUSÃO:
                            </div>
                            <div class="col-4 text-start">
                                {{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-end">
                                CRIADA EM:
                            </div>
                            <div class="col-4 text-start">
                                {{ date('d/m/Y', strtotime($tarefa->created_at)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-end">
                                MODIFICADA EM:
                            </div>
                            <div class="col-4 text-start">
                                {{ date('d/m/Y', strtotime($tarefa->updated_at)) }}
                            </div>
                        </div>
                    </div>
                    <div class="m-3">
                        {{-- <a href="{{ route('tarefa.create') }}" class="btn btn-primary mt-2">Voltar</a> --}}
                        <a href="{{ url()->previous() }}" class="btn btn-primary mt-2">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
