
<?php 
session_start();
require '../src/Calendar/Month.php';
require '../src/Calendar/Events.php';
$events = new Calendar\Events();
$month = new  Calendar\Month($_GET['month']?? null,$_GET['year']?? null);
$start = $month->getStartingDay();

if ($month->getStartingDay()->format('D') === 'Mon')
  $start = $start->format('N') === '1' ? $start : $month->getStartingDay(); 
else
  $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
$weeks = $month->getWeeks();
$end = (clone $start)->modify('+'. (6 + 7 * ($weeks +1)). ' days');
$events = $events->getEventsBetween($start,$end);
require '../views/header.php';
//var_dump($_SESSION);
//var_dump($events);
?>


<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">


  <h1><?= $month->toString();?></h1>
  <div>
    
    <a href="./AcceuilPatient.php?month=<?= $month->previousMonth()->month;?>&year=<?= $month->previousMonth()->year;?>" class="btn btn-primary">&lt;</a>
    <a href="./AcceuilPatient.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year;?>" class="btn btn-primary">&gt;</a>
  </div>

</div>


<table class="calendar__table calendar__table--<?= $weeks;?>weeks">

  <?php for ($i = 0; $i < $weeks;$i++): ;?>

    <tr>

      <?php foreach($month->days as $k => $day):
        $date =(clone $start)->modify("+".($k +$i *7)."days");
        ?> 
    <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth';?>">
      <?php if ($i ===0):?>
        <div class="calendar__weekday"><?= $day;?></div>
      <?php endif;?>
      <div class="calendar__day"><?= $date->format('d');?></div>




      <?php
      $dateStr = $date->format('Y-m-d');
      foreach ($events as $event):
        if (strtok($event['creneauHoraire'],' ') == $dateStr):
         ?>
         <div class="calendar__event">
          <?=strtok(' ')?> -  <a href="/event.php?id=<?= $event['id'];?>">M.  <?= $event['nom'];?><br><?= $event['adresse'];?> <?= $event['codePostal'];?>  </a>
         </div>
         <?php endif; ?>
      <?php endforeach;?>

      
    </td>
     <?php endforeach;?>
      
    </tr>

  <?php endfor;?>
  
 
</table>

<?php require '../views/footer.php';  ?>
