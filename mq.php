<?php
class mqClass
{
    static private $stomp;

    public  function __construct()
    {
        if(!self::$stomp){
            try {
                self::$stomp = new Stomp('tcp://localhost:61613', 'admin', 'admin');
            } catch(\StompException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
    }

    /**
     * 获取消息
     * @param string $queue_name 队列名称
     *
     * @return mixed|void
     */
    public function getMessage($queue_name='')
    {
        $stomp = self::$stomp;
        $queue_name = !empty($queue_name) ? $queue_name : 'queue_name';
        $stomp->subscribe($queue_name);
        if(!$stomp->hasFrame()){
            return;
        }
        return $stomp->readFrame();
    }

    /**
     * 发送消息
     * @param  string $message 消息内容，字符串类型
     * @param string $queue_name 队列名称
     *
     * @return bool
     */
    public function sendMessage($queue_name,$message)
    {
        $stomp = self::$stomp;
        $queue_name = !empty($queue_name) ? $queue_name : 'queue_name';
        $stomp->subscribe($queue_name);
        $stomp->send($queue_name,$message);
        return true;
    }


    /**
     * 消费消息
     * @param object $readFrame getMessage中返回的对象
     *
     * @return bool
     */
    public function ackMessage($readFrame)
    {
        $stomp = self::$stomp;
        $stomp->ack($readFrame);
        return true;
    }

}
$mqClass = new mqClass();
$result = $mqClass->sendMessage('email','bbb@163.com'); //队列存储
$result = $mqClass->getMessage('email'); //接收消息
// $mqClass->ackMessage($result);	//消费消息
var_dump($result);
?>