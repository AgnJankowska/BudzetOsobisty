<?php
session_start();
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
						<li class="nav-item mx-lg-1">
							<a href="menu.php" class="nav-link"><i class="icon-home"></i>Start</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="wydatek.php" class="nav-link"><i class="icon-credit-card"></i>Dodaj wydatek</a>
						</li>
						<li class="nav-item mx-lg-1">
							<a href="przychod.php" class="nav-link"><i class="icon-chart-line"></i>Dodaj przychód</a>
						</li>
						<li class="nav-item active mx-lg-1">
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
		<section class="balance">
			<div class ="container p-0 mb-5">
				<div class ="row m-0">			
					<div class ="col-lg-8 col-md-10 p-0 bg-light text-secondary mx-auto">
					
						<h1 class="head mx-auto p-3">
							<span class="fontello mr-3"><i class="icon-chart-pie"></i></span>Bilans
						</h1>
					
						<form class="form form-inline mt-4" action="bilansPHP.php" method="post" name="form" id="form">
							<div class="col-3 col-xl-3 mb-3 mr-4">
							<label class="textright" >Okres bilansu</label></div>
							
							<select class="form-control col-7 mb-3" name="range" id="range" onChange="setDates();">  
									
									<option value="1" <?php 
									if (isset($_SESSION['fr_range'])&& ($_SESSION['fr_range']==1)){
										echo "selected";}
										?>>bieżący miesiąc</option>
									
									<option value="2" <?php 
									if (isset($_SESSION['fr_range'])&& ($_SESSION['fr_range']==2)){
										echo "selected";}
										?>>poprzedni miesiąc</option>
										
									<option value="3" <?php 
									if (isset($_SESSION['fr_range'])&& ($_SESSION['fr_range']==3)){
										echo "selected";}
										?>>bieżący rok</option>
										
									<option value="4" <?php 
									if (isset($_SESSION['fr_range'])&& ($_SESSION['fr_range']==4)){
										echo "selected";} 
										?>>niestandardowy czas</option>
							</select>

							<div class="col-3 col-xl-3 mb-3 mr-4">
							<label class="textright" for="date_start">od</label></div>		
							<input class="form-control col-7 mb-3" name="date_start" id="date_start" type="date" required onChange="sendForm();"
								<?php 
									if (isset($_SESSION['fr_date_start'])){
										echo 'value="'.$_SESSION['fr_date_start'].'"';
										unset($_SESSION['fr_date_start']);}
								?>/>
					
							<div class="col-3 col-xl-3 mb-3 mr-4">
							<label class="textright" for="date_end">do</label></div>	
							<input class="form-control col-7 mb-3" name="date_end" id="date_end" type="date" required onChange="sendForm();"	
								<?php 									
									if (isset($_SESSION['fr_date_end'])){
										echo 'value="'.$_SESSION['fr_date_end'].'"';
										unset($_SESSION['fr_date_end']);
										unset($_SESSION['fr_range']);}
								?>/>
						</form>

						<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Wskaż okres bilansu</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <div class="modal-body">
								  
								<form action="bilansPHP.php" method="post" >
									<label class="mb-2" for="date_start">od</label>	
									<input class="form-control mb-3" name="date_start" id="date1" type="date" onChange="setDates();" required/>

									<label class="mb-2" for="date_end">do</label>	
									<input class="form-control mb-3" name="date_end" id="date2" type="date" onChange="setDates();" required/>
								  </div>
								  <div class="modal-footer">
									
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>								
									<input class="btn btn-primary" type="submit" name="wyslanie" value="Dodaj"/>
								</form>
								
								  </div>
								</div>
							  </div>
							</div>
						<?php
							if (isset($_SESSION['error'])){
							echo '<span style="color:red; font-size:18px;">'.$_SESSION['error'].'</span>';
							unset($_SESSION['error']);}
						?>
						
						<h2 class="head2 mx-auto mt-2 py-3">
							<span class="mr-3"><i class="icon-chart-line"></i></span>Przychody
						</h2>
						

						<div class="table-responsive col-lg-10 offset-lg-1">
							<table class="table table-bordered table-hover" id="incomeTable">
								<thead class="thead-light">
									<tr>       
										<th scope="col">   
											Kategoria
										</th>
										<th scope="col">
											Kwota
										</th>
									</tr>
								</thead>
								<tbody>						
								 <?php
									foreach ($_SESSION['incomes'] as $income) {
									echo '<tr><td>'.$income["name"].'</td><td>'.number_format($income["amountSum"],2, '.', ' ').'</td></tr>';
									}
								?>
								<tr class="table_sum"><td>Suma przychodów</td><td><?php echo number_format($_SESSION['sum_incomes'] ,2, '.', ' ')?></td></tr>
								</tbody>
							</table>
						</div>				
				
						<h2 class="head2 mx-auto mt-2 py-3">
							<span class="mr-3"><i class="icon-credit-card"></i></span>Wydatki
						</h2>
				
						<div class="table-responsive col-lg-10 offset-lg-1">
							<table class="table table-bordered table-hover" id="expenceTable">
								<thead class="thead-light">
									<tr>       
										<th scope="col">   
											Kategoria
										</th>
										<th scope="col">
											Kwota
										</th>
									</tr>
								</thead>
								<tbody>
								 <?php
									foreach ($_SESSION['expenses'] as $expense) {
									echo '<tr><td id="expense_name">'.$expense["name"].'</td><td id="expense_amount">'.number_format($expense["amountSum"],2, '.', ' ').'</td></tr>';
									}
								?>
								<tr class="table_sum"><td>Suma wydatków</td><td><?php echo number_format($_SESSION['sum_expenses'] ,2, '.', ' '); ?></td></tr>
								</tbody>
							</table>
						</div>
						
						<?php
						if (isset($_SESSION['expenses']) && count ($_SESSION['expenses']) > 0)
						echo '<div class="col-12 col-md-10 offset-md-1 col-xl-8 offset-xl-2" id="piechart"></div>';
						?>

						<h2 class="head2 mx-auto mt-2 py-3">
							<span class="mr-3"><i class="icon-balance-scale"></i></span>Bilans
						</h2>

						<div class=" <?=(($_SESSION['savings']<0)?'text4debet ':'text4 '); ?> mx-auto"> 
						<?php echo number_format($_SESSION['savings'] ,2, '.', ' '); ?></div>
						<div class="<?= (($_SESSION['savings']<0)?'text5debet ':'text5 '); ?> mx-auto pt-1 mb-3"><?= (($_SESSION['savings']<0)?'Uważaj, wpadasz w długi':'Gratulacje - świetnie zarządzasz finansami'); ?></div>
						
						<a href="menu.php" class="d-block button2 col-4 mx-auto my-4"><i class="icon-home"></i>Powrót</a>						
						
						</div>				
					</div>
				</div>
			<div id="extra"></div>
		</section>
	</main>
	
	
	<footer>
		<div id="information">2020 &copy; Created by: Agnieszka Jankowska</div>
	</footer>
	
	<script src="https://www.gstatic.com/charts/loader.js"></script> 
	<script src="script2.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
	integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
	crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>

	<?php
		if (!isset($_SESSION['showed'])){
		echo'<script type="text/javascript"> document.form.submit() </script>';}
	?>

	</body>
</html>	

 
		

			

