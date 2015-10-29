<?php

/**
 * Created by PhpStorm.
 * User: wsk
 * Date: 15/10/29
 * Time: 下午2:52
 */

class storeUploadImage
{
    const cPicUrlHeader = 'http://192.168.199.104:8090/images/';                // 返回给客户端图片url的头部
    const cShopFrontPath = '/Users/wsk/pb_cs/www/uploadImages/shopfront/';      // 客户端上传的图片在服务器中存放的路径
    const cLicencePath = '/Users/wsk/pb_cs/www/uploadImages/licence/';          // 客户端上传的图片在服务器中存放的路径
    /**
     * @param $imageName
     * @param $imageData
     * @return mixed
     */
    static public function storeImage( $imageName, $imageData )
    {
        $fileLength = file_put_contents( $imageName, base64_decode( $imageData ) );
        if( $fileLength > 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    static public function storeShopFrontImage( $imageName, $imageData )
    {
        if ( $imageData == '' )
        {
            echo response::show(201, 'shopfrontPic不能为空');
        }
        $fullImageName = cShopFrontPath.$imageName;

        if( storeUploadImage::storeImage( $fullImageName, $imageData ) )
        {
            echo 'shopfrontPic图片保存成功';
            return cPicUrlHeader.$fullImageName;
        }
        else
        {
            echo response::show(201, 'shopfrontPic图片保存失败');
        }
    }

    static public function storeLicenceImage( $imageName, $imageData )
    {
        if ( $imageData == '' )
        {
            echo 'licencePic图片为空';
        }
        else
        {
            $fullImageName = cLicencePath.$imageName;
            if( self::storeImage( $fullImageName, $imageData ) )
            {
                echo 'licencePic图片保存成功';
                return cPicUrlHeader.$fullImageName;
            }
            else
            {
                echo response::show(201, 'licencePic图片保存失败');
            }
        }
    }
}