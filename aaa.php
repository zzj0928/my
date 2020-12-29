<?php
$buy = [34.3,35.41,35.81,35.90,35.96,35.89];
$sell = [34.49,35.68,36.07,35.98,35.99];
$sumBuy=$sumSell=0;
foreach ($buy as $k => $v) {
  $sumBuy+=$v;
}
$resB = $sumBuy/count($buy);
echo $resB;
echo "<br />";
foreach ($sell as $k => $v) {
  $sumSell+=$v;
}
$resS = $sumSell/count($sell);
echo $resS;
?>