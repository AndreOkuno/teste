<?php
		$estados = array(2, 3, 4, 4);
		$soma = 0;
		$x=4;
	echo "OI<br>";

	echo $estados[0];
	
	foreach($estados as $values){
		$soma = $values + $x;
		echo $soma;
	}
	/*function test_input($conteudo){
		$conteudo = trim($conteudo);
		$conteudo = stripslashes($conteudo);
		$conteudo = htmlspecialchars($conteudo);
	}
	$nome = $telefone = $endereco = $senha = $descricao = $selecao = "";
	$nome = teste_input($_POST["name"]);*/
	
	
?>

<br>
<html>
<h1> teste de validacao php</h1>
<body>

 nome <?php echo $_POST["nome"]; ?><br>
telefone: <?php echo $_POST["telefone"]; ?><br>
endereco: <?php echo $_POST["endereco"];?><br>
senha: <?php echo $_POST["senha"];?><br>
descricao: <?php echo $_POST["descr"];?>
selecao: <?php echo $_POST["selecao"];?>
</body>
</html> 