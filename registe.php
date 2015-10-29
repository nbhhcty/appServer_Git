<?php

header("Content-Type: text/html; charset=utf-8");

require_once('./tools/db.php');
require_once('./tools/response.php');

$phone = $_POST['phone'];               // 获取客户端传递过来的用户名
$pwd = $_POST['pwd'];                   // 获取客户端传递过来密码


if ( $pwd == '' )
{
    echo response::show(201, '密码不能为空');
}
else if ( $phone == '' )
{
    echo response::show(202, '手机号码不能为空');
}
else
{
    $connect = db::getInstance()->connect();
    $sql = 'SELECT * FROM `account` WHERE `phone` = '.$phone;
    $result = mysqli_query($sql, $connect);
    if( mysqli_num_rows($result) > 0 )
    {
        echo response::show(204, '该手机号已经被注册');
    }
    else
    {
        $sql = 'INSERT INTO `account`(`id`, `phone`, `pwd`) VALUES (NULL, '.$phone.','. $pwd.')';
        if (mysqli_query($sql, $connect))
        {
            echo response::show(200, '注册成功');
        }
        else
        {
            echo response::show(203, '注册失败');
        }
    }
}
?>