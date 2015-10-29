<?php

header("Content-Type: text/html; charset=utf-8");


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/16
 * Time: 20:09
 */

const cPicUrlHeader = 'http://192.168.199.104:8090/images/';    // 返回给客户端图片url的头部
const cPicStorePath = '/Users/wsk/pb_cs/www/uploadImages/';     // 客户端上传的图片在服务器中存放的路径

require_once('./tools/db.php');
require_once('./tools/response.php');

$img = base64_decode( $_REQUEST['picStr'] );
$picName = time().'.jpg';

// 1、将图片的url，对应的商户id，保存到数据库中
$picUrl = cPicUrlHeader.$picName;

$connect = db::getInstance()->connect();
$sql = 'SELECT pwd FROM `account` WHERE `phone` = '.$phone;
$result = mysqli_query( $sql, $connect );
$row = mysqli_fetch_object( $result );

// 2、将图片保存到指定路径下面
$picStorePath = cPicStorePath.$picName;
$fileLength = file_put_contents( $picStorePath, $img );    // 返回值为图片的长度
if( $fileLength > 0)
{
    echo response::show( 200, '上传图片成功');
}
else
{
    echo response::show( 201, '上传图片失败');
}

