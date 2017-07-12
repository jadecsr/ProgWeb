<?php
	session_start();
	$_SESSION['login'] = "demo";
	$_SESSION['pswd'] = "demo";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Instituto de Computação</title>
</head>
<body>
	<form name="logar" action="validar.php" method="post">
		Login: <input type="text" name="login">
		Senha: <input type="password" name="pswd">
		<input type="submit" value="Logar">
	</form>
</body>
</html>
