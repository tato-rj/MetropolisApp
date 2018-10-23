<?php 

function pt($word)
{
	$dictionary = ['conference' => 'Sala de reunião', 'co-working' => 'Mesa compartilhada'];
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

function totalCost($space, $duration, $participants)
{
	$fee;
	foreach (config("office.spaces.{$space}.prices") as $price) {
		if ($price['duration'] == $duration) {
			$fee = $price['fee'];
			break;
		}
	}

	return $space == 'co-working' ? $fee * $participants : $fee;
}

function applyDiscount($cost, $discount)
{
	$difference = $cost * ($discount / 100);
	return $cost - $difference;
}

function monthly()
{
	return config('office.spaces.co-working.prices')[3]['fee']*20;
}

function greeting()
{
	$now = (int) now()->format('h');

	if ($now >= 6 && $now < 12)
		return 'Bom dia';

	if ($now >= 12 && $now < 18)
		return 'Boa tarde';

	if ($now < 6 || $now >= 18)
		return 'Boa noite';
}
