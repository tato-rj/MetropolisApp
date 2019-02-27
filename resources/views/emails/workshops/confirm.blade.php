@component('mail::message')
# Olá {{$user->first_name}}

A sua reserva está confirmada! Aqui vão os detalhes do evento:
<div style="border-bottom: 1px solid lightgrey; margin-bottom: 15px; padding-bottom: 15px">
	<img src="{{asset($workshop->cover_image_path)}}" style="margin-bottom: .75em">
	<p style="margin-bottom: 5px"><strong>Workshop:</strong> {{$workshop->name}}</p>
	<p style="margin-bottom: 5px"><strong>Data:</strong> {{toFormattedDateStringPt($workshop->starts_at)}}</p>
	<p style="margin-bottom: 5px"><strong>Hora da chegada:</strong> {{$workshop->starts_at->hour}}:00</p>
	<p style="margin-bottom: 0"><strong>Hora da saída:</strong> {{$workshop->ends_at->hour}}:00</p>
</div>


<div>
	<p>Material para download</p>

	@foreach($workshop->files as $file)
	<p style="margin-bottom: 5px"><a href="{{asset($file->download_path)}}">{{$file->name . '.' . $file->extension}}</a></p>
	@endforeach

</div>

<div style="margin: 40px 0;">
	<p style="text-align: center;">Gostaria de obter mais informações?</p>

	@component('mail::button', ['url' => route('workshops.show', $workshop->slug)])
	Clique aqui para ver mais detalhes
	@endcomponent
</div>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent
