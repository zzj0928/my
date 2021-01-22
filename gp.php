<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<form action="" method="post">
	<p>单价：<input type="text" name="price"></p>
	<p>数量：<input type="text" name="count"></p>
	<p><input type="submit" name="submit" value="计算"><p>
</form>


<?php
/**
 * 交易佣金：万八~千三，买卖双向收取，最低5元，不足5元收5元。（佣金方面需要您和自己的客户经理商量）
　*　印花税：单向收取，卖出成交金额的千分之一（0.1%）。（ 国家收取）
　*　过户费：买卖上海股票才收取，每1000股收取1元，低于1000股也收取1元。（ 国家收取）
　*　开户费：90元，沪A：40元，深A：50元（一般会免开户费用）
*/
$price = isset($_POST['price'])?$_POST['price']:19.56;//单价
$count = isset($_POST['count'])?$_POST['count']:1000;//购买数量

$ghf_l = 0.0;

$jyyj_b = 0.00025;//交易佣金买
$jyyj_s = 0.00025;//交易佣金卖

$yhs_b = 0;//印花税
$yhs_s = 0.001;//印花税
echo "<p>买入</p>";
//买入股票所用金额：10元/股×10000股=100000元;
$buy = $price*$count;
echo '成本'.$buy;
echo "<br/>";
//过户费：0.002%×100000=0.2元;
$ghf = $ghf_l*$buy;
echo '过户费:'.$ghf;
echo "<br/>";
//交易佣金：100000×3‰=300元(按最高标准计算，正常情况下都小于这个值);
$jyyj = $jyyj_b*$buy;
$jyyj = $jyyj>5?$jyyj:5;
echo '交易佣金:'.$jyyj;
echo "<br/>";
//印花税：单向收取，卖出成交金额的千分之一（0.1%）。（ 国家收取）
$yhs = $yhs_b*$buy;
echo '印花税'.$yhs;
echo "<br/>";
//买入总成本：100000元+300元+2元=100302元(买入10000股，每股10元，所需总资金)
$chengben = $buy+$ghf+$jyyj+$yhs;
echo '总成本:'.$chengben;
echo "<br/><br/>";

echo "<p>卖出</p>";
//买入股票所用金额：10元/股×10000股=100000元;
$sell = $price*$count;
echo '成本'.$sell;
echo "<br/>";
//过户费：0.002%×100000=0.2元;
$ghf = $ghf_l*$sell;
echo '过户费:'.$ghf;
echo "<br/>";
//交易佣金：100000×3‰=300元(按最高标准计算，正常情况下都小于这个值);
$jyyj = $jyyj_s*$sell;
$jyyj = $jyyj>5?$jyyj:5;
echo '交易佣金:'.$jyyj;
echo "<br/>";
//印花税：单向收取，卖出成交金额的千分之一（0.1%）。（ 国家收取）
$yhs = $yhs_s*$sell;
echo '印花税'.$yhs;
echo "<br/>";
//买入总成本：100000元+300元+2元=100302元(买入10000股，每股10元，所需总资金)
$shouru = $sell-$ghf-$jyyj-$yhs;
echo '总收入:'.$shouru;
echo "<br/>";

echo "<p>买卖差</p>";
// $shouyi = $chengben-$shouru;
$shouyi = bcsub($chengben, $shouru,2);
echo "同价买卖差：" . $shouyi;
?>


</body>
</html>