{!! Share::page($url, $workshop->name, ['class' => $style ?? null])
	->facebook()
	->twitter()
	->linkedin($description ?? null)
	->whatsapp() !!}