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
require '../src/Date/Month.php';
$month = new  Prog\Date\Month($_GET['month']?? null,$_GET['year']?? null);
$start = $month->getStartingDay();
if ($month->getStartingDay()->format('D') === 'Mon')
  $start = $start->format('N') === '1' ? $start : $month->getStartingDay(); 
else
  $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
?>


<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">


  <h1><?= $month->toString();?></h1>
  <div>
    
    <a href="./AcceuilPatient.php?month=<?= $month->previousMonth()->month;?>&year=<?= $month->previousMonth()->year;?>" class="btn btn-primary">&lt;</a>
    <a href="./AcceuilPatient.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year;?>" class="btn btn-primary">&gt;</a>
  </div>

</div>


<table class="calendar__table calendar__table--<?= $month->getWeeks();?>weeks">

  <?php for ($i = 0; $i < $month->getWeeks();$i++): ;?>

    <tr>

      <?php foreach($month->days as $k => $day):
        $date =(clone $start)->modify("+".($k +$i *7)."days")
        ?>
    <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth';?>">
      <?php if ($i ===0):?>
        <div class="calendar__weekday"><?= $day;?></div>
      <?php endif;?>
      <div class="calendar__day"><?= $date->format('d');?></div>
    </td>
  <?php endforeach;?>
      
    </tr>

  <?php endfor;?>
  

</table>


</body>
</html>