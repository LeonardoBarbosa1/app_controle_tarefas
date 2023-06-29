<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Models\Situacao;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TarefaController extends Controller
{

    //cheacando se o usuario está autenticadp
     public function __construct(){
         $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::with("situacao")->where('user_id', $user_id)->paginate(10);
        //$tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        
        return view("tarefa.index", ['tarefas'=>$tarefas]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $situacoes = Situacao::all();
        return view("tarefa.create", ['situacoes' => $situacoes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $regras = [
            'tarefa' => 'required | min:3 |max:200',
            'data_limite_conclusao' => 'required | date'
        ];
        $feedback = [
            'tarefa.required' => 'O campo Tarefa é obrigatório!',
            'tarefa.min' => 'O campo Tarefa deve conter pelo menos 3 caracteres',
            'tarefa.min' => 'O campo Tarefa deve conter no máximo 200 caracteres',

            'data_limite_conclusao.required' => 'O campo Data é obrigatório!',
           
        ];

        $request->validate($regras, $feedback );

        $dados = $request->all('tarefa','data_limite_conclusao','situacao_id');

        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);

        //$destinatario = auth()->user()->email; //pegando email do usuario autenticado
        //enviando email
        //Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        
        return view('tarefa.show',['tarefa'=>$tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        //verificando se o usuário pode ter acesso a tarefa em questão
        $user_id = auth()->user()->id;
        $situacoes = Situacao::all();
        if(! $tarefa->user_id == $user_id){
            return view('acesso-negado');
        } else {
            return view('tarefa.edit', ['tarefa' => $tarefa, 'situacoes' => $situacoes]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
       
        $regras = [
            'tarefa' => 'required | min:3 |max:200',
            'data_limite_conclusao' => 'required |date'
        ];
        $feedback = [
            'tarefa.required' => 'O campo Tarefa é obrigatório!',
            'tarefa.min' => 'O campo Tarefa deve conter pelo menos 3 caracteres',
            'tarefa.min' => 'O campo Tarefa deve conter no máximo 200 caracteres',

            'data_limite_conclusao.required' => 'O campo Data é obrigatório!',
            'data_limite_conclusao.date_format' => 'O campo Data está incorreto'
           
        ];

        $request->validate($regras, $feedback );

        $user_id = auth()->user()->id;

        if(! $tarefa->user_id == $user_id){
            return view('acesso-negado');
        }else {
            $tarefa->update($request->all());
            return redirect()->route('tarefa.show', ['tarefa' => $tarefa]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(! $tarefa->user_id == $user_id){
            return view('acesso-negado');
        }else {
            $tarefa->delete();
            return redirect()->route('tarefa.index');
        }
    }

    public function exportacao($extencao){
        

        if(in_array($extencao, ['xlsx','csv','pdf'])){
            return Excel::download(new TarefasExport, 'lista_de_tarefas.'.$extencao);
        }

        return redirect()->route('tarefa.index');
        

        // if($extencao == 'xlsx'){
        //     $nome_arquivo .= '.'.$extencao;
        // }else if($extencao == 'csv'){
        //     $nome_arquivo .= '.'.$extencao;
        // }else if($extencao == 'pdf'){
        //     $nome_arquivo .= '.'.$extencao;
        // }else{
        //     return redirect()->route('tarefa.index');
        // }

       
    }

    public function exportar(){
        
        $tarefas = auth()->user()->tarefas()->get(); //recuperando tarefas do usuario
        $pdf = Pdf::loadView('tarefa.pdf', ['tarefas' => $tarefas]);

        $pdf->setPaper('a4','portrait'); 
        //1ºParam(tipo de papel) 
        //2ºParam(Orientação da impressão:landscape(paisagem) ou portrait(retrato))


        //return $pdf->download('lista_de_tarefas.pdf'); //download (faz o download de imediato)
        return $pdf->stream('lista_de_tarefas.pdf'); //stream (não faz o download de imediato)
    }
}
