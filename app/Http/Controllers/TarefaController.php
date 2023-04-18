<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Tarefa;
use App\Mail\NovaTarefaMail;
use App\Mail\TarefaAtualizadaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if(Auth::check()){
        //     $id = Auth::user()->id;
        //     $nome = Auth::user()->name;
        //     $email = Auth::user()->email;
        //     return $id . ' - nome: ' . $nome . ' - email: ' . $email . '<br>Você está logado!';
        // } else{
        //     return 'Você não está logado!';
        // }
        // if(auth()->check()){
        //     $id = auth()->user()->id;
        //     $nome = auth()->user()->name;
        //     $email = auth()->user()->email;
        //     return $id . ' - nome: ' . $nome . ' - email: ' . $email . '<br>Você está logado!';
        // } else{
        //     return 'Você não está logado!';
        // }
        // $id = Auth::user()->id;
        // $nome = Auth::user()->name;
        // $email = Auth::user()->email;
        // return "ID: $id | NOME: $nome | EMAIL: $email";
        $user = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $user)->paginate(10);

        $request = $request->all();
        return view('tarefa.index', compact('tarefas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'tarefa' => 'required|min:5|max:200',
            'data_limite_conclusao' => 'date'
        ];

        $feedback = [
            'tarefa.required' => 'O campo :attribute tem de ser preenchido',
            'tarefa.min' => 'O campo :attribute tem de ter pelo menos 5 caracteres',
            'tarefa.max' => 'O campo :attribute tem de ter no máximo 200 caracteres',
            'date' => 'A data não está no formato correcto'
        ];

        $request->validate($regras, $feedback);

        $dados = $request->all();
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);

        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        $tarefa = $tarefa;
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $user = auth()->user()->id;
        if($tarefa->user_id == $user){
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        }
        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user = auth()->user()->id;
        if($tarefa->user_id == $user){
            $regras = [
                'tarefa' => 'required|min:5|max:200',
                'data_limite_conclusao' => 'date'
            ];

            $feedback = [
                'tarefa.required' => 'O campo :attribute tem de ser preenchido',
                'tarefa.min' => 'O campo :attribute tem de ter pelo menos 5 caracteres',
                'tarefa.max' => 'O campo :attribute tem de ter no máximo 200 caracteres',
                'date' => 'A data não está no formato correcto'
            ];

            $request->validate($regras, $feedback);
            $tarefa->update($request->all());

            $destinatario = auth()->user()->email;
            Mail::to($destinatario)->send(new TarefaAtualizadaMail($tarefa));

            return redirect()->route('tarefa.index');
        }
        return view('acesso-negado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $user = auth()->user()->id;
        if(!$tarefa->user_id == $user){
            return view('acesso-negado');
        }

        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }

    public function exportar()
    {

        $tarefas = auth()->user()->tarefas()->get();
        $pdf = Pdf::loadView('tarefa.pdf', ['tarefas' => $tarefas]);
        $pdf->setPaper('a4', 'landscape');
        // primeiro parâmetro tipo de papel a4, a5, etc...
        // segundo parâmetro orientação portrait, landscape

        // return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    }
}
