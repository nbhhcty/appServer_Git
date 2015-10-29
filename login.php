<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/11
 * Time: 22:08
 */
//$a = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ?  $GLOBALS["HTTP_RAW_POST_DATA"]  : "" ;
//$a = $GLOBALS["HTTP_RAW_POST_DATA"];
// $phone = 'zhxxxxxang';
// $password = '11uuuu1';
//$json = json_decode($a,true);

//$json = file_get_contents('php://input');
//$json = json_decode($json);
//echo $json[0]->app_slug;

header("Content-Type: text/html; charset=utf-8");

require_once('./tools/db.php');
require_once('./tools/response.php');

$phone = $_REQUEST['phone'];               // 获取客户端传递过来的用户名
$pwd = $_REQUEST['pwd'];                   // 获取客户端传递过来密码

$connect = db::getInstance()->connect();
$sql = 'SELECT pwd FROM `account` WHERE `phone` = '.$phone;
$result = mysqli_query($sql, $connect);
$row = mysqli_fetch_object($result);

if( $row->pwd ==  $pwd )
{
    echo response::show(200, '登陆成功');
}
else
{
    echo response::show(205, '登陆失败');
}

?>
