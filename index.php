<?php
$buy = [34.3,35.41,35.81,35.90,35.96,35.89,34.65,34.55];
$sell = [34.49,35.68,36.07,35.98,35.99,34.88];
$sumBuy=$sumSell=0;
foreach ($buy as $k => $v) {
  $sumBuy+=$v;
}
$resB = $sumBuy/count($buy);
echo '东亚：';
echo "<br />";
echo $resB;
echo "<br />";
foreach ($sell as $k => $v) {
  $sumSell+=$v;
}
$resS = $sumSell/count($sell);
echo $resS;

echo "<br />";
$buy = [13.02,12.85,12.97,12.77,12.50,12.63,12.46,12.54,12.49,12.44,12.26,11.85,11.65,11.88,11.83,11.78,10.40];
$sell = [12.50,12.93,12.96,12.72,12.57,12.57,12.47,11.88,11.40,11.84,11.88];
$sumBuy=$sumSell=0;
foreach ($buy as $k => $v) {
  $sumBuy+=$v;
}
$resB = $sumBuy/count($buy);
echo '通达：';
echo "<br />";
echo $resB;
echo "<br />";
foreach ($sell as $k => $v) {
  $sumSell+=$v;
}
$resS = $sumSell/count($sell);
echo $resS;
?>