<?php
$a = 35;
$c = 100;
$p = $a*$c;
echo $a;
echo "<br/>";
echo $c;
echo "<br/>";
$p = $a * $c;
echo $p;
echo "<br/>";
//1+1+2+4+8
for ($i=0; $i < 5; $i++) { 
	$c +=$c;
	$a -=1;
	$all = $p;
	echo $a;
	echo "<br/>";
	echo $c;
	echo "<br/>";
	$p = $a * $c;
	echo $p;
	echo "<br/>";
	$all += $p;
}

echo $all;
echo "<br/>";
?>