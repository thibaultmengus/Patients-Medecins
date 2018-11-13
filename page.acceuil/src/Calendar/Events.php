<?php

namespace Calendar;
include '../../fonctionsBdd.php';

class Events{


 
 /**
 * Récupère les events entre 2 dates
  * @param \DateTime $start
  * @param \DateTime $end
  * @return array
  */
	public function getEventsBetween(\DateTime $start, \DateTime $end) {

			$bdd = new \fonctionsBdd();

			$results = $bdd->consulteRendezVousPatient($start, $end);
			
			return $results;

	}
}


?>