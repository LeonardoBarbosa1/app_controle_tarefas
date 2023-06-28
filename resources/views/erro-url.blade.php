@extends('layouts.app')

@section('content')
   @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">URL não encontrada!</div>

                        <div class="card-body">
                        Desculpe {{Auth::user()->name}}. A URL acessada não foi encontrada. <br>
                        Clique no botão a seguir para voltar <br>
                        <a class="btn btn-primary" href="{{ route('tarefa.index') }}" >Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endauth
   @guest
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">URL não encontrada!</div>

                        <div class="card-body">
                        Desculpe. A URL acessada não foi encontrada. <br>
                        Clique no botão a seguir para voltar <br>
                        <a class="btn btn-primary" href="{{ route('login') }}" >Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   @endguest
    
    
    
@endsection
