<?php
    include 'exercicio_php2.php';

    $user = "root";
 //   $password = "root";
    $name = $_POST['nome'];
    $mail = $_POST['mail'];
    $site = $_POST['website'];
    $comment = $_POST['comentario'];
    $db = "exe2";
    $server = "localhost";

    $link = mysql_connect($server,$user) or die("Unable to connect: " .mysql_error());
    $select = mysql_select_db($db);

    $sql = "INSERT INTO exe2 (nome,mail,website,comentario) VALUES (";
    $sql .= "'" . $name ."', ";
    $sql .= "'" . $mail ."', ";
    $sql .= "'" . $site ."', ";
    $sql .= "'" . $comment ."')";

    $result = mysql_query($sql);

    if (!$result) {
        die("Error: " .mysql_error());
    } else {
        echo("
        		<script>
         			alert('Cadastro feito com sucesso!');
        		</script>
        	");
    }
    /*try {
        $conn = new PDO("mysql:host=localhost;dbname=exe2",$usuario,$senha);
        $conn->exec("set names utf8");

        $stmt = $conn->prepare('INSERT INTO exe2(nome, mail,website,comentario) VALUES (:nome, :mail, :website, :comentario)');
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':website', $site);
        $stmt->bindValue(':comentario', $comentario);
        $stmt->execute();
    } catch (PDOException $e){
        echo $e->getMessage();
    }*/
?>