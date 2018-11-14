<?php 

require '../src/Calendar/bootsrap.php';


render('header',['title' => 'Ajouter une Consultation']);

 ?>


 <div class="container">
 	
 	<h1>Ajouter une consultation</h1>
 	<form action="" method="post">
 		<div class="form-control">
 			
 			<label for="">Titre</label>
 			<input id="name" type="text" class="form-control" name="name">

 		</div>


 	</form>
 </div>

 <?php render('footer'); ?>