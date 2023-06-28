<x-mail::message>
# {{ $tarefa}}

Data Limite de conclusão {{ $data_limite_conclusao }}.

<x-mail::button :url="$url">
Clique aqui para ver a Tarefa
</x-mail::button>

Att,<br>
{{ config('app.name') }}
</x-mail::message>
