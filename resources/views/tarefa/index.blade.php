@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            Tarefas
                        </div>
                        <div class="col-6">
                            <div class="float-sm-end">
                                
                                <a style="margin-right: 5px" href="{{route('tarefa.create')}}"class=" btn btn-success " >Novo</a>

                                <div id="navbarDropdown" class="btn btn-secondary dropdown-toggle float-sm-end" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> 
                                    Exportar </div> 
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> 
                                    <a href="{{route('tarefa.exportacao', ['extencao' => 'xlsx'])}} " class=" dropdown-item">XLSX</a>
                                    <a href="{{route('tarefa.exportacao', ['extencao' => 'csv'])}}" class=" dropdown-item">CSV</a>
                                    <a href="{{route('tarefa.exportacao', ['extencao' => 'pdf'])}}" class=" dropdown-item">PDF</a>
                                    <a href="{{route('tarefa.exportar')}}" target="_blank" class=" dropdown-item">PDF V2</a>
                                 </div>  

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tarefa</th>
                            <th scope="col">Data limite conclusão</th>
                            <th></th>
                            <th></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $key => $t)
                                <tr>
                                    <th scope="row">{{ $t['id'] }}</th>
                                    <td>{{ $t['tarefa'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($t['data_limite_conclusao'])) }}</td>

                                    <td> 
                                        <a class="bg-primary px-1 p-1" href="{{ route('tarefa.edit',$t['id'])}}">
                                            <img 
                                                style="width: 20px;
                                                       height: 20px;" 
                                                src="/img/lapis.png" alt="">
                                        </a>
                                    </td>

                                    <td > 
                                        <form  id="form_{{$t['id']}}" method="post" action="{{ route('tarefa.destroy', ['tarefa' =>$t['id']])}}" >
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a class="bg-danger px-1 p-1" href="#" onclick="document.getElementById('form_{{$t['id']}}').submit()"> 
                                            <img 
                                                style="width: 20px;
                                                       height: 20px;" 
                                                src="/img/lixeira.png" alt="">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                         
                        </tbody>
                      </table>
                      
                    {{-- PAGINAÇÃO --}}
                    <nav>
                        <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="{{ $tarefas->previousPageUrl()}}" aria-label="Previous">
                            <span aria-hidden="true">Voltar</span>
                            </a>
                        </li>

                        @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                            <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : ''}} ">
                                <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        

                        <li class="page-item">
                            <a class="page-link" href="{{ $tarefas->nextPageUrl()}}" aria-label="Next">
                            <span aria-hidden="true">Avançar</span>
                            </a>
                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection