@component('mail::message')
# Nova mensagem

<p>
Assunto: {{$request['subject']}}
</p>
<p>
{{$request['message']}}
</p>

<p>
Email: {{$request['email']}}
</p>

@if(!empty($request['phone']))
<p>
Telefone para contato: {{$request['phone']}}
</p>
@endif

@endcomponent
