@component('mail::message')
# Olá {{$user->first_name}}

O seu pedido foi recebido com sucesso! Por favor aguarde a confirmação do seu pagamento para finalizarmos a reserva. Aqui vão os detalhes do evento:
<div style="border-bottom: 1px solid lightgrey; margin-bottom: 15px; padding-bottom: 15px">
	<img src="{{asset($workshop->cover_image_path)}}" style="margin-bottom: .75em">
	<p style="margin-bottom: 5px"><strong>Workshop:</strong> {{$workshop->name}}</p>
	<p style="margin-bottom: 5px"><strong>Data:</strong> {{toFormattedDateStringPt($workshop->starts_at)}}</p>
	<p style="margin-bottom: 5px"><strong>Hora da chegada:</strong> {{$workshop->starts_at->format('H:i')}}</p>
	<p style="margin-bottom: 0"><strong>Hora da saída:</strong> {{$workshop->ends_at->format('H:i')}}</p>
</div>

@if($workshop->files()->exists())
<div>
	<p>Material para download</p>

	@foreach($workshop->files as $file)
	<p style="margin-bottom: 5px"><a href="{{asset($file->download_path)}}">{{$file->name . '.' . $file->extension}}</a></p>
	@endforeach

</div>
@endif

<div style="margin: 40px 0;">
	<p style="text-align: center;">Gostaria de obter mais informações?</p>

	@component('mail::button', ['url' => route('workshops.show', $workshop->slug)])
	Clique aqui para ver mais detalhes
	@endcomponent
</div>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent
