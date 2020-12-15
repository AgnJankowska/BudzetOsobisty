<?php
session_start();
require_once "database.php";

//zabezpieczenie przed wejściem "z paska"
if (!isset($_POST['amount'])) {
  header('Location: wydatek.php');
  exit();}
	
unset($_SESSION['added_expense']);
	
$amount = filter_input(INPUT_POST, 'amount');
$date = filter_input(INPUT_POST, 'date');
$category = filter_input(INPUT_POST, 'category');
$comment = filter_input(INPUT_POST, 'comment');
$method = filter_input(INPUT_POST, 'payMethod');

$result = $connection->prepare('INSERT INTO expenses VALUES (NULL, :prep_id, :prep_category, :prep_method, :prep_amount, :prep_date, :prep_comment)');
$result->bindValue(':prep_id', $_SESSION['id'], PDO::PARAM_INT);
$result->bindValue(':prep_category', $category, PDO::PARAM_STR);
$result->bindValue(':prep_method', $method, PDO::PARAM_STR);
$result->bindValue(':prep_amount', $amount, PDO::PARAM_STR);
$result->bindValue(':prep_date', $date , PDO::PARAM_STR);
$result->bindValue(':prep_comment', $comment, PDO::PARAM_STR);
$result->execute();

if (!$result) throw new PDOException;

$_SESSION['added_expense'] = true;
header('Location: wydatek.php');

?>  
