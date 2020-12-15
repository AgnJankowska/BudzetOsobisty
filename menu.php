<?php
session_start();
unset($_SESSION['showed']);
if (!isset($_SESSION['logged'])) {
	header('Location: index.php');
	exit();}
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
						<li class="nav-item active mx-lg-1">
							<a href="menu.php" class="nav-link"><i class="icon-home"></i>Start</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="wydatek.php" class="nav-link"><i class="icon-credit-card"></i>Dodaj wydatek</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="przychod.php" class="nav-link"><i class="icon-chart-line"></i>Dodaj przychód</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="bilans.php" class="nav-link"><i class="icon-chart-pie"></i>Bilans</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="#.html" class="nav-link"><i class="icon-cogs"></i>Ustawienia</a>
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
			<div class ="container p-0">
				<div class ="row m-0">

					<div class ="col-sm-12 mb-4 p-0 bg-light text-secondary">					
					<div class="text1 my-3 font-weight-bold"><span class="text3"><?php echo$_SESSION['username']?></span>, witaj w aplikacji BUDŻET OSOBISTY!</div>
						
						<div class="text2 p-3 mb-3">
						
							<p>Do dyspozycji masz 3 opcje - dadanie wydatku lub przychodu oraz bilans, który obejmuje szczególowe podsumowanie twojego budżetu we wskazanym okresie.</p>
							
							<p>Dostep do aplikacji masz z dowolnego urządzenia mobilnego, dlatego bieżące uzupełnianie danych pozwoli Ci szybko osiągnąć cel - zacząć oszczędzać pieniądze na realizację marzeń.</p>
													
						</div>
						
						<div class="text3 my-2">
							<p>Rozpocznij regularne dodawanie wydatków i przychodów</p>
						</div>						
					</div>

					<div class ="col-sm-12 col-md-4 mt-1 mb-4">
						<a href="wydatek.php">
							<div class="col-md-12 tile1b py-2">
								<span class="fontello"><i class="icon-credit-card"></i></span>
								<p>Dodaj wydatek</p>
							</div>
						</a>
					</div>

					<div class ="col-sm-12 col-md-4 mt-1 mb-4">
						<a href="przychod.php">
							<div class="col-md-12 tile1b py-2">
								<span class="fontello"><i class="icon-chart-line"></i></span>
								<p>Dodaj przychód</p>
							</div>
						</a>
					</div>

					<div class ="col-sm-12 col-md-4 mt-1 mb-4">
						<a href="bilans.php">
							<div class="col-md-12 tile1b py-2">
								<span class="fontello"><i class="icon-chart-pie"></i></span>
								<p>Bilans</p>
							</div>
						</a>
					</div>			
				</div>
			</div>
			
			<div id="extra"></div>	
		</section>
	</main>
	
	
	<footer>
		<div id="information">2020 &copy; Created by: Agnieszka Jankowska</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
	integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
	crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>

	</body>
</html>		
