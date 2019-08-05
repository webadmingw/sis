<?php

namespace common\components;

use Yii;
use FilesystemIterator;

/**
 * Description of helper
 *
 * @author DICS REDI
 */

class Utils {
    
    /**
     * Print Array - Debug
     * 
     * @param type $array
     * @param type $continue default FALSE
     */
    public static function printr($array, $continue = FALSE){
        echo '<pre style="color: #000; border: 4px dashed #ddd; padding: 20px; width: 95%; margin: 20px auto; background-color: #f0f0f0;">'.print_r($array,TRUE).'</pre>';
        if ($continue === FALSE) { die; exit;}
    }
    
    public static function generateFileName(){
        return Yii::$app->security->generateRandomString() . time();
    }
    
    public static function imgTsExist($path){
        $attr = array("file_ext" =>".jpg","file_total" => 0);
        try {
            $fi = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);
            if(isset($fi)){
                $attr = array(
                    "file_ext" => substr($fi->getFilename(), strpos($fi->getFilename(), ".")),
                    "file_total" => iterator_count($fi)
                );
            }
        } catch (\Exception $exc) {
            return $attr;
        }
        return $attr;
    }
    
    public static function getFirstError($errors){
        if(!empty($errors)){
            foreach ($errors as $key => $error){
                return $error;
            }
        }
        return [];
    }
    
}
