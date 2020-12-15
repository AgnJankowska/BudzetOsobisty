<?php       
require_once "connect.php";
try {	
	$connection = new PDO('mysql:host='.$host.'; dbname='.$database.'; charset=utf8', $user, $password, [
		PDO::ATTR_EMULATE_PREPARES => false, 
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	]);
}	
catch (PDOException $error) {	
	exit("Błąd połączenia z bazą danych!");
}

?>  

