<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{

    //cheacando se o usuario está autenticadp
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //verificando se o está autenticado nessa rota   Auth::check() = se o usuario estiver autenticado... retorna true
         //Para usar dessa forma devemos usar o use Illuminate\Support\Facades\Auth;
        if (Auth::check()) {
            $id = Auth::user()->id; //Auth::user() pega as informações do usuario autenticado
             $nome = Auth::user()->name;
            $email = Auth::user()->email;
            return "ID: $id | Nome:$nome | Email:$email";
        } else{
            return "Você não esta logado no sistema";
        }
        //verificando se o está autenticado nessa rota     auth()->check() = se o usuario estiver autenticado... retorna true
        // if (auth()->check()) {
        //     $id = auth()->user()->id; //auth()->user() pega as informações do usuario autenticado
        //     $nome = auth()->user()->name;
        //     $email = auth()->user()->email;

        //     return "ID: $id | Nome:$nome | Email:$email";
        // } else{
        //     return "Você não esta logado no sistema";
        // }

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
