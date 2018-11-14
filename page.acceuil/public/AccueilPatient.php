
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet"  href="./CSS/calendar.css">
</head>

<body>

<nav class="navbar navbar-dark bg-primary mb-3">

  <a href="/AcceuilPatient.php" class="navbar-brand">Mes Rendez-Vous</a>
</nav>


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
var_dump($events);
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
          <?=strtok(' ')?> - <?= $event['adresse'];?>
         </div>
         <?php endif; ?>
      <?php endforeach;?>

      
    </td>
     <?php endforeach;?>
      
    </tr>

  <?php endfor;?>
  

</table>


</body>
</html>