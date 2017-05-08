<!DOCTYPE html>
<html>
<head>
	<title>Instituto de Computação</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Formulário de Contato</h1>
	<p>Por favor, preencha o formulário abaixo e clique no botão Enviar Mensagem. Agradecemos por seu contato.</p>
	<form id="contato" method="POST" action="processa.php">
	<fieldset>
		<legend>Dados Básicos</legend>
		<label for="nome">Nome: </label>
		<input type="text" name="nome"> <br>
		<label for="mail">E-mail:</label>
		<input type="email" name="mail" placeholder="seunome@dominio.com.br"> <br>
		<label for="website">Website: </label>
		<input type="text" name="website" value="http://">
	</fieldset>
	<fieldset>
		<legend>Digite sua Mensagem: </legend>
		<textarea name="comentario" rows="5" cols="40"></textarea>
	</fieldset> <br>
	<input type="reset" value="Resetar Dados">
	<input type="submit" name="submeter" value="Enviar Mensagem">
	</form>
</body>
</html>
