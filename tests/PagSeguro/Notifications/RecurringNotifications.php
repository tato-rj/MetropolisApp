<?php

namespace Tests\PagSeguro\Notifications;

trait RecurringNotifications
{
	public function recurring_em_analise($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';

		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-26T14:56:45.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>11</type><status>2</status><lastEventDate>2019-01-26T16:56:08.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>1099.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>55.24</feeAmount><netAmount>1043.76</netAmount><escrowEndDate>2019-02-09T16:56:08.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>001</id><description>Plano B?sico Mensal</description><quantity>1</quantity><amount>1099.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone></sender><shipping><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>sitef</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1035526740</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function recurring_paga($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-26T15:00:15.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>11</type><status>3</status><lastEventDate>2019-01-26T15:01:05.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>1099.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>55.24</feeAmount><netAmount>1043.76</netAmount><escrowEndDate>2019-02-09T15:01:05.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>001</id><description>Plano B?sico Mensal</description><quantity>1</quantity><amount>1099.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone></sender><shipping><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>sitef</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1035526740</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function recurring_disponivel($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-26T16:29:46.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>11</type><status>4</status><lastEventDate>2019-01-26T17:01:39.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>1099.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>55.24</feeAmount><netAmount>1043.76</netAmount><escrowEndDate>2019-01-26T17:01:39.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>001</id><description>Plano B?sico Mensal</description><quantity>1</quantity><amount>1099.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone></sender><shipping><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>sitef</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1035526740</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function recurring_cancelada($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-26T14:56:45.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>11</type><status>7</status><cancellationSource>INTERNAL</cancellationSource><lastEventDate>2019-01-26T17:00:10.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>1099.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>55.24</feeAmount><netAmount>1043.76</netAmount><escrowEndDate>2019-02-09T17:00:10.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>001</id><description>Plano B?sico Mensal</description><quantity>1</quantity><amount>1099.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91982736</number></phone></sender><shipping><address><street>RUA DOS JACARAND?S 1160 BL 2 APT 901, 123, 123, 123, 123</street><number>123</number><complement></complement><district>Centro</district><city>Rio de Janeiro</city><state>RJ</state><country>BRA</country><postalCode>22776050</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>sitef</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1035526740</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}
}