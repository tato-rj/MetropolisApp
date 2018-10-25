<?php 

function office()
{
	return new \App\Office\Office;
}

function conference()
{
	return new \App\Office\Conference;
}

function coworking()
{
	return new \App\Office\CoWorking;
}

function pt($word)
{
	$dictionary = ['conference' => 'Sala de reunião', 'coworking' => 'Mesa compartilhada'];
	if (! array_key_exists($word, $dictionary))
		return $word;

	return $dictionary[$word];
}

function durationToString($number)
{
	if ($number == office()->day_length) return 'Dia inteiro';

	return $number == 1 ? $number.' hora' : $number.' horas';
}

function feeToString($number)
{
	return 'R$ ' . number_format($number, 2, ',', '.');
}

function fromCents($cents)
{
	return $cents / 100;
}

function toCents($currency)
{
	return $currency * 100;
}

function greeting()
{
	$now = (int) now()->format('H');

	if ($now >= 6 && $now < 12)
		return 'Bom dia';

	if ($now >= 12 && $now < 18)
		return 'Boa tarde';

	if ($now < 6 || $now >= 18)
		return 'Boa noite';
}
