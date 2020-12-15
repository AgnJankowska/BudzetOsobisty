<?php
session_start();
require_once "database.php";
unset($_SESSION['error']);

//zabezpieczenie przed wejściem "z paska"
if (!isset($_POST['date_start'])) {
  header('Location: bilans.php');
  exit();}

$range = filter_input(INPUT_POST, 'range');

if(!isset($range)){
	$range = '4';
}

$date_start = filter_input(INPUT_POST, 'date_start');
$date_end = filter_input(INPUT_POST, 'date_end');

if($date_start > $date_end){
	$_SESSION['error'] = "Nieprawidłowy zakres dat.";
}

$_SESSION['showed'] = true;

$_SESSION['fr_range']=$range;	
$_SESSION['fr_date_start']=$date_start;
$_SESSION['fr_date_end']=$date_end;

$result_income = $connection->prepare('SELECT incomes_category_assigned_to_users.name, SUM(incomes.amount) AS "amountSum" FROM incomes, incomes_category_assigned_to_users WHERE incomes.user_id = :prep_id AND incomes_category_assigned_to_users.user_id = incomes.user_id AND incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.date_of_income BETWEEN :prep_startDate AND :prep_endDate GROUP BY incomes_category_assigned_to_users.name ORDER BY amountSum DESC');

$result_income->bindValue(':prep_id', $_SESSION['id'], PDO::PARAM_INT);
$result_income->bindValue(':prep_startDate', $date_start, PDO::PARAM_STR);
$result_income->bindValue(':prep_endDate', $date_end, PDO::PARAM_STR);
$result_income->execute();
$_SESSION['incomes'] = $result_income->fetchAll();
$_SESSION['sum_incomes']=array_sum(array_column($_SESSION['incomes'], 'amountSum'));

if (!$result_income) throw new PDOException;

$result_expense = $connection->prepare('SELECT expenses_category_assigned_to_users.name, SUM(expenses.amount) AS "amountSum" FROM expenses, expenses_category_assigned_to_users WHERE expenses.user_id = :prep_id AND expenses_category_assigned_to_users.user_id = expenses.user_id AND expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.date_of_expense BETWEEN :prep_startDate AND :prep_endDate GROUP BY expenses_category_assigned_to_users.name ORDER BY amountSum DESC');

$result_expense->bindValue(':prep_id', $_SESSION['id'], PDO::PARAM_INT);
$result_expense->bindValue(':prep_startDate', $date_start, PDO::PARAM_STR);
$result_expense->bindValue(':prep_endDate', $date_end, PDO::PARAM_STR);
$result_expense->execute();
$_SESSION['expenses'] = $result_expense->fetchAll();
$_SESSION['sum_expenses']=array_sum(array_column($_SESSION['expenses'], 'amountSum'));

$_SESSION['savings'] = ($_SESSION['sum_incomes'] - $_SESSION['sum_expenses']);

if (!$result_expense) throw new PDOException;

header('Location: bilans.php');

?>  
