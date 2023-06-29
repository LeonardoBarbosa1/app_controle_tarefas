<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    use HasFactory;
    protected $table = 'situacoes';

    public function tarefas(){
        return $this->hasMany("App\Models\Tarefa", "situacao_id", "id");
    }
}
