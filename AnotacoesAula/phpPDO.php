<?php
	
	try {
		$conn = new \PDO("mysql:host=localhost;dbname=test_oo","root","root");
		
		$query= "insert into 'products' ('name','desc') values ('ebook,'Learn javascript')";
		$return = $conn->exec($query); //selecionar, inserir e etc nas tabelas
		print_r($return); //vai retornar numero de linhas afetadas apos a query. se for um insert, vai retornar 1
	
		$query = "SELECT * FROM PRODUCTS";
		$stmt = $conn->query($query);
		/*Usando o fetch_obj, para ter acesso ao nome do produto, ficaria da seguinte forma */
		$list = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo $list[0]->name;
	//	$list = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		/*traz todos os registroS retornados pelo stmt pra uma lista. se voce especificar fetch_assoc, ele retorna um vetor associativo, fetch_obk, um vetor de objetos, e assim por diante */
		//echo $list[0]['name']; //vai aparecer o nome do primeiro registro
		//print_r($list);
		
		/* Utilizando fetchAll traz sempre todos os registros do banco. Para trazer apenas um registro, usa-se fetch, portanto o código ficaria como a seguir. Se o sql retornar varios registros, usando fetch, so vai mostrar o primeiro*/
		$query = "SELECT * FROM PRODUCTS WHERE ID='1'";
		$stmt = $conn->query($query);
		$list = $stmt->fetch(PDO::FETCH_ASSOC);
		echo $list['name'];
		
	} catch (\PDOException $e) {
		echo "Error! Message: " . $e->getMessage() . " Code: " . $e ->getCode();
	}
?>
