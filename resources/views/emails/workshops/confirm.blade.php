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
	<p style="margin-bottom: 5px"><a href="{{$file->download_path}}">{{$file->name . '.' . $file->extension}}</a></p>
	@endforeach

</div>

<div style="margin: 40px 0;">
	<p style="text-align: center;">Gostaria de obter mais informações?</p>

	@component('mail::button', ['url' => route('workshops.show', $workshop->slug)])
	Clique aqui para ver mais detalhes
	@endcomponent
</div>

<p>O escritório fica localizado na <strong>{{office()->address}}</strong>. Veja abaixo no mapa:</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1064.5986453240255!2d-43.17783590713117!3d-22.905353196891383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5e338b0669%3A0x1c3cffd7e7138096!2sAv.+Rio+Branco%2C+151+-+Centro%2C+Rio+de+Janeiro+-+RJ%2C+20040-006%2C+Brazil!5e0!3m2!1sen!2sus!4v1540815899031" style="width: 100%; height: 50vh; margin-bottom: 40px" frameborder="0" style="border:0" allowfullscreen></iframe>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent
