<?php
define('DS', DIRECTORY_SEPARATOR);
define('URL_DS', '/');
defined('__BASE_ROOT__') or define('__BASE_ROOT__',__DIR__.DS);
defined('__BASE__') or define('__BASE__',__BASE_ROOT__.'App'.DS.'Html'.DS);

require_once  __BASE_ROOT__ .'/lib/bootstrap.php';

use App\Exception\AppException;

$resp = [];
try {
    $path =parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    if ($path == null){
        throw new AppException('url not found',400);
    }
    // var_dump($path);
    $pices = explode(URL_DS,trim($path,URL_DS));
    $action = array_pop($pices);
    foreach ( $pices as $index=>$item){
        $pices[$index] = ucfirst($item);
    }
    //默认首页
    if (empty($pices)) {
        // $pices[$index] = ucfirst('index');
    }
    $className = __BASE__ . implode(DS,$pices);
    var_dump($className);
    var_dump(class_exists($className));exit();
    if (!class_exists($className)){
        throw new AppException('url not found',401);
    }
    $class = new \ReflectionClass($className);
    if (!$class->hasMethod($action)){
        throw new AppException('method not implements',402);
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
