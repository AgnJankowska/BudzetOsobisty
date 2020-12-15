<?php
session_start();
  
if (isset($_POST['email'])){

$correctVerification=true;
       
//checking the name
$name = $_POST['name'];
if ((strlen($name)<3) || (strlen($name)>20)){
$correctVerification=false;
$_SESSION['e_name']="Wymagana ilość znaków od 3 do 20";}
        
if (ctype_alnum($name)==false){
$correctVerification=false;
$_SESSION['e_name']="Wprowadzono niepoprawne znaki";}
 
// checking the email
$email = $_POST['email'];
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
        
if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){
$correctVerification=false;
$_SESSION['e_email']="Podano niepoprawny adres e-mail";}
  
//checking the password
$password = $_POST['password'];
        
if ((strlen($password)<5) || (strlen($password)>20)){
$correctVerification=false;
$_SESSION['e_password']="Wymagana ilość znaków od 5 do 20";}
       
$password_hash = password_hash($password, PASSWORD_DEFAULT);
}
              
//remember the entered data
$_SESSION['fr_name'] = $name;
$_SESSION['fr_email'] = $email;
$_SESSION['fr_password'] = $password;

        
require_once "database.php";
	
	//does email exist? 
	$result = $connection->prepare('SELECT id FROM users WHERE email = :prep_email');
	$result->bindValue(':prep_email', $email, PDO::PARAM_STR);
	$result->execute();

	if (!$result) throw new PDOException;           
	
	$number_of_emials = $result->rowCount();
	if($number_of_emials>0){
	$correctVerification=false;
	$_SESSION['e_email']="Podany adres już znajduje się w bazie";
	}        
	
	//registration in the database 
	if ($correctVerification==true){

		$result = $connection->prepare('INSERT INTO users VALUES (NULL, :prep_name, :prep_password, :prep_email)');
		$result->bindValue(':prep_name', $name, PDO::PARAM_STR);
		$result->bindValue(':prep_password', $password_hash, PDO::PARAM_STR);
		$result->bindValue(':prep_email', $email, PDO::PARAM_STR);
		$result->execute();
		if (!$result) throw new PDOException;
		
		$result2 = $connection->prepare('SELECT id FROM users WHERE email=:prep_email');
		$result2->bindValue(':prep_email', $email, PDO::PARAM_STR);
		$result2->execute();
		if (!$result2) throw new PDOException;
		
		$user_id = $result2->fetch();
		
		$result3 = $connection->prepare('INSERT INTO expenses_category_assigned_to_users(user_id, name) SELECT :prep_user_id, name FROM expenses_category_default ');
		$result3->bindValue(':prep_user_id', $user_id['id'], PDO::PARAM_INT);		
		$result3->execute();
		if (!$result3) throw new PDOException;
		
		$result_alter = $connection->prepare('alter table expenses_category_assigned_to_users AUTO_INCREMENT=16');
		$result_alter->execute();
		if (!$result_alter) throw new PDOException;
		
		$result4 = $connection->prepare('INSERT INTO incomes_category_assigned_to_users(user_id, name) SELECT :prep_user_id, name FROM incomes_category_default ');
		$result4->bindValue(':prep_user_id', $user_id['id'], PDO::PARAM_INT);		
		$result4->execute();
		if (!$result4) throw new PDOException;
		
		$result_alter = $connection->prepare('alter table incomes_category_assigned_to_users AUTO_INCREMENT=4');
		$result_alter->execute();
		if (!$result_alter) throw new PDOException;	
		
		$result5 = $connection->prepare('INSERT INTO payment_methods_assigned_to_users(user_id, name) SELECT :prep_user_id, name FROM payment_methods_default ');
		$result5->bindValue(':prep_user_id', $user_id['id'], PDO::PARAM_INT);		
		$result5->execute();
		if (!$result5) throw new PDOException;

		$result_alter = $connection->prepare('alter table payment_methods_assigned_to_users AUTO_INCREMENT=3');
		$result_alter->execute();
		if (!$result_alter) throw new PDOException;

		header('Location: logowanie.php');
		$_SESSION['registration_complete'] = true;
	} 
	
	else{
		header('Location: rejestracja.php');
	}
?>  
