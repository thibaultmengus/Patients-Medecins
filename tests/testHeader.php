<form method="GET" action="testHeader.php">
	<label><input type="radio" name="inscriptionMedecin" id="checkboxEstPasMedecin" value=8 checked></label>
	<label><input type="radio" name="inscriptionMedecin" id="checkboxEstMedecin" value=10 checked></label>
	<input type="submit" value="Go">
</form>

<?php 
if(isset($_GET)) {
    var_dump($_GET);
}
?>