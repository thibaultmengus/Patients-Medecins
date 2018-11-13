console.log("Ce programme JS vient d'être chargé");
$(document).ready(function() {
	// Lorsque l'utilisateur clique sur le champ Adresse mail,
	// si sa valeur est égale à 'Adresse mail' sa valeur devient vide
	$('#inputEmail').click(function(event) {
		var mail = $('#inputEmail').val();
		if(mail == 'Adresse mail') {
			$('#inputEmail').attr('value', '');
			$('#inputEmail').attr('type', 'email');
		}
	});
	// Même chose qu'en haut avec l'évenement déclencheur keyUp
	// (si l'utilisateur navigue avec tab et non avec le click de la souris)
	$('#inputEmail').keyup(function(event) {
		var mail = $('#inputEmail').val();
		if(mail == 'Adresse mail') {
			$('#inputEmail').attr('value', '');
			$('#inputEmail').attr('type', 'email');
		}
	});
	
	// Pareil que pour mail, et change type="text" en type="password"
	$('#inputPassword').click(function(event) {
		$('#inputPassword').attr('value', '');
		$('#inputPassword').attr('type', 'password');
	});
	// Pareil que pour mail, si l'utilisateur navigue avec tab
	$('#inputPassword').keyup(function(event) {
		$('#inputPassword').attr('value', '');
		$('#inputPassword').attr('type', 'password');
	});
});