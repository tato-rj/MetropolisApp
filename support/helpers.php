<?php 

function office()
{
	return new \App\Office\Office;
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
	if ($number == config('office.day_length')) return 'Dia inteiro';

	return $number == 1 ? $number.' hora' : $number.' horas';
}

function feeToString($number)
{
	return 'R$ ' . number_format($number,2,",",".");
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
