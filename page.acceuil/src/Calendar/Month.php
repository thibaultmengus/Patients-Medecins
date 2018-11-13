<?php

namespace Calendar;

class Month {

	public $days = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];

	private $months = ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'];
	public $month;
	public $year;
/**
 * @param int $month Le mois entre 1 et 12
 * @param int $year
 * @throws \Exception
 */
	function __construct(?int $month = null , ?int $year = null)
	{
			if($month === null || $month < 1 || $month > 12){
				$month = intval(date('m'));
			}
			if($year === null){
				$year = intval(date('Y'));
			}

			$month = ($month -1 ) %12 +1;

			$this->month =$month;
			$this->year = $year;
	}

	/**
	 * 
	 */

	public function toString() { 

		 return $this->months[$this->month-1].' '.$this->year;


	}

	/**
 	* renvois le premier jour du mois
 	*/
	public  function getStartingDay() {
		return new \DateTime ("{$this->year}-{$this->month}-01");
	}


	public function debug_to_console($data) {
		echo "<script>console.log('Debug Objects:" . $data . "');</script>";
	}

	public function getWeeks() {
			$start = $this->getStartingDay();
			$end = (clone $start)->modify('+1 month -1 day');
			$weeks = intval($end->format('W')) - intval($start->format('W'))+1;
			if($weeks < 0){
				$weeks = 53 - intval($start->format('W'))+1;
			}
			$this->debug_to_console($start->format('D'));
			return $weeks;
	}

/**
 * Est ce que le jour est dans le mois en cour
 */
	public function withinMonth(\DateTime $date){
		return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
	}

	/** Renvoie le mois suivant
	 * @return Month
	 */
	public function nextMonth(): Month{
		$month = $this->month + 1;
		$year=$this->year;
		if($month > 12){
			$month = 1;
			$year += 1;
		}

		return new Month($month,$year); 
	}

	/** Renvoie le mois précédent
	 * @return Month
	 */

	public function previousMonth(): Month{
		$month = $this->month - 1;
		$year=$this->year;
		if($month < 1){
			$month = 12;
			$year -= 1;
		}

		return new Month($month,$year); 
	}



}
?>