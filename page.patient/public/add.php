<?php 
session_start();
require_once '../../fonctionsBdd.php';
require '../src/Calendar/bootsrap.php';

$bdd = new \fonctionsBdd();
render('header',['title' => 'Ajouter une Consultation']);

 ?>


 <div class="container">
 	
 	<h1>Ajouter une consultation</h1>
 	<form action="addRedirection.php" method="POST" class="form">
 		<div class="row">
 			
 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="Name">Medecin</label>
 					<br>
 					<select name="idMedecin"idMedecin">
 						
					<?php 

 					$result = $bdd->getMedecins();

 					foreach($result as $medecin):
 					?>
 						<option value=<?php echo $medecin['idMedecin'];?>> <?php echo $medecin['nom'].' '.$medecin['prenom'];?></option>
 					<?php endforeach;?>


 					</select>

 					
 					 
 				</div>
 			</div>

 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="date">Date</label>
 					<input id="date" type="date"   required class="form-control" name="Date">
 				</div>
 			</div> 

 			<div class="col-sm-6">
 				
 				<div class="form-group">
 					
 					<label for="horaire">Créneau Horaire</label>
 					<input id="horaire" type="time" required  class="form-control" name="Horaire" placeholder="HH:MM">
 				</div>
 			</div>
 		</div>

 		<div class="form-group">
 			

 		<button class=" btn btn-primary"> Ajouter la consultation</btn>
 		</div>


 	</form>
 </div>

 <?php render('footer'); ?>