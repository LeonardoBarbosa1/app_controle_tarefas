@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    <form method="post" action="{{ route("tarefa.store") }}">
                        @csrf
                        <div class="mb-3">
                            
                          <label class="form-label ">Tarefa</label>
                          <input type="text" class="form-control @error('tarefa') is-invalid @enderror" name="tarefa" placeholder="Tarefa...">
                            @error('tarefa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label">Data limite conclusão</label>
                          <input type="date" class="form-control @error('tarefa') is-invalid @enderror" name="data_limite_conclusao">
                          @error('data_limite_conclusao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
