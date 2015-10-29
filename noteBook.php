<?php
/**
 * Created by PhpStorm.
 * User: wsk
 * Date: 15/10/29
 * Time: 下午12:59
 */

header("Content-Type: text/html; charset=utf-8");
header("Content-type: text/html; charset=gb2312");

$connect = db::getInstance()->connect();
$sql = "SELECT * FROM registBusinessMgr";
$result = $connect->query( $sql );
$result =  mysqli_query( $connect, $sql );
$result->fetch_row();
$num_rows = $result->num_rows;
$field_count = $result->field_count;


$sql = "SELECT `id` FROM `registBusinessMgr` WHERE `phone` = $mgrPhone AND `pwd` = $mgrPwd";        // 正确
$sql = "SELECT `id` FROM `registBusinessMgr` WHERE `phone` = {$mgrPhone} AND `pwd` = {$mgrPwd}";    // 正确
$sql = 'SELECT `id` FROM `registBusinessMgr` WHERE `phone` = {$mgrPhone} AND `pwd` = {$mgrPwd}';    // 错误


// 字符必须添加'',数字不必添加
$sql = "INSERT INTO `business` (`name`, `sortF`, `sortS`, `privileges`, `picUrl`, `description`, `longitude`, `latitude`, `businessSTime`, `businessETime`, `licensePicUrl`, `mobilePhone`, `serviceindex`)
VALUES ( '{$businessName}', {$sortF}, {$sortS}, '{$privileges}', '{$shopfrontPic}', '{$description}', {$lon}, {$lat}, {$startTime}, {$endTime}, '{$licencePic}', '{$phone}', {$serviceindex})";
$result =  mysqli_query( $connect, $sql );