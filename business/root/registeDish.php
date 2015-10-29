<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/16
 * Time: 22:07
 */
// 商家登记菜品信息
// 1、如果商家注册菜品数量超过50，暂停该商家id的注册，短信提醒管理员，最多注册100个菜品
// ../这个是返回上一级
require_once('../../tools/db.php');
require_once('../../tools/response.php');

$img = base64_decode($_POST['picStr']);                         // 图片的内容
$picName = $_POST[ 'businessID'].'_'.time().'.jpg';           // 图片的名字


// 1、将图片的url，对应的商户id，保存到数据库中
$businessID = $_POST['businessID'];                            // 商户id
$categoryID = $_POST['categoryID'];                            // 菜品分类id
$picUrl = 'http://192.168.199.104:8090/images/'.$picName;   // 图片的下载url
$dishName = $_POST['dishName'];                                // 菜品名字
$price = $_POST['price'];                                      // 菜品价格

$connect = db::getInstance()->connect();
$sql = "SELECT * FROM dish WHERE businessID = ".$businessID." AND categoryID = ".$categoryID." AND dishName = "."'".$dishName."'";
$result = mysqli_query($sql, $connect);

if( mysqli_num_rows($result) > 0 )
{
    echo response::show(206, '该菜品已经被登记');
}
else
{
    $sql = "INSERT INTO `test`.`dish` (`businessID`, `categoryID`, `picUrl`, `dishName`, `price`) VALUES (".$businessID.",".$categoryID.","."'".$picUrl."'".","."'".$dishName."'".",".$price.")";
    if ( mysqli_query($sql, $connect) )
    {
        echo response::show(200, '菜品登记注册成功');
    }
    else
    {
        echo response::show(203, '菜品登记失败'.$sql);
    }
}


