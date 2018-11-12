<?php 

function office()
{
	return new \App\Space;
}

function calculateEndingTime(\Carbon\Carbon $starts_at, $duration)
{
	$office_ending_hour = office()->day_ends_at;

	$ends_at = $starts_at->addHours($duration);

	if ($ends_at->hour > $office_ending_hour);
		return $ends_at->setTime($office_ending_hour, 0, 0);

	return $ends_at;
}

function pt($word)
{
	$dictionary = ['conference' => 'Sala de reunião', 'workstation' => 'Mesa compartilhada'];
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
