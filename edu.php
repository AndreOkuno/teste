<!DOCTYPE html>

	<head>

		<title>Formulário PHP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--arquivo css-->
		<link rel="stylesheet" href="formulario2.css">
		<!--arquivo jQuery-->
		<script language="javascript" src="formulario2.js"></script>

	</head>

	<body>

		<!--?php
			echo "<pre>";
				print_r($_POST);
			echo "</pre>";
		?>-->

		<!--VALIDAÇÃO E CAPTURA DE DADOS-->
		<?php
			function contains_number($string) {
				return is_numeric(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
			}
			$nome = $unidade = $optradio = "";
			$rua = $numero = $apto = $bairro = $cidade = $cep = "";
			$o = $m = $om = $to = $tm = "";
			$outros = $municipal = $intermunicipal = "";
			$empresa = $selecione = $observacoes = "";
			$flag = $tipo = ""; $aceita = 1;
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$flag = false;
				if(empty($_POST["nome"])) {
					//echo "<script>alert('Digite um nome');</script>";
					$flag = false;
				}
				else {
					$nome = test_input($_POST["nome"]);
					if(contains_number($nome)) {
						//echo "<script>alert('Nome inválido');</script>";
						$flag = false;
					}
					$flag = true;
				}
				if(empty($_POST["unidade"])) {
					//echo "<script>alert('Digite uma unidade');</script>";
					$flag = false;
				}
				else {
					$unidade = test_input($_POST["unidade"]);
					$flag = true;
				}
				//echo "<style type='text/css'>#esconder{display:none;}</style>";
				$optradio = test_input($_POST["optradio"]);
				if(!strcmp($_POST["optradio"], "SIM")) {
					$flag = false;
					//echo "<style type='text/css'>#esconder{display:inline;}</style>";
					if (empty($_POST["rua"])) {
						//echo "<script>alert('Digite uma rua');</script>";
						$flag = false;
					}
					else {
						$rua = test_input($_POST["rua"]);
						if(contains_number($rua)) {
							//echo "<script>alert('Rua inválida');</script>";
							$flag = false;
						}
						$flag = true;
					}
					if (empty($_POST["numero"])) {
						//echo "<script>alert('Digite um número');</script>";
						$flag = false;
					}
					else {
						$numero = test_input($_POST["numero"]);
						if(preg_match("/^[a-zA-Z ]*$/", $numero)) {
							//echo "<script>alert('Número da casa inválido');</script>";
							$flag = false;
						}
						$flag = true;
					}
					if (empty($_POST["bairro"])) {
						//echo "<script>alert('Digite um bairro');</script>";
						$flag = false;
					}
					else {
						$bairro = test_input($_POST["bairro"]);
						if (contains_number($bairro)) {
							//echo "<script>alert('Bairro inválido');</script>";
							$flag = false;
						}
						$flag = true;
					}
					if(empty($_POST["cidade"])) {
						//echo "<script>alert('Digite uma cidade');</script>";
						$flag = false;
					}
					else {
						$cidade = test_input($_POST["cidade"]);
						if(contains_number($cidade)) {
							//echo "<script>alert('Cidade inválida');</script>";
							$flag = false;
						}
						$flag = true;
					}
					if (empty($_POST["cep"])) {
						//echo "<script>alert('Digite um CEP');</script>";
						$flag = false;
					}
					else {
						$cep =test_input($_POST["cep"]);
						if(preg_match("/^[a-zA-Z ]*$/", $cep)) {
							//echo "<script>alert('CEP inválido');</script>";
							$flag = false;
						}
						$flag = true;
					}
					$apto = test_input($_POST["apto"]);
					if(!empty($_POST["apto"])) {
						if(preg_match("/^[a-zA-Z ]*$/", $apto)) {
							//echo "<script>alert('Apto inválido');</script>";
							$flag = false;
						}
					}
					if(!isset($_POST["o"]) && !isset($_POST["m"]) && !isset($_POST["om"]) && !isset($_POST["to"]) && !isset($_POST["tm"])) {
						if (empty($_POST["outros"])) {
							//echo "<script>alert('Selecione no mínimo um meio de transporte ou especifique outro');</script>";
							$flag = false;
						}
						else {
							$outros = test_input($_POST["outros"]);
							if (!preg_match("/^[a-zA-Z ]*$/", $outros)) {
								//echo "<script>alert('Meio(s) de trasnporte especificado(s) inválido (s)');</script>";
								$flag = false;
							}
							$flag = true;
						}
					}
					if(isset($_POST["o"])){
						$o = $_POST["o"];
						$tipo .= "Ônibus ";
					}
					if(isset($_POST["m"])){
						$m = $_POST["m"];
						$tipo .= "Metrô ";
					}
					if(isset($_POST["om"])){
						$om = $_POST["om"];
						$tipo .= "Ônibus e Metrô ";
					}
					if(isset($_POST["to"])){
						$to = $_POST["to"];
						$tipo .= "Trem e Ônibus ";
					}
					if(isset($_POST["tm"])){
						$tm = $_POST["tm"];
						$tipo .= "Trem e Metrô";
					}
					if (!isset($_POST["municipal"]) && !isset($_POST["intermunicipal"])){
						//echo "<script>alert('Escolha ao menos um perímetro');</script>";
						$flag = false;
					}
					else{
						if(isset($_POST["municipal"])){
							$municipal = "Municipal";
							$perimetro = "Municipal";
						}
						if(isset($_POST["intermunicipal"])){
							$intermunicipal = "Intermunicipal";
							$perimetro = "Intermunicipal";
							if(empty($_POST["empresa"])) {
								//echo "<script>alert('Digite uma empresa');</script>";
								$flag = false;
							}
							else {
								$empresa = test_input($_POST["empresa"]);
								if (!preg_match("/^[a-zA-Z ]*$/", $empresa)) {
									//echo "<script>alert('Empresa inválida');</script>";
									$flag = false;
								}
							}
						}
					}
					if(empty($_POST["selecione"])){
						//echo "<script>alert('Selecione o número de conduções');</script>";
						$flag = false;
					}
					else{
						$selecione = test_input($_POST["selecione"]);
					}
					$aceita = 1;
				}
				else{
					$_POST["optradio"] = "NÃO";
					$aceita = 0;
				}
				if(!empty($_POST["observacoes"])){
					$observacoes = test_input($_POST["observacoes"]);
				}
				inserir($nome, $rua, $bairro, $apto, $cidade, $numero, $cep, $unidade, $aceita, $tipo, $perimetro, $empresa, $selecione);
			}
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			//BANCO DE DADOS PDO
			function inserir($nome, $rua, $bairro, $apto, $cidade, $numero, $cep, $unidade, $aceita, $tipo, $perimetro, $empresa, $conducao){
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "test";
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,
						array(
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_PERSISTENT => false,
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					));
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sqlDrop = "DROP DATABASE IF EXISTS myDBPDO";
					$conn->exec($sqlDrop);
					$sqlCreate = "CREATE DATABASE myDBPDO";
					$conn->exec($sqlCreate);
					echo "Database created successfully<br>";
					echo "Connected successfully<br>";
				}
				catch(PDOException $e){
					echo "Connection failed:<br>" . $e->getMessage() . "<br>";
				}
				try{
					$sqlInserirEmpregador = "INSERT INTO empregador (nome) VALUES ('Fundacao SEADE')";
					$conn->exec($sqlInserirEmpregador);
					echo "Empregador inserido<br>";
					$idEmpregador = $conn->lastInsertId();
				}
				catch(PDOException $e){
					echo "Empregador não inserido<br>" . $e->getMessage() . "<br>";
				}
				try{
					$sqlInserirEndereco = "INSERT INTO endereco (logradouro, numero, apartamento, bairro, cidade, cep) VALUES (:rua, :numero, :apto, :bairro, :cidade, :cep)";
					$stmt = $conn->prepare($sqlInserirEndereco);
					$stmt->bindParam(':rua', $rua);
					$stmt->bindParam(':numero', $numero);
					$stmt->bindParam(':apto', $apto);
					$stmt->bindParam(':bairro', $bairro);
					$stmt->bindParam(':cidade', $cidade);
					$stmt->bindParam(':cep', $cep);
					$stmt->execute();
					echo "Endereço inserido<br>";
					$idEndereco = $conn->lastInsertId();
				}
				catch(PDOException $e){
					echo "Endereço não inserido<br>" . $e->getMessage() . "<br>";
				}
				try{
					$sqlInserirEmpregado = "INSERT INTO empregado (id_empregador, id_endereco, nome, unidade, aceita) VALUES ('$idEmpregador', '$idEndereco', :nome, :unidade, :aceita)";
					$stmt = $conn->prepare($sqlInserirEmpregado);
					$stmt->bindParam(':nome', $nome);
					$stmt->bindParam(':unidade', $unidade);
					$stmt->bindParam(':aceita', $aceita);
					$stmt->execute();
					echo "Empregado inserido<br>";
					$idEmpregado = $conn->lastInsertId();
				}
				catch(PDOException $e){
					echo "Empregado não inserido<br>" . $e->getMessage() . "<br>";
				}
				try{
					$sqlInserirTransporte = "INSERT INTO transporte (id_empregado, tipo, perimetro, empresa, conducao) VALUES ('$idEmpregado', :tipo, :perimetro, :empresa, :conducao)";
					$stmt = $conn->prepare($sqlInserirTransporte);
					$stmt->bindParam(':tipo', $tipo);
					$stmt->bindParam(':perimetro', $perimetro);
					$stmt->bindParam(':empresa', $empresa);
					$stmt->bindParam(':conducao', $conducao);
					$stmt->execute();
					echo "Transporte inserido<br>";
					$idTransporte = $conn->lastInsertId();
				}
				catch(PDOException $e){
					echo "Transporte não inserido<br>" . $e->getMessage() . "<br>";
				}
			}
		?>

		<div class="container">
			<div class="row">
				<div class="page-header">
					<h2 class="text-center">Vale-Transporte/Declaração/Termo de Compromisso</h2>
				</div>
			</div>
			<div class="row">
				<h2 class="text-center">Esclarecimento</h2>
				<p class="text-justify">1 O valor será pago pelo beneficiário, até o limite de 6% (seis por cento) de sua remuneração
				(excluídos quaisquer adicionais ou vantagens), e pelo empregador, no que exceder a esse limite.<br>
				2 O beneficiário receberá o Vale-Transporte, para locomoção da residência ao trabalho e vice-versa, correspondente ao total dos dias úteis do mês.<br>
				3 O beneficiário que deixar de utilizar transporte coletivo deverá, sob pena de ser responsabilizado, solicitar a baixa do pedido do Vale-Transporte.</p>

				<h4><b>Empregador</b></h4>
				<b>Nome: </b>FUNDAÇÃO SISTEMA ESTADUAL DE ANÁLISE DE DADOS - SEADE<br>
				<b>Endereço: </b> Av. Casper Líbero, 464<br>

				<form class="form-horizontal" method="post" action="<?php if($flag == true) echo "imprimir.php"; ?>">
					<h4><b>Empregado</b></h4>
					<div class="form-group" id="nomediv">
						<label class="control-label col-sm-1" for="nome">Nome:</label>
						<div class="col-sm-11">
							<input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-1" for="unidade">Unidade:</label>
						<div class="col-sm-11">
							<input type="text" id="unidade" name="unidade" class="form-control" value="<?php echo $unidade;?>">
						</div>
					</div>
					<h4><b>OPÇÃO PELO SISTEMA DO VALE-TRANSPORTE</b></h4>

					<p class="text-justify">O Vale-Transporte é um direito do trabalhador. Faça sua opção por recebê-lo ou não, assinalando um dos quadros abaixo:</p>
					<div class="form-group">
						<div class="col-sm-12">
							<div id="radio">
								<label class="radio-inline"><input type="radio" name="optradio" id="sim" value="SIM" checked="checked" <?php if (isset($optradio) && $optradio=="sim") echo "checked";?>>Sim</label>
								<label class="radio-inline"><input type="radio" name="optradio" id="nao" value="NÃO" <?php if (isset($optradio) && $optradio=="nao") echo "checked";?>>Não</label>
							</div>
						</div>
					</div>

					<div id="esconder">
						<h4><b>DECLARAÇÃO</b></h4>

						<p class="text-justify">Para fazer uso do sistema do Vale-Transporte, declaro residir na:</p>
						<div class="form-group">
							<label class="control-label col-sm-1" for="rua">Rua:</label>
							<div class="col-sm-6">
								<input type="text" id="rua" name="rua" class="form-control" placeholder="Digite a rua, avenida, etc" value="<?php echo $rua;?>">
							</div>
							<label class="control-label col-sm-1" for="numero">Número:</label>
							<div class="col-sm-1">
								<input type="text" id="numero" name="numero" class="form-control" value="<?php echo $numero;?>">
							</div>
							<label class="control-label col-sm-2" for="apto">Apartamento:</label>
							<div class="col-sm-1">
								<input type="text" id="apto" name="apto" class="form-control" value="<?php echo $apto;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-1" for="bairro">Bairro:</label>
							<div class="col-sm-4">
								<input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo $bairro;?>">
							</div>
							<label class="control-label col-sm-1" for="cidade">Cidade:</label>
							<div class="col-sm-3">
								<input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo $cidade;?>">
							</div>
							<label class="control-label col-sm-1" for="cep">CEP:</label>
							<div class="col-sm-2">
								<input type="text" id="cep" name="cep" class="form-control" value="<?php echo $cep;?>">
							</div>
						</div>

						<p class="text-justify">2- Utilizo o(s) seguinte(s) meio(s) de transporte(s) de minha residência ao trabalho e vice-versa:</p>
						<div id="checkbox">
							<label class="checkbox-inline"><input type="checkbox" value ="Ônibus" id="o" name="o" <?php if ($o=="Ônibus") echo "checked";?>>Ônibus</label>
							<label class="checkbox-inline"><input type="checkbox" value="Metrô" id="m" name="m" <?php if ($m=="Metrô") echo "checked";?>>Metrô</label>
							<label class="checkbox-inline"><input type="checkbox" value="Ônibus e Metrô" id="om" name="om" <?php if ($om=="Ônibus e Metrô") echo "checked";?>>Ônibus e Metrô</label>
							<label class="checkbox-inline"><input type="checkbox" value="Trem e Ônibus" id="to" name="to" <?php if ($to=="Trem e Ônibus") echo "checked";?>>Trem e Ônibus</label>
							<label class="checkbox-inline"><input type="checkbox" value="Trem e Metrô" id="tm" name="tm" <?php if ($tm=="Trem e Metrô") echo "checked";?>>Trem e Metrô</label>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="outros">Outros (especificar):</label>
							<div class="col-sm-9">
								<input type="text" id="outros" value="<?php echo $outros;?>" name="outros" class="form-control">
							</div>
						</div>

						<p class="text-justify">2.1- No perímetro:
						<label class="checkbox-inline"><input type="checkbox" value="municipal" id="municipal" name="municipal" <?php if ($municipal=="Municipal") echo "checked";?>>Municipal</label>
						<label class="checkbox-inline"><input type="checkbox" value="intermunicipal" id="intermunicipal" name="intermunicipal" <?php if ($intermunicipal=="Intermunicipal") echo "checked";?>>Intermunicipal</label>
						</p>

						<p class="text-justify">2.2- Através da(s) seguinte(s) empresa(s) operadora(s) de transporte(s), somente quando se tratar de translados intermunicipais.</p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="empresa">Empresas:</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="empresa" name="empresa" rows="3"><?php echo $empresa;?></textarea>
							</div>
						</div>

						<p class="text-justify">2.3- Utilizando diariamente
							<select class="form-control-inline" style="width:90px" id="selecione" name="selecione">
								<option selected="selected" value="0">selecione</option>
								<option value="1" <?php if ($selecione=="1") echo "selected='selected'";?>>1</option>
								<option value="2" <?php if ($selecione=="2") echo "selected='selected'";?>>2</option>
								<option value="3" <?php if ($selecione=="3") echo "selected='selected'";?>>3</option>
								<option value="4" <?php if ($selecione=="4") echo "selected='selected'";?>>4</option>
								<option value="5" <?php if ($selecione=="5") echo "selected='selected'";?>>5</option>
								<option value="6" <?php if ($selecione=="6") echo "selected='selected'";?>>6</option>
								<option value="7" <?php if ($selecione=="7") echo "selected='selected'";?>>7</option>
								<option value="8" <?php if ($selecione=="8") echo "selected='selected'";?>>8</option>
							</select>
							condução(ões) para locomoção de minha resdiência ao trabalho e vice-versa.
						</p>

						<p class="text-justify">3- Para informações complementares, utilize o espaço abaixo:</p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="observacoes">Observações:</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="observacoes" name="observacoes" rows="3" value="<?php echo $observacoes;?>"></textarea>
							</div>
						</div>
						<div class="form-group-inline col-sm-12" id="footer" for="botao">
							<button type="button" class="btn" id="enviar" data-toggle="modal" data-target="#novaJanela">
								<span class="glyphicon glyphicon-send"></span>  Enviar jQuery
							</button>
							<input type="button" name="submit" class="btn" id="enviar" value="Enviar PHP">
							<button type="submit" class="btn" id="enviar">
								<span class="glyphicon glyphicon-save-file"></span>  Salvar
							</button>
							<button type="button" class="btn" id="enviar" onClick="deletar()">
								<span class="glyphicon glyphicon-remove-sign"></span>  Deletar
							</button>
							<button type="button" class="btn" id="enviar" onClick="alterar()">
								<span class="glyphicon glyphicon-retweet"></span>  Alterar
							</button>
							<button type="button" class="btn" id="enviar" onClick="ler()">
								<span class="glyphicon glyphicon-open-file"></span>  Ler
							</button>
						</div>
					</div>
				</form>
			</div>

			<div id="novaJanela" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Formulário preenchido</h4>
						</div>
						<div class="modal-body">
							<p>Dados enviados</p>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>
			</div>

		</div>

	</body>
</html>
