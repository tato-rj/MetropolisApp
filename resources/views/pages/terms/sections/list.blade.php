<section class="container mt-5 mb-7">
	<div class="row">
		<div class="col-default" id="terms-list">
			<p class="text-center"><strong>Termos e Condições</strong></p>
			<p>Propriedade do Website, Software, Plataforma e utilização do espaço decoworking</p>
			<p>Em conformidade com as disposições da legislação em vigor, informamos aousuário, que a provedora do Website, licenciante de software e prestadorade serviços METROPOLIS RIO, é a METROPOLIS RIO LTDA. ME, com inscriçãono CNPJ sob o número 33.064.173/0001-22, empresa com sede na AvenidaRio Branco, n.º 151, sala 403, Centro, Rio de Janeiro-RJ.</p>
			<ol class="p-0" style="list-style-type: lower-alpha;">
				@include('pages.terms.sections.markup', [
					'title' => 'Uso da Plataforma e espaço compartilhado',
					'items' => [
						'O presente documento (“Termos e Condições”) rege o contrato entreos usuários da Plataforma e licença de software, bem como o espaço decoworking e workshops, devendo ser cuidadosamente lido pelos Usuários.Se o Usuário não concordar com estes Termos e Condições, ele não devemarcar a  opção “concordo” disponível no Website após o cadastro. OsTermos e Condições estarão sempre disponíveis no Website.',
						'Os Termos e Condições, em conjunto com a Política de Privacidade da METROPOLIS RIO, constituem um acordo legal e vinculante entre o Usuário e a METROPOLIS RIO. O contrato permanecerá em vigor enquanto o Usuário tiver uma inscrição válida ou contrato em vigor e será automaticamente rescindido caso a inscrição ou o contrato seja rescindido, por qualquer motivo.',
						'O acesso aos serviços contratados será autorizado após o pagamento com liberação de conteúdo de acordo com o tipo de serviço contratado, com exceção do custo de conexão por meio da rede de telecomunicações fornecida pelo provedor de acesso do Usuário. Esses custos dependem do contrato que o Usuário tem com seu provedor de acesso, sendo que a METROPOLIS RIO não tem qualquer ingerência sobre tais custos.',
						'A METROPOLIS RIO reserva-se o direito de efetuar, a qualquer tempo, alterações e atualizações nestes Termos e Condições do  e seu e apresentação. O Usuário será notificado a respeito de tais alterações aos Termos e Condições.',
						'O Usuário compromete-se a não utilizar do Software e demais serviços fornecidos para fins fraudulentos e não manterá qualquer conduta que possa prejudicar a imagem, os interesses e os direitos da METROPOLIS RIO ou de terceiros. Compromete-se, ainda, a utilizar o Programa, Software e , bem como os serviços e os conteúdos nele contidos, de maneira diligente, correta e dentro dos parâmetros legais. Especificamente, o Usuário compromete-se a não excluir, contornar ou manipular direitos autorais, bem como os dispositivos de proteção técnica ou quaisquer mecanismos de informações que possam incluir esses conteúdos. O Usuário também se compromete a não tomar qualquer medida para danificar, desabilitar ou sobrecarregar o Sistema, ou de alguma forma prejudicar o uso e a operação normais da Plataforma.',
						'Caso o Usuário descumpra estes Termos e Condições ou caso a METROPOLIS RIO suspeite, razoavelmente, a seu critério exclusivo, quanto o descumprindo destes Termos e Condições, reserva-se o direito de suspender ou rescindir o contrato ou acesso do Usuário adotando as medidas necessárias para esse fim.',
						'O Usuário concorda em desobrigar e isentar de responsabilidade a METROPOLIS RIO, seus sócios, diretores, funcionários, representantes e terceiros licenciadores, em relação a todas e quaisquer responsabilidades, perdas, danos, reivindicações e despesas, inclusive honorários advocatícios, em relação (i) ao descumprimento pelo Usuário destes Termos e Condições, dos direitos da METROPOLIS RIO ou de qualquer outra pessoa física ou jurídica, (ii) ao uso ou uso inadequado ou o acesso ao Programa por parte do Usuário, e/ou (iii) a qualquer conteúdo que o Usuário disponibilizar por meio do Programa. Para que não haja dúvidas, esta cláusula subsistirá à rescisão da inscrição do Usuário na Plataforma.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Requisitos',
					'items' => [
						'Todas as pessoas físicas maiores e capazes, assim como pessoas jurídicas poderão contratar os serviços disponibilizados na Plataforma da METROPOLIS RIO.',
						'Para contratar os serviços basta acessar o espaço “Área do Cliente” no Website <a href="https://metropolisrio.com.br" target="_blank">https://metropolisrio.com.br</a> preencher corretamente todos os campos no formulário do Website. Após concluído o cadastro,  o Usuário receberá um e-mail para confirmação da assinatura e liberação do acesso na plataforma. Finalizada esta etapa, basta selecionar o serviço a ser contratado e selecionar a modalidade de pagamento.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Declarações de Acesso Inerentes ao Serviço',
					'html' => '<div style="padding-left: 40px">
									<p style="margin-bottom: .5em; margin-top: .5em;">Ao inscrever-se na Plataforma METROPOLIS RIO, os Usuários reconhecem que:</p>
									<p style="margin-bottom: .5em; margin-top: .5em;">(i) este Programa, Plataforma e Website são dirigidos a as pessoas físicas maiores e capazes, não sujeitas a limitações, proibições e/ou restrições em sua capacidade civil, assim como pessoas jurídicas;</p>
									<p style="margin-bottom: .5em; margin-top: .5em;">(ii) a inscrição na Plataforma é voluntária, e os Usuários que desejem efetuar a contratação estão obrigados a se inscrever na plataforma;</p>
									<p style="margin-bottom: .5em; margin-top: .5em;">(iii) exceto conforme expressamente indicado nestes Termos e Condições, o acesso ou inscrição na Plataforma será rescindida quando os Usuários deixarem de cumprir os requisitos previstos nesta cláusula 3.3. destes Termos e Condições e/ou quando sua capacidade civil for limitada. A METROPOLIS RIO reserva-se ao direito de cancelar a participação de qualquer pessoa que deixe de cumprir esses requisitos de inscrição no Programa ou que não forneça as informações solicitadas para inscrição.</p>
								</div>'
				])
				
				@include('pages.terms.sections.markup', [
					'title' => 'Segurança',
					'items' => [
						'O Usuário é exclusivamente responsável pelo uso e proteção da confidencialidade do nome do usuário, conta completa, número de cadastro, verificação de e-mail e da senha que forem fornecidas ou que tiverem sido selecionadas para uso do Website e acesso a sala de coworking.  Nenhuma dessas informações devem ser compartilhadas ou fornecidas a terceiros. Devemos ser notificados por escrito imediatamente a respeito de qualquer uso não autorizado do nome de usuário e/ou da senha ou qualquer informação fornecida pelo usuário ou pelo sistema ou a respeito de qualquer outra violação de segurança relacionada ao Website, plataforma ou controle de acesso as salas de coworking.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Alteração destes Termos e Condições',
					'items' => [
						'Reservamo-nos o direito de alterar, atualizar e/ou eliminar quaisquer seções destes Termos e Condições a qualquer tempo. Essas alterações serão aplicáveis uma vez publicadas em nossa Plataforma ou Website e, observada a cláusula 2.4, é responsabilidade dos Usuários ler os Termos e Condições sempre que utilizarem o Website e demais serviços da METROPOLIS RIO. Quando for técnica e razoavelmente possível, os Usuários serão notificados antecipadamente a respeito de tais alterações.',
						'Os Termos e Condições então em vigor aplicam-se a cada atividade realizada com relação a Plataforma e/ou Website.',
						'O uso continuado da Plaltaforma, Website e demais serviços significa que o Usuário aceita e cumprirá os Termos e Condições atuais. Caso você, Usuário, não aceite os Termos e Condições atuais, você não poderá utilizar quaisquer dos serviços prestados pela METROPOLIS RIO.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Proteção de informações pessoais',
					'items' => [
						'Quaisquer informações pessoais que você fornecer ao efetuar o cadastro em nossa Plataforma/Website serão processadas e utilizadas em conformidade com nossa Política de Privacidade. Ao efetuar o cadastro, você concorda e consente com tal processamento e com seus termos.',
						'As normas que regem aspectos relativos ao processamento de dados pessoais de Usuários em virtude do cadastro na Política de Privacidade anexada a diversos formulários de coleta de dados que podem estar incluídos no Aplicativo e no Website.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Direitos de Propriedade Intelectual e Industrial',
					'items' => [
						'Os direitos de propriedade intelectual sobre o layout do conteúdo do Programa, Software e Website, o projeto gráfico (aparência e funcionamento), os símbolos distintivos (marcas e nomes comerciais), os programas de computador subjacentes (inclusive códigos fonte) e os diversos elementos que compõem o Aplicativo e o Website (texto, imagens, fotografias, vídeos, etc.) são propriedade exclusiva da METROPOLIS RIO, e nesse sentido, são obras protegidas pela atual legislação de direitos de propriedade intelectual e industrial em vigor.',
						'A liberação de acesso ao software ou plataforma pelo Usuário não significa de forma alguma transferência de quaisquer direitos de propriedade intelectual e/ou industrial sobre os mesmos, seus conteúdos e/ou e os símbolos distintivos da METROPOLIS RIO ao Usuário ou a qualquer outra parte. Para esse fim e por meio destes Termos e Condições, exceto nos casos em que houver permissão legal, o Usuário está expressamente proibido de reproduzir, alterar, distribuir, comunicar publicamente, disponibilizar, extrair e/ou reutilizar o Programa, Software, Plataforma e Website, seu conteúdo e/ou os símbolos distintivos da METROPOLIS RIO.',
						'É expressamente proibido reproduzir elementos do Programa, Software, Website e/ou seus conteúdos para fins lucrativos ou comerciais.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Limitação de Responsabilidade',
					'items' => [
						'O Usuário reconhece e concorda que o uso do Software é sempre e totalmente por sua conta e risco; portanto, a METROPOLIS RIO, na máxima extensão permitida pela lei aplicável, não aceita responsabilidade por qualquer mal uso ou uso indevido.',
						'O Software, Plataforma e o Website poderão conter conteúdo de publicidade de terceiros ou ser patrocinado por terceiros. Em hipótese alguma a METROPOLIS RIO será responsável por qualquer inexatidão, insuficiência, declaração enganosa ou irregularidades que tal publicidade ou material de patrocínio possa conter.',
						'O Usuário reconhece a ausência de responsabilidade da METROPOLIS RIO por qualquer erro de impressão ou de computador, omissão, irregularidade, exclusão, defeito, demora em operações ou transmissão, furto ou destruição, acesso não autorizado ou alteração de materiais do Programa ou por funcionamento incorreto técnico, de rede, eletrônico, de computador, de hardware ou de software de qualquer espécie, ou transmissão inexata de informações do Programa em virtude de problemas técnicos ou congestionamento de tráfego na internet ou qualquer combinação desses fatores.',
						'A METROPOLIS RIO não será responsável por falha ou atraso no cumprimento de qualquer uma de suas obrigações previstas nestes Termos e Condições e/ou no Programa que seja causado por um evento fora de seu controle ou por um evento de Força Maior.',
						'Força Maior significa, para fins desta cláusula, qualquer ato ou evento fora do controle razoável da METROPOLIS RIO, inclusive, sem limitação, greves, greves patronais ou outra ação de terceiros, falha ou atraso de fornecedor, comoção civil, tumulto, invasão, incêndio, explosão, tempestade, inundação, terremoto, desequilíbrio, epidemia ou qualquer outro desastre natural, ou falha de redes de telecomunicações públicas ou privadas.',
						'Caso ocorra um Evento de Força Maior que afete o cumprimento das obrigações da METROPOLIS RIO previstas nestes Termos e Condições notificará o Usuário assim que for razoavelmente possível.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Coworking',
					'items' => [
						'O serviço inclui o direito ao uso de espaço não demarcado, de acordo com o pacote especificado no web site da MERTROPOLIS RIO, localizado nas dependências da contratada, com cadeira, mesa, acesso livre a internet (wifi), utilização de banheiros do prédio, não contemplando prejuízos eventualmente gerados pela má utilização do espaço.',
						'Não está incluído no presente contrato a disponibilização de computadores ou notebooks, sendo de responsabilidade do usuário tal equipamento.',
						'Se durante o curso do contrato o usuário contratar serviços avulsos de workshops, deverá efetuar o pagamento a parte do valor do serviço extra utilizado segundo a política de preços divulgada no Website da METROPOLIS RIO.',
						'Se durante o curso do contrato o usuário contratar serviços avulsos de workshops, deverá efetuar o pagamento a parte do valor do serviço extra utilizado segundo a política de preços divulgada no Website da METROPOLIS RIO.',
						'O horário de funcionamento da METROPOLIS RIO para utilização do espaço de coworking é de segunda-feira às sexta-feira entre 10:00 e 18:00, podendo sofrer alterações, desde que avisado com antecedência e não gere prejuízo ao plano adquirido pelo usuário. Em hipótese de caso fortuito ou força maior, o horário de funcionamento poderá ser alterado sem prévio aviso sem caracterização de violação contratual pela METROPOLIS RIO.',
						'É vedada a utilização do espaço de coworking para realização de filmagens ou fotografias sem o expresso consentimento da METROPOLIS RIO, assim como gravações ou escutas ambientais e dos conteúdos de workshops lecionados com ou sem autorização dos interlocutores.',
						'Tendo em vista tratar-se de ambiente para o desenvolvimento de atividades comerciais e de  nível de ruído deve ser mínimo para não perturbar os demais usuários, sendo vedada a entrada de animais, alimentos e qualquer tipo de cigarro, ainda que eletrônico.',
						'Os contratos estabelecidos entre o usuários e terceiros não gera para a METROPOLIS RIO qualquer responsabilidade em razão do usuário ou de terceiros contratantes.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Informações Gerais',
					'items' => [
						'A METROPOLIS RIO reserva-se o direito de transferir seus direitos e obrigações previstas nestes Termos e Condições a outra organização, em caso de aquisição, fusão ou outro evento.',
						'Qualquer contrato concluído em conformidade com o Programa e/ou estes Termos e Condições é entre o Usuário e a METROPOLIS RIO. Nenhum terceiro terá qualquer direito de executar quaisquer de seus termos. Em qualquer hipótese, o acesso as salas de coworking, a navegação e o uso do Software e/ou Website e, se for o caso, o uso ou a locação dos produtos ou serviços são responsabilidade única e exclusiva do Usuário.',
						'A não exigência do cumprimento de qualquer obrigação não implica renúncia ao direito de exigi-lo posteriormente.',
						'Se qualquer disposição contida nestes Termos e Condições for declarada nula ou inválida, ela deverá ser removida ou substituída. Em qualquer hipótese, não afetará a validade das demais disposições contidas nestas condições.',
						'Cabe à METROPOLIS RIO, imotivadamente, rescindir o contrato, o Website e/ou Software, mediante notificação prévia ao endereço de correio eletrônico fornecido pelo Usuário com antecedência de 90 (noventa) dias. Nesta hipótese, estes Termos e Condições serão rescindidos ou modificados, de acordo com os serviços cancelados.'
					]
				])

				@include('pages.terms.sections.markup', [
					'title' => 'Como você pode entrar em contato conosco',
					'items' => [
						'Se tiver quaisquer dúvidas sobre ou se tiver quaisquer reclamações, entre em contato com nossa Equipe de Atendimento a Cliente pelo correio eletrônico <a href="mailto:contato@metropolisrio.com.br">contato@metropolisrio.com.br</a> ou acesse o site <a href="https://metropolisrio.com.br/contato" target="_blank">https://metropolisrio.com.br/contato</a>'
					]
				])
			</ol>
		</div>
	</div>
</section>