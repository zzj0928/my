<?php
defined('__BASE_ROOT__') or define('__BASE_ROOT__',__DIR__);
//require_once  dirname(__DIR__) .'/lib/bootstrap.php';
require_once  __BASE_ROOT__ .'/lib/bootstrap.php';
defined('__BASE__') or define('__BASE__','App\\Html\\');
define('JWT_SECRET','blockchain');

use App\Exception\AppException;

$resp = [];
try {
    $path =parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    if ($path == null){
        throw new AppException('url not found',400);
    }
    $pices = explode('/',trim($path,'/'));
    $action = array_pop($pices);
    foreach ( $pices as $index=>$item){
        $pices[$index] = ucfirst($item);
    }
    $className = trim(__BASE__,'/') . implode('//',$pices);
    if (!class_exists($className)){
        throw new AppException('url not found',400);
    }
    $class = new \ReflectionClass($className);
    if (!$class->hasMethod($action)){
        throw new AppException('method not implements',400);
    }
    $method = $class->getMethod($action);
    if ($method->isPrivate() || $method->isProtected()){
        throw new AppException('method not allow',500);
    }
    $instance = $class->newInstance();
    $data = $method->invoke($instance);
    $resp = [ 'code' => 0, 'message' => '', 'data' => $data];
} catch (AppException $e) {
    $resp = [ 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
}catch (Exception $e){
    $resp = [ 'code' => $e->getCode() === 0 ? 1 : $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
}finally{
    if (isset($resp['data']['xml'])){
        header('Content-Type:application/xml;charset=utf-8;');
        echo $resp['data']['xml'];
    }else{
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($resp);
    }
}
die();


$redis = new Redis();

$redis->connect('127.0.0.1', 6379);

$count = $redis->exists('count') ? $redis->get('count') : 1;

echo $count;

$redis->set('count', ++$count);
