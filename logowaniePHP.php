<?php
session_start();
require_once "database.php";

//zabezpieczenie przed wejściem "z paska"
if ((!isset($_POST['email'])) || (!isset($_POST['password']))) {
  header('Location: logowanie.php');
  exit();}
	
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
		
$result = $connection->prepare('SELECT * FROM users WHERE email = :email');
$result->bindValue(':email', $email, PDO::PARAM_STR);
$result->execute();
		
$user = $result->fetch();

if ($user && password_verify($password, $user['password'])) {
	$_SESSION['logged'] = true;
	$_SESSION['id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['email'] = $user['email'];

	header('Location: menu.php');		
} 
		
else {
	$_SESSION['error']='Niepoprawne dane logowania'.'<br>'.'Spróbuj jeszcze raz';

	header('Location: logowanie.php');
	exit();
}

?>  
