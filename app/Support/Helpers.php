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
	if ($number == 8) return 'Dia inteiro';

	return $number == 1 ? $number.' hora' : $number.' horas';
}

function feeToString($number)
{
	return 'R$ ' . number_format($number,2,",",".");
}