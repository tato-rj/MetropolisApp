@component('mail::message')
# Olá {{$event->recipient_name}}

Você está recebendo este email para pagar uma cobrança do escritório MetropolisRio. 

@component('mail::panel')
<div style="padding: 1em">
	<p style="margin-bottom: .25em"><strong>Para que é esta cobrança?</strong></p>
	<p style="margin-bottom: 1em">{{$event->name}}</p>
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

Até breve,<br>
Equipe {{ config('app.name') }}
@endcomponent
