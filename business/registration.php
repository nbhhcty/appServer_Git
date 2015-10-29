<?php
/**
 * Created by PhpStorm.
 * User: wsk
 * Date: 15/10/29
 * Time: 上午10:29
 */
require_once('../tools/db.php');
require_once('../tools/response.php');
require_once('../tools/storeUploadImage.php');

function authentication( $userName, $pwd, $businessId )
{
    if ( $pwd == '' )
    {
        echo response::show(201, '密码不能为空');
    }
    if ( $userName == '' )
    {
        echo response::show(201, '手机号码不能为空');
    }

    $connect = db::getInstance()->connect();
    $sql = "SELECT `id` FROM `registBusinessMgr` WHERE `phone` = {$userName} AND `pwd` = {$pwd}";
    $result =  mysqli_query( $connect, $sql );
    if( $result->num_rows <= 0 )
    {
        echo response::show(201, '账号或者密码错误');
    }

    if( $businessId == '' )
    {
        echo response::show(201, 'businessId不能为空');
    }
}

/**
 * @param $businessId
 * @param $shopfrontPic
 * @param $licencePic
 * @throws Exception
 */
function updateBusinessInfor( $businessId, $shopfrontPic, $licencePic )
{
    $businessName = $_REQUEST['$businessName'];
    $startTime = $_REQUEST['$startTime'];
    $endTime = $_REQUEST['$endTime'];
    $lon = $_REQUEST['$lon'];
    $lat = $_REQUEST['$lat'];
    $mobilePhone = $_REQUEST['$mobilePhone'];
    $sortF = $_REQUEST['$sortF'];
    $sortS = $_REQUEST['$sortS'];
    $privileges = $_REQUEST['$privileges'];
    $description = $_REQUEST['$description'];
    $serviceindex = $_REQUEST['$serviceindex'];
    $province = $_REQUEST['$province'];
    $city = $_REQUEST['$city'];
    $addresDetail = $_REQUEST['$addresDetail'];
    $fixTelephone = $_REQUEST['$fixTelephone'];

    // 字符必须添加'',数字不必添加
    $sqlUpdate =    "UPDATE
                          `business`
                    SET
                          `name` = '{$businessName}',
                          `sortF` = {$sortF},
                          `sortS` = {$sortS},
                          `privileges` = '{$privileges}',
                          `picUrl` = '{$shopfrontPic}',
                          `description` = '{$description}',
                          `businessSTime` = {$startTime},
                          `businessETime` = {$endTime},
                          `licensePicUrl` = '{$licencePic}',
                          `mobilePhone` = '{$mobilePhone}',
                          `serviceindex` = {$serviceindex},
                          `longitude` = {$lon},
                          `latitude` = {$lat},
                          `province` = {$province},
                          `city` = {$city},
                          `addresDetail` = '{$addresDetail}',
                          `fixTelephone` = '{$fixTelephone}'
                    WHERE
                          `business`.`id` = $businessId";

    $connect = db::getInstance()->connect();
    $result =  mysqli_query( $connect, $sqlUpdate );
    if( $result )
    {
        echo '更新基本数据成功';
    }
    else
    {
        echo response::show(201, '更新基本数据失败');
    }
}

$businessId = $_REQUEST['$businessId'];

// id+time+.jpg
$ImageName = $_REQUEST['$businessId'].time().'.jpg';

// 1.身份验证
authentication( $_REQUEST['mgrPhone'], $_REQUEST['mgrPwd'], $businessId );
// 2.保存门面照
$shopfrontPic = storeUploadImage::storeShopFrontImage( $ImageName, $_REQUEST['$shopfrontPic'] );
// 3.保存营业执照
$licencePic = storeUploadImage::storeLicenceImage( $ImageName, $_REQUEST['$licencePic'] );
// 4.更新基本数据
updateBusinessInfor( $businessId, $shopfrontPic, $licencePic );

