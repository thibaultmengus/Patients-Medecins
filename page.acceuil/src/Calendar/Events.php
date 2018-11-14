<?php

namespace Calendar;
require_once '../../fonctionsBdd.php';

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


	/** Récupère les événements commencant entre 2 dates indexé par jour 
	 * @param \DateTime $start
	 * @param \DateTime $end
	 * @return array
	 */
	public function getEventsBetweenByDay(\DateTime $start,\DateTime $end){

		$events = $this->getEventsBetween($start,$end);
		$days = [];
		foreach($events as $event){
			$date = explode( ' ',$event['start'])[0];
			if(!isset($days[$date])){
					$days[$date] = [$event];

			} else {

				$days[$date][] = $event;
			}
			
		}
		return $days;
	}
}


?>