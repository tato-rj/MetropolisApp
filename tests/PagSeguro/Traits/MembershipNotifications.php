<?php

namespace Tests\PagSeguro\Traits;

trait MembershipNotifications
{
	public function membership_active($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>961F448D0D0D1C1994B7BFBDCD7D5076</code><date>2019-01-26T16:33:58-02:00</date><tracker>085377</tracker><status>ACTIVE</status><reference>".$reference."</reference><lastEventDate>2019-01-26T16:33:58-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_cancelada_pelo_vendedor($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>961F448D0D0D1C1994B7BFBDCD7D5076</code><date>2019-01-26T16:33:58-02:00</date><tracker>085377</tracker><status>CANCELLED_BY_RECEIVER</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:15:54-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_cancelada_pelo_comprador($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>BCAF304CC7C71F75542AEFBB7262FBF2</code><date>2019-01-26T16:29:45-02:00</date><tracker>AB1B6F</tracker><status>CANCELLED_BY_SENDER</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:16:33-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_cancelada($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>9780A7844747301EE4001F8A91699208</code><date>2019-01-26T14:56:45-02:00</date><tracker>5D6D7C</tracker><status>CANCELLED</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:19:30-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_expirada($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>3874B9452D2DC9ABB4FECFABF7E9F090</code><date>2019-01-26T14:58:32-02:00</date><tracker>F80EFC</tracker><status>EXPIRED</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:17:10-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_aguardando_processamento_do_pagamento($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>9780A7844747301EE4001F8A91699208</code><date>2019-01-26T14:56:45-02:00</date><tracker>5D6D7C</tracker><status>PENDING</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:17:42-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}

	public function membership_suspensa($reference = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><preApproval><name>Plano B?sico Mensal</name><code>4B2C1579B1B140D44424DF9EFE596ECA</code><date>2019-01-26T14:21:29-02:00</date><tracker>8D422F</tracker><status>SUSPENDED</status><reference>".$reference."</reference><lastEventDate>2019-01-26T17:20:14-02:00</lastEventDate><charge>AUTO</charge><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address></sender></preApproval>";
	}
}
