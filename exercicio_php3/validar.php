<?php
		include 'exercicio_php3.php';	
		$Login = $_POST['login'];
		$Pswd = $_POST['pswd'];
		if ((strcmp($Login,$_SESSION['login'])==0) && 
    		(strcmp($Pswd,$_SESSION['pswd'])==0)) {
   				header("Location: exercicio_php1.php");
		}
		else {
 			echo("
        		<script>
         			alert('Usuario ou senha incorretos!')
        			location.href= 'exercicio_php3.php'
        		</script>
        	");
		}
?>