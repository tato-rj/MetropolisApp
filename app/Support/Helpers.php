<?php 

function pt($word)
{
	$dictionary = ['conference' => 'Sala de reunião'];
	if (! array_key_exists($word, $dictionary))
		return $word;

	return $dictionary[$word];
}