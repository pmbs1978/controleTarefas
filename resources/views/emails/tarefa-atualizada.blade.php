<x-mail::message>
# A tarefa com ID {{$id}}, foi atualizada:
Tarefa: {{ $tarefa }}
<br>
Data limite de conclusão {{ $data_limite_conclusao }}

<x-mail::button :url=$url>
Ver tarefa
</x-mail::button>

Atenciosamente,<br>
{{ config('app.name') }}
</x-mail::message>
