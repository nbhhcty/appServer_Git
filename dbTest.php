<?php

header("Content-Type: text/html; charset=utf-8");

require_once('./tools/db.php');
require_once('./tools/response.php');

// php5.5以后mysql全部替换成mysqli或者使用下面两行的任一行
// error_reporting(E_ALL ^ E_DEPRECATED);
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);


/**
 * Created by PhpStorm.
 * User: new1
 * Date: 2015/9/13
 * Time: 16:46
 */
$connect = db::getInstance()->connect();
$sql = 'select * from account';
$result = mysqli_query($sql, $connect);
echo mysqli_num_rows($result).' 行 '.mysqli_num_fields($result).' 列 '."<br />"."<br />"."<br />";
echo '结果'.$result.'结果'."<br />";
$resList = array();
while ($row = mysqli_fetch_object($result))
{
    $model = array( 'phone'=> &$row->phone,  'pwd'=> &$row->pwd);
    $resList[] = $model;
//    echo $row->id.'手机号码：'. $row->phone. ' 密码：'.$row->password."<br />";
}
echo response::show(200, '成功', $resList);

