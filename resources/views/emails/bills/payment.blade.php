@component('mail::message')
# Olá {{$event->name}}

Você está recebendo este email para pagar uma cobrança do escritório MetropolisRio. 

@component('mail::panel')
<div style="padding: 1em">
	<p style="margin-bottom: .25em"><strong>Para que é esta cobrança?</strong></p>
	<p style="margin-bottom: 1em">{{$event->title}}</p>
	<p style="margin-bottom: .25em"><strong>Um pouco mais sobre este evento</strong></p>
	<p style="margin-bottom: 0">{{$event->description}}</p>
</div>
@endcomponent

Se você não estava esperando por esta mensagem ou encontrou algum erro, por favor entre em contato conosco. Caso contrário, clique no botão abaixo para prosseguir com o pagamento.

<div style="margin: 40px 0;">
	@component('mail::button', ['url' => $url])
	Pagar agora
	@endcomponent
</div>

<p>Se encontrar problemas com o botão acima, pode usar este link <a href="{{$url}}">{{$url}}</a></p>

<p>O escritório fica localizado na <strong>{{office()->address}}</strong>. Veja abaixo no mapa:</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1064.5986453240255!2d-43.17783590713117!3d-22.905353196891383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x997f5e338b0669%3A0x1c3cffd7e7138096!2sAv.+Rio+Branco%2C+151+-+Centro%2C+Rio+de+Janeiro+-+RJ%2C+20040-006%2C+Brazil!5e0!3m2!1sen!2sus!4v1540815899031" style="width: 100%; height: 50vh; margin-bottom: 40px" frameborder="0" style="border:0" allowfullscreen></iframe>

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent
