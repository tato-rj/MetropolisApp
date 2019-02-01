<?php 

function encrypt_str($string) {
    $output = false;
 
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'metropolis';
    $secret_iv = '123';
 
    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
 
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
 
    return $output;
}

function decrypt_str($string) {
    $output = false;
 
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'metropolis';
    $secret_iv = '123';
 
    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
 
	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
 
    return $output;
}

function office()
{
	return new \App\Space;
}

function carbon($string)
{
	return \Carbon\Carbon::parse($string);
}

function pagseguro($value)
{
	return config('services.pagseguro')[$value];
}

function client($isPlan = false)
{
	$headers = ['Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'];

	if ($isPlan)
		$headers = array_merge($headers, ['Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1']);

	return new \GuzzleHttp\Client([
            'headers' => $headers
        ]);
}

function notificationUrl($localUrl)
{
	return app()->environment() == 'local' ? $localUrl . '/pagseguro/event/notification' : route('pagseguro.event.notification');
}

function calculateEndingTime(\Carbon\Carbon $starts_at, $duration)
{
	$office_ending_hour = office()->day_ends_at;

	$ends_at = $starts_at->copy()->addHours($duration);

	if ($ends_at->hour > $office_ending_hour)
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
	return 'R$' . number_format($number, 2, ',', '.');
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

function clean($string)
{
	return preg_replace("/[^0-9]/", "", $string);
}

function toFormattedDateStringPt(\Carbon\Carbon $date, $withYear = true)
{
	$months = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
	$string = $date->day . ' de ' . $months[$date->month - 1];
	if ($withYear)
		$string .= ' de ' . $date->year;
	return $string;
}