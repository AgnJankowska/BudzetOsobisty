<?php
session_start();
unset($_SESSION['showed']);
if (!isset($_SESSION['logged'])) {
	header('Location: index.php');
	exit();}
	
require_once "database.php";

$result_expense = $connection->prepare('SELECT * FROM expenses_category_assigned_to_users WHERE user_id = :prep_id');
$result_expense->bindValue(':prep_id', $_SESSION['id'], PDO::PARAM_INT);
$result_expense->execute();

$_SESSION['records_expense'] = $result_expense->fetchAll();

$result_method = $connection->prepare('SELECT * FROM payment_methods_assigned_to_users WHERE user_id = :prep_id');
$result_method->bindValue(':prep_id', $_SESSION['id'], PDO::PARAM_INT);
$result_method->execute();

$_SESSION['records_method'] = $result_method->fetchAll();

?>
<!DOCTYPE html>
<html lang="pl">
  
<head>  
	<meta charset="utf-8"/>
	<title>Tytuł strony</title>
	<meta name="description" content="Opis mojej strony"/>
	<meta name="keywords" content="słowa kluczowe"/> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Expanded&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="css/fontello.css" type="text/css"/>
	
</head>

<body>
	<header>
		<div class="title py-1 px-2 mb-5">
			<h1 class="font-weight-bold text-uppercase py-2"> Budżet osobisty</h1>
			<h2 class="pb-2">Zacznij oszczędzać by spełniać swoje marzenia</h2>

			<nav class="navbar-expand-lg navbar navbar-dark mt-3 menu">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="mainmenu">
					<ul class="navbar-nav mx-auto">
						<li class="nav-item mx-lg-1">
							<a href="menu.php" class="nav-link"><i class="icon-home"></i>Start</a>
						</li>
						<li class="nav-item active mx-lg-1">
							<a href="wydatek.php" class="nav-link"><i class="icon-credit-card"></i>Dodaj wydatek</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="przychod.php" class="nav-link"><i class="icon-chart-line"></i>Dodaj przychód</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="bilans.php" class="nav-link"><i class="icon-chart-pie"></i>Bilans</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="#.php" class="nav-link"><i class="icon-cogs"></i>Ustawienia</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="wyloguj.php" class="nav-link"><i class="icon-logout"></i>Wyloguj</a>
						</li>
					</ul>    
				</div>
			</nav>
		</div>
	</header>
	
	<main>	
		<section>
			<div class ="container p-0 mb-5">
				<div class ="row m-0">			
					<div class ="col-lg-8 col-sm-10 p-0 bg-light text-secondary mx-auto">
					
						<h1 class="head mx-auto p-3">
							<span class="fontello mr-3"><i class="icon-credit-card"></i></span>Dodaj wydatek
						</h1>
					
						<form class="form form-inline mt-4" action="wydatekPHP.php" method="post">
							
							<label class="textright col-3 col-xl-2 offset-xl-1 mb-3 mr-4" for="amountOfMoney">Kwota</label>
							<input class="col-7 form-control mb-3" name="amount" id="amountOfMoney" type="number" step="0.01" required/>
							
							<div class="w-100"></div>
							
							<label class="textright col-3 col-xl-2 offset-xl-1 mb-3 mr-4" for="currentDate"> Data </label>
							<input class="col-7 form-control mb-3" name="date" id="currentDate" type="date" required/>
							
							<div class="w-100"></div>
													
							<div class="col-3 col-xl-2 offset-xl-1 mb-3 mr-4">
							<label class="textright" >Sposób płatności</label></div>							
							<select name="payMethod" class="form-control col-7 mb-3">
							
							<?php 
							
							foreach ($_SESSION['records_method'] as $record) {
								echo'<option value="'.$record['id'].'">'.$record['name'].'</option>';
							}
							
							?>
							</select>
							
							<div class="w-100"></div>
							
							<div class="col-3 col-xl-2 offset-xl-1 mb-3 mr-4">
							<label class="textright" >Kategoria</label></div>							
							<select name="category" class="form-control col-7 mb-3">
							
							<?php 
							
							foreach ($_SESSION['records_expense'] as $record) {
								echo'<option value="'.$record['id'].'">'.$record['name'].'</option>';
							}
							
							?>

							</select>
							
							<div class="w-100"></div>
							
							<label class="textright col-3 col-xl-2 offset-xl-1 mr-4" for="comment">Komentarz </label>
							<textarea class="col-7 form-control" id="comment" name="comment" cols="39" rows="1"></textarea>
				
							<div class="w-100"></div>
										
							<div class="col-12 py-4 mx-auto buttons">
					
								<button class="d-inline button2 mx-2"><i class="icon-ok"></i>Dodaj</button>
								<a href="menu.php"><div class="d-inline button mx-2"><i class="icon-cancel"></i>Anuluj</div></a>
															
							</div>
						</form>
						
						<?php						
							if(isset($_SESSION['added_expense'])){
								echo '<script type="text/javascript"> 
										window.onload = showModal;
										function showModal(){
										$("#Modal").modal();}
									</script>';	
								unset($_SESSION['added_expense']);
							}
						?>
						
						<!-- Modal -->
						<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Nowy wydatek</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Do bilansu został dodany nowy wydatek.<br> Tak trzymaj i dodawaj wszystkie wydatki!
									</div>
									<div class="modal-footer">
										<a href="przychod.php"><button type="button" class="btn btn-primary" data-dismiss="modal">Dodaj nowy wydatek</button></a>
										<a href="menu.php"><button type="button" class="btn btn-secondary">Powrót do menu</button></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			<div id="extra"></div>	
		</section>
	</main>
	
	
	<footer>
		<div id="information">2020 &copy; Created by: Agnieszka Jankowska</div>
	</footer>
	
	<script src="script.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
	integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
	crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>

	</body>
</html>		

	
	
