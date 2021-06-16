<?php

/**
* 删除指定的HTML标签及其中内容，暂时只支持单标签清理
*
* @param string $string -- 要处理的字符串
* @param string $tagname -- 要删除的标签名称
* @param boolean $clear -- 是否删除标签内容
* @return string -- 返回处理完的字符串
*/
function  replace_html_tag( $string ,  $tagname ,  $clear  = false){
     $re  =  $clear  ?  ''  :  '1' ;
     $sc  =  '/<'  .  $tagname  .  '(?:s[^>]*)?>([sS]*?)?</'  .  $tagname  .  '>/i' ;
     return  preg_replace( $sc ,  $re ,  $string );
}

$url = 'http://www.cnitpm.com/pm1/102159.html';

$content = file_get_contents($url);
// var_dump($content);exit();

//取出div標籤且id為PostContent的內容，並儲存至陣列match 
preg_match('/<div class=\"newcon\".*?>.*?<\/div>/ism',$content,$match);
$tmpStr = $match[0];
// var_dump($tmpStr);exit();

$tmpStr = strip_tags ($tmpStr, '<div><p><br>');
// var_dump($tmpStr);exit();

// $tmpStr = replace_html_tag($tmpStr, 'script', true);

$regexb="/<p class=\"MsoNormal\".*?<\/p>/ism";
$endContent = str_replace('<p class="MsoNormal" style="text-indent:2em;">
	点击查看：2021年上半年信息系统项目管理师真题汇总专题（综合、案例、论文） 
</p>', '', $tmpStr);

var_dump($endContent);

?>