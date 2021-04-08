<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<table border="1">
	<tr>
		<td>买入</td>
		<td>卖出</td>
		<td>收益</td>
	</tr>
	<tr>
		<td>
<?php
/**
 * 交易佣金：万八~千三，买卖双向收取，最低5元，不足5元收5元。（佣金方面需要您和自己的客户经理商量）
　*　印花税：单向收取，卖出成交金额的千分之一（0.1%）。（ 国家收取）
　*　过户费：买卖上海股票才收取，每1000股收取1元，低于1000股也收取1元。（ 国家收取）
　*　开户费：90元，沪A：40元，深A：50元（一般会免开户费用）
*/
$price_b = isset($_POST['price_b'])?$_POST['price_b']:19.56;//单价
$price_s = isset($_POST['price_s'])?$_POST['price_s']:19.56;//单价
$count_b = isset($_POST['count_b'])?$_POST['count_b']:1000;//购买数量
$count_s = isset($_POST['count_s'])?$_POST['count_s']:1000;//购买数量
if (empty($price_b) || empty($count_b) || empty($price_s) || empty($count_s)) {
	exit();
}
$ghf_l = 0.0;

$jyyj_b = 0.00025;//交易佣金买
$jyyj_s = 0.00025;//交易佣金卖

$yhs_b = 0;//印花税
$yhs_s = 0.001;//印花税
//买入股票所用金额：10元/股×10000股=100000元;
$buy = $price_b*$count_b;
echo '成本:'.$buy;
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
echo "</td><td>";

//买入股票所用金额：10元/股×10000股=100000元;
$sell = $price_s*$count_s;
echo '成本:'.$sell;
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
echo "</td><td>";
// $shouyi = $chengben-$shouru;
$shouyi = bcsub($shouru, $chengben,2);
echo "收益：" . $shouyi;
?>
		</td>
	</tr>
</table>

<form action="" method="post">
	<p>买入单价：<input type="text" name="price_b" value="<?php echo $price_b; ?>"></p>
	<p>卖出单价：<input type="text" name="price_s" value="<?php echo $price_s; ?>"></p>
	<p>买入数量：<input type="text" name="count_b" value="<?php echo $count_b; ?>"></p>
	<p>卖出数量：<input type="text" name="count_s" value="<?php echo $count_s; ?>"></p>
	<p><input type="submit" name="submit" value="计算"><p>
</form>


</body>
</html>