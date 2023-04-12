@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Account</div>

                    <div class="card-body">
                        <div>ID: {{ $user['id'] }}</div>
                        <div>NOME: {{ $user['nome'] }}</div>
                        <div>EMAIL: {{ $user['email'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
