<?php

class Setting
{
    const BASE_PATH = 'c:/www3/site1/db2/';
    const BASE_URL = 'http://site1.loc/db2/';
    const PUBLIC_DIR = '';
    const UPLOAD_DIR = 'img/foto';
}//end class

class ImgUpload
{
    /**
     *  Array of avalible extensions
     * @return array Extensions
     **/
    
    protected static $sizes = array(80);
    
    public static function getExts()
    {
        return array('.jpg','.jpeg','.png','.gif');
    }
    
    
     /**
     *  Get link to image
     * @return string Link to image or false if fail
     **/
    
    public static function getLinkToImg($post)
    {
        $baseUrl = Setting::BASE_URL;
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
         
        if (!isset($post['id'])) return false;
        $img = $post['foto'];
        if($img=='') return false;
        $filename = $basePath . $publicDir . '/' . $uploadDir . '/' . $img;
        if ( file_exists( $filename ) )
        {
            return $baseUrl . $uploadDir . '/' . $img;
        }
        return false;
    }//end func
    
    /**
     *  Get relative link to image
     * @return string Link to image or false if fail
     **/
     
    public static function getRelativeLinkToImg($post)
    {
        $baseUrl = Setting::BASE_URL;
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
         
        if (!isset($post['id'])) return false;
        $img = $post['foto'];
        if($img=='') return false;
        $filename = $basePath . $publicDir . '/' . $uploadDir . '/' . $img;
        if ( file_exists( $filename ) )
        {
            return '/' . $uploadDir . '/' . $img;
        }
        return false;
    }//end func
    
    /**
     *  Get relative link to Thunbnail
     * @return string Link to image or false if fail
     **/
    
    public static function getRelativeLinkToThumbnailImg($post,$size)
    {
        $baseUrl = Setting::BASE_URL;
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
         
        if (!isset($post['id'])) return false;
        $img = $post['foto'];
        if($img=='') return false;
        $thumbnail = $basePath . $publicDir . '/' . $uploadDir . '/'. 'thumbnail.' . $size . '.' . $img;
        if ( file_exists( $thumbnail ) )
        {
            return '/' . $uploadDir . '/' . 'thumbnail.' . $size . '.' . $img;
        }
        return false;
    }//end func
    
    /**
     *  Delete image file
     * @param string File name of image
     * @return bool false if fail
     **/
     
    public static function deleteImage($post)
    {
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
          
        if (!isset($post['id'])) return false;
        $img = $post['foto'];
        if($img=='') return false;
        $filename = $basePath . $publicDir . '/' . $uploadDir . '/' . $img;
        if ( file_exists( $filename ) ) unlink($filename);
        foreach( self::$sizes as $size )
        {
            $thumbfile = $basePath . $publicDir . '/' . $uploadDir . '/'. 'thumbnail.' . $size . '.' . $img;
            if ( file_exists( $thumbfile ) ) unlink($thumbfile);
        }
       
    }//end func
    
    /**
     *  Create upload directory if not exists
     * @return bool true if Ok or false if fail
     **/
    
    public static function prepareDir()
    {
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
        $dir1 = $basePath . $publicDir . '/' . $uploadDir;
        if( !file_exists( $dir1 ) || !is_dir( $dir1 ) ) 
            if ( ! mkdir($dir1)) return false;
        return true;
    }//end func
    
    /**
     *  Upload image file from POST request
     * @return bool false if fail
     **/
    
    public static function uploadImage($post)
    {
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
        $fieldName = 'img';
        foreach($_FILES as $key=>$val) $array = $_FILES[$key];
        foreach( $array as $key=>$value ) if ( is_array($value)) $array[$key] = $value[$fieldName]; 
        if ($array['error'] != 0 ) return false;
        $tmpFile = $array['tmp_name'];
        $name = $array['name'];
        if ( !$name ) return false;
        if ( !self::prepareDir()) return false;
        $ext = substr( $name, strrpos($name,'.'));
        if ( !in_array( strtolower($ext), self::getExts() ) ) return false;
        $filename = md5(time()) . $ext;
        $fullname = $basePath . $publicDir . '/' . $uploadDir . '/'  . '/' . $filename; 
        if ( move_uploaded_file( $tmpFile, $fullname ) ) $post['foto'] = $filename;
        foreach( self::$sizes as $size )
        {
            $thumbfile = $basePath . $publicDir . '/' . $uploadDir . '/'. 'thumbnail.' . $size . '.' . $filename;
            self::makeThumbnail($fullname, $thumbfile,$array['type'],$size, false);
        }
        return $filename;
    }//end func
    
    /**
     *  Make thumbnail for image
     * @param string $imgBig Filename big image
     * @param string $imgSmall Filename small image
     * @param string $type MIME-Type of image file
     * @param int $size Width of small image
     * @param bool $side Size is width or height
     * @return bool true if Ok or false if fail
     **/
    public static function makeThumbnail( $imgBig, $imgSmall, $type, $size, $side = true )
    {
        list($width, $height) = getimagesize($imgBig);
        $percent = ( $side )? $size / $width : $size / $height;
        $newwidth = $width * $percent;
        $newheight = $height * $percent;
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        if ( $type == 'image/jpeg' ){
            $source = imagecreatefromjpeg($imgBig);
        }
        elseif ( $type == 'image/gif' ){
            $source = imagecreatefromgif($imgBig);
        }
        elseif ( $type == 'image/png' ){
            $source = imagecreatefrompng($imgBig);
        }
        else return false;
        if ( imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height))
        {
            if ( $type == 'image/jpeg' ){
                imagejpeg($thumb,$imgSmall);
            }
            elseif ( $type == 'image/gif' ){
                imagegif($thumb,$imgSmall);
            }
            elseif ( $type == 'image/png' ){
                imagepng($thumb,$imgSmall);
            }
        }
    }//end func
    
    /**
     * Get Image size
     * @return array Array(width,height) if Ok or false if fail
     **/
    public static function getImageSize($post)
    {
        $basePath = Setting::BASE_PATH;
        $publicDir = Setting::PUBLIC_DIR;
        $uploadDir = Setting::UPLOAD_DIR;
        if (!isset($post['id'])) return false;
        $img = $post['img'];
        if($img=='')return false;
        $filename = $basePath . $publicDir . '/' . $uploadDir . '/' . $img;
        if ( file_exists( $filename ) ) return getimagesize( $filename );
        return false;
    }//end func
   
}//end class