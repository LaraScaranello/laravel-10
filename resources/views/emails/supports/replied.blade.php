<x-mail::message>
# Suporte respondido

O suporte {{ $reply->support_id }} foi respondido com: <b>{{ $reply->sontent }}</b>

<x-mail::button :url="route('replies.index', $support->id)">
Visualizar
</x-mail::button>

Obrigada,<br>
{{ config('app.name') }}
</x-mail::message>
