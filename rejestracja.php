<?php
    session_start(); 
	if (isset($_SESSION['registration_complete'])) unset($_SESSION['registration_complete']);
	
	//strona jest niedostępna dla zalogowanych użytkowników 
	if (isset($_SESSION['logged'])) {
		header('Location: menu.php');
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
		</div>
	</header>
	
	<main>	
		<section>
			<div class ="container p-0">
				<div class ="row m-0">

					<div class ="col-sm-12 mb-4 py-0 px-3 bg-light text-secondary d-none d-md-block">
						<h1 class="text1 my-3 font-weight-bold">Aplikacja webowa BUDŻET OSOBISTY umożliwia zalogowanym użytkownikom kompleksową kontrolę nad swoim budżetem. </h1>
						
						<div class="text2 pb-3 mb-3">
						
						<p>Już dziś rozpocznij świadome zarządzanie swoim portfelem w dwóch krokach: </p>
						
						<p><span class="text3">Krok 1 </span>Załóż konto w aplikacji</p>
						<p><span class="text3">Krok 2 </span>Zaloguj się i dodawaj bieżące wydatki i wpływy<p>
						
						<p class="mt-4">Już po kilku dniach będziesz mógł rozpocząć analizę w jakich kategoriach czas zacząć oszczędzać. Umożliwią Ci to przygotowane zestawienia w dostepnej, wizualnej formie. Używaj jak lubisz - na <i class="icon-laptop"></i> komputerze <i class="icon-mobile"></i>telefonie <i class="icon-tablet"></i>tablecie.</p>
						
						</div>
						
						<div class="text3 my-2">
							<p>Sprawdź i przekonaj się sam!</p>
						</div>
						
					</div>
				
					<div class ="col-sm-12 col-md-10 offset-md-1 offset-lg-0 col-lg-6 mt-1 mb-4">
						<div class="col-md-12 tile1a py-2">
							<a href="index.php" class="back"><i class="icon-left-big"></i></a>
							<span class="fontello mr-3"><i class="icon-user-add"></i></span>
							<p>Rejestracja</p>
								
							<form class="form-inline main0" action="rejestracjaPHP.php" method="post">

								<label class="col-4 textright" for="name">Imię</label>
								<input class="col-6 form-control input" id="name" name="name" type="text" value="<?php 
									if (isset($_SESSION['fr_name'])){
										echo $_SESSION['fr_name'];
										unset($_SESSION['fr_name']);}
									?>" required/>

								<?php
									if (isset($_SESSION['e_name'])){
									echo '<div class="offset-sm-4 offset-2" style="font-size:16px; color:#ececec;">'.$_SESSION['e_name'].'</div>';
									unset($_SESSION['e_name']);}
								?>

								<div class="w-100"></div>
								
								<label class="col-4 mt-3 textright" for="email">E-mail</label>
								<input class="col-6 form-control mt-3 input" id="email" name="email" type="email" value="<?php 
									if (isset($_SESSION['fr_email'])){
										echo $_SESSION['fr_email'];
										unset($_SESSION['fr_email']);}
									?>" required/>
								
								<?php
									if (isset($_SESSION['e_email'])){
									echo '<div class="offset-sm-4 offset-2" style="font-size:16px; color:#ececec;">'.$_SESSION['e_email'].'</div>';
									unset($_SESSION['e_email']);}
								?>
								
								<div class="w-100"></div>
								
								<label class="col-4 mt-3 textright" for="password">Hasło</label>
								<input class="col-6 form-control mt-3 input" id="password" name="password" type="password" value="<?php 
									if (isset($_SESSION['fr_password'])){
										echo $_SESSION['fr_password'];
										unset($_SESSION['fr_password']);}
									?>" required/>
								
								<?php
									if (isset($_SESSION['e_password'])){
									echo '<div class="offset-sm-4 offset-2" style="font-size:16px; color:#ececec;">'.$_SESSION['e_password'].'</div>';
									unset($_SESSION['e_password']);}
								?>
								
								<div class="w-100"></div>
														
								<div class="col-12 mt-3 my-2"><input class=" button" name="registration" type="submit" value="Zarejestruj się"/></div>
									
							</form>	
						</div>
					</div>
					
					<div class ="col-sm-12 col-md-10 offset-md-1 offset-lg-0 col-lg-6 ml-lg-auto mt-1 mb-5">
						<a href="logowanie.php">
							<div class="col-md-12 tile1a py-2">
								<span class="fontello mr-3"><i class="icon-key"></i></span>
								<p>Logowanie</p>							
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




	