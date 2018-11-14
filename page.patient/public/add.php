<?php 
session_start();
require '../src/Calendar/bootsrap.php';


render('header',['title' => 'Ajouter une Consultation']);

 ?>


 <div class="container">
 	
 	<h1>Ajouter une consultation</h1>
 	<form action="" method="post" class="form">
 		<div class="row">
 			
 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="Name">Medecin</label>
 					<input type="text"  required class="form-control" name="Name">

 					<?php 

 					$result = $bdd->getMedecins();

 					foreach($medecins as $medecin):
 						echo $medecin['nom'].' '.$medecin['prenom'];

 					 ?>
 					 
 				</div>
 			</div>

 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="Date">Date</label>
 					<input id="Date" type="date"   required class="form-control" name="Date">
 				</div>
 			</div> 

 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="Horaire">Créneau Horaire</label>
 					<input id="Horaire" type="time" required  class="form-control" name="Horaire" placeholder="HH:MM">
 				</div>
 			</div>
 		</div>

 		<div class="form-group">
 			

 		<button class=" btn btn-primary"> Ajouter la consultation</btn>
 		</div>


 	</form>
 </div>

 <?php render('footer'); ?>