<?php

namespace Tests\PagSeguro\Traits;

trait SingleNotifications
{
	public function single_em_analise($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-24T17:53:18.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>1</type><status>2</status><lastEventDate>2019-01-26T17:37:05.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>35.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>2.15</feeAmount><netAmount>32.85</netAmount><extraAmount>0.00</extraAmount><escrowEndDate>2019-02-09T17:37:05.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>EVENTO-15483595971</id><description>Workstation</description><quantity>1</quantity><amount>35.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91891234</number></phone><documents><document><type>CPF</type><value>22111944785</value></document></documents></sender><shipping><address><street>Av. Brig. Faria Lima</street><number>1384</number><complement>apto. 114</complement><district>Jardim Paulistano</district><city>S?o Paulo</city><state>SP</state><country>BRA</country><postalCode>01452002</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>cielo</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1056784170</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function single_paga($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-24T17:53:18.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>1</type><status>3</status><lastEventDate>2019-01-26T17:39:54.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>35.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>2.15</feeAmount><netAmount>32.85</netAmount><extraAmount>0.00</extraAmount><escrowEndDate>2019-02-09T17:39:54.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>EVENTO-15483595971</id><description>Workstation</description><quantity>1</quantity><amount>35.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91891234</number></phone><documents><document><type>CPF</type><value>22111944785</value></document></documents></sender><shipping><address><street>Av. Brig. Faria Lima</street><number>1384</number><complement>apto. 114</complement><district>Jardim Paulistano</district><city>S?o Paulo</city><state>SP</state><country>BRA</country><postalCode>01452002</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>cielo</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1056784170</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function single_disponivel($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-25T04:55:16.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>1</type><status>4</status><lastEventDate>2019-01-26T17:41:44.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>35.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>2.15</feeAmount><netAmount>32.85</netAmount><extraAmount>0.00</extraAmount><escrowEndDate>2019-01-26T17:41:44.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>EVENTO-15483993141</id><description>Workstation</description><quantity>1</quantity><amount>35.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91891234</number></phone><documents><document><type>CPF</type><value>22111944785</value></document></documents></sender><shipping><address><street>Av. Brig. Faria Lima</street><number>1384</number><complement>apto. 114</complement><district>Jardim Paulistano</district><city>S?o Paulo</city><state>SP</state><country>BRA</country><postalCode>01452002</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>cielo</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1056784170</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}

	public function single_cancelada($reference = null, $code = null)
	{
		$code = $code ?? now()->timestamp;
		$reference = $reference ?? 'TEST-REFERENCE';
		
		return "<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?><transaction><date>2019-01-24T17:55:04.000-02:00</date><code>".$code."</code><reference>".$reference."</reference><type>1</type><status>7</status><cancellationSource>INTERNAL</cancellationSource><lastEventDate>2019-01-26T17:42:51.000-02:00</lastEventDate><paymentMethod><type>1</type><code>101</code></paymentMethod><grossAmount>35.00</grossAmount><discountAmount>0.00</discountAmount><feeAmount>2.15</feeAmount><netAmount>32.85</netAmount><extraAmount>0.00</extraAmount><escrowEndDate>2019-02-09T17:42:51.000-02:00</escrowEndDate><installmentCount>1</installmentCount><itemCount>1</itemCount><items><item><id>EVENTO-15483597021</id><description>Workstation</description><quantity>1</quantity><amount>35.00</amount></item></items><sender><name>Arthur Villar</name><email>c38672894586801235492@sandbox.pagseguro.com.br</email><phone><areaCode>21</areaCode><number>91891234</number></phone><documents><document><type>CPF</type><value>22111944785</value></document></documents></sender><shipping><address><street>Av. Brig. Faria Lima</street><number>1384</number><complement>apto. 114</complement><district>Jardim Paulistano</district><city>S?o Paulo</city><state>SP</state><country>BRA</country><postalCode>01452002</postalCode></address><type>3</type><cost>0.00</cost></shipping><gatewaySystem><type>cielo</type><rawCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><rawMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedCode xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><normalizedMessage xsi:nil='true' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'/><authorizationCode>0</authorizationCode><nsu>0</nsu><tid>0</tid><establishmentCode>1056784170</establishmentCode><acquirerName>CIELO</acquirerName></gatewaySystem></transaction>";
	}
}
