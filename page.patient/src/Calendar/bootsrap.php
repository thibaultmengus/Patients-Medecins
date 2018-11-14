<?php 


require_once '../../fonctionsBdd.php';



function get_pdo() {

		return new \fonctionsBdd();
	
}



function h(?string $value): string {

	if($value === null){

		return '';
	}


	return htmlentities($value);
}


function render(string $view,$parameters = []){


	extract($parameters);
	include "../views/{$view}.php";
}




 ?>