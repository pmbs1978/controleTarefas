<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Tarefa::all();
        $tarefas = auth()->user()->tarefas()->get();
        return $tarefas;
    }

    public function Headings():array
    {
        return ['ID', 'USER_ID', 'TAREFA', 'DATA LIMITE CONCLUSÃO', 'DATA CRIAÇÃO', 'DATA ATUALIZAÇÃO'];
    }

    public function map($linha):array
    {
        return [
            $linha->id,
            $linha->user->name,
            $linha->tarefa,
            date('d/m/Y', strToTime($linha->data_limite_conclusao)),
            date('d/m/Y', strToTime($linha->created_at)),
            date('d/m/Y', strToTime($linha->updated_at))
        ];
    }
}
