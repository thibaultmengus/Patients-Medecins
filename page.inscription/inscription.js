console.log("Ce programme JS vient d'être chargé");
$(document).ready(function() {	
	console.log("En attente d'évènements...");
	$('#inputConfirmPassword').keyup(function(event) {
		var password = $('#inputPassword').val();
		if(password.length < 8) {
			$('#inputConfirmPassword').attr('disabled', 'disabled');
		}
		else {
			$('#inputConfirmPassword').removeAttr('disabled');
			$('#inputConfirmPassword').attr('maxlength', password.length);
		}
	});
	$('#inputConfirmPassword').click(function(event) {
		var password = $('#inputPassword').val();
		if(password.length < 8) {
			$('#inputConfirmPassword').attr('disabled', 'disabled');
		}
		else {
			$('#inputConfirmPassword').removeAttr('disabled');
			$('#inputConfirmPassword').attr('maxlength', password.length);
		}
	});
	$('#inputPassword').keyup(function(event) {
		var password = $('#inputPassword').val();
		if(password.length < 8) {
			$('#inputConfirmPassword').attr('disabled', 'disabled');
		}
		else {
			$('#inputConfirmPassword').removeAttr('disabled');
		}
	});
	$('#inputPassword').click(function(event) {
		var password = $('#inputPassword').val();
		if(password.length < 8) {
			$('#inputConfirmPassword').attr('disabled', 'disabled');
		}
		else {
			$('#inputConfirmPassword').removeAttr('disabled');
		}
	});
	function validerMotDePasse(form) {
		var password = $('#inputPassword').val();
		var confirmPassword = $('#inputConfirmPassword').val();
		if(password === confirmPassword) {
			console.log("Les mots de passe sont égaux!");
			return true;
		}
		else {
			console.log("Les mots de passe ne sont pas égaux!");
			return false;
		}
	}
	
	$('#checkboxEstMedecin').click(function(event) {
		console.log("La case est medecin est sélectionnée!");
		$('#inputAdresse').attr('type', 'text');
		$('#inputVille').attr('type', 'text');
		$('#inputCodePostal').attr('type', 'text');
		$('#labelAdresse').text('Adresse');
		$('#labelVille').text('Ville');
		$('#labelCodePostal').text('Code Postal');
	});
	
	$('#checkboxEstPasMedecin').click(function(event) {
		console.log("La case n'est pas medecin est sélectionnée!");
		$('#inputAdresse').attr('type', 'hidden');
		$('#inputVille').attr('type', 'hidden');
		$('#inputCodePostal').attr('type', 'hidden');
		$('#labelAdresse').text('');
		$('#labelVille').text('');
		$('#labelCodePostal').text('');
	});
});

// RegEx("^[a-z]+[ \-']?[[a-z]+[ \-']?]*[a-z]+$", "gi");
