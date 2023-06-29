<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tarefas', function(Blueprint $table){
            $table->unsignedBigInteger('situacao_id')->nullable()->after('data_limite_conclusao');
            $table->foreign('situacao_id')->references('id')->on('situacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarefas', function(Blueprint $table){
            $table->dropForeign('tarefas_situacao_idforeign');
            $table->dropColumn('situacao_id');
        });
    }
};
