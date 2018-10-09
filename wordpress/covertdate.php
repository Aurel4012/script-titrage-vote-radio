<?php
$date = new DateTime('2018-01-21 21:14:43.71');
echo 'test date:'.$date->format('Y/m/d H:i:s').'<br>';
$duration = (int)'223800'; 
$totalsecs = $duration / 1000;

$minutes = intval($totalsecs/60);
$secs = intval($totalsecs%60);


echo '<br/> conversion: '.$minutes.':'.$secs;
?>