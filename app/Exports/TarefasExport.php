<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
    //WithHeadings  (Para o titulo de exportação)
    //WithMapping (Cuida dos dados linha a linha)
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Tarefa::all();
        return auth()->user()->tarefas()->get(); //retorna apenas as tarefas relacionada a este usuário
    }
    //Titulo para o arquivo de exportação
    public function headings():array{
        return [
            'ID da tarefa', 
            
            'Tarefa', 
            'Data limite conclusão'
            
        ];
    }
    public function map($linha):array{
        return [
            $linha->id,
            $linha->tarefa,
            date('d/m/Y',strtotime( $linha->data_limite_conclusao))
        ];
    }
}
