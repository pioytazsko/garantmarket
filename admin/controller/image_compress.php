<?php 
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
class Compressor {
 protected $filename; 
 protected $file_res;      
  
 function __construct($file){ 
      $this->filename=$file;
      $this->file_res=__ROOT__."/shopimagepreview/".$this->filename;
 
    
//         print $this->file_res;
     
     $filename11 = __ROOT__."/shopimage/".$file;  
     list($width, $height) = getimagesize($filename11);
     //gпроанализируем соотношения сторон и сожмем
     $dif=$width/$height;
     if($width>$height){
     $new_width=230;
     $new_height=$new_width/$dif;
     }else
     {
     $new_height = 170;
     $new_width=$new_width*$dif; 
     }
     $new_width = $new_height*$dif;
     $image_p = imagecreatetruecolor($new_width, $new_height);
     $col2=imagecolorallocate($image_p,255,255,255);
     imagefilledrectangle($image_p,0,0,$new_width,$new_width,$col2);
     //проверка на мимтипы
     if(exif_imagetype($filename11)==2)
     {
     $image = imagecreatefromjpeg($filename11);
     imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
     imagejpeg($image_p,$this->file_res,90);
     }elseif(exif_imagetype($filename11)==3)
     {
//     echo "ALARM!!! ETHO PNG!!!!".$filename11;
     $image = imagecreatefrompng($filename11);
     imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
     imagepng($image_p,$this->file_res,5);
     }
     
    }  
} 
//$com=new Compressor("water.png"); //пример  как выводить 
