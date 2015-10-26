<?php
/*********************************************************************************************
 * MODx PLUGIN: Basic Manager
 * VERSION:     1.0
 * DESCRIPTION: File Manager
 * WRITTEN BY:  Kobezzza (kobezzza@mail.ru)
 * DATE:        29/09/2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *********************************************************************************************/

function trans($name){
	$trans = array('а'=>'a', 'б'=>'b', 'в'=>'v', 'г'=>'g', 'д'=>'d', 'е'=>'e',  'ё'=>'yo', 'ж'=>'j', 'з'=>'z', 'и'=>'i', 'й'=>'i', 'к'=>'k', 'л'=>'l',  'м'=>'m', 'н'=>'n', 'о'=>'o', 'п'=>'p', 'р'=>'r', 'с'=>'s', 'т'=>'t',  'у'=>'y', 'ф'=>'f', 'х'=>'h', 'ц'=>'c', 'ч'=>'ch',  'ш'=>'sh', 'щ'=>'sh', 'ы'=>'i', 'э'=>'e', 'ю'=>'u', 'я'=>'ya', 'А'=>'A', 'Б'=>'B', 'В'=>'V', 'Г'=>'G', 'Д'=>'D', 'Е'=>'E',  'Ё'=>'Yo', 'Ж'=>'J', 'З'=>'Z', 'И'=>'I', 'Й'=>'I', 'К'=>'K',  'Л'=>'L', 'М'=>'M', 'Н'=>'N', 'О'=>'O', 'П'=>'P',  'Р'=>'R', 'С'=>'S', 'Т'=>'T', 'У'=>'Y', 'Ф'=>'F',  'Х'=>'H', 'Ц'=>'C', 'Ч'=>'Ch', 'Ш'=>'Sh',  'Ы'=>'I', 'Э'=>'E', 'Ю'=>'U', 'Я'=>'Ya', 'ь'=>'`', 'Ь'=>'`', 'ъ'=>'`', 'Ъ'=>'`', '/'=>'', '%'=>'', ':'=>'', ';'=>'', '\/'=>'', '='=>'', '*'=>'', '^'=>'', '~'=>'', '`'=>'', '@'=>'', ','=>'', '#'=>'', '$'=>'', '|'=>'', ' '=>'_');
	return strtr($name, $trans);
}

function format($name, $check = 0, $extensions = 0){
	$name = explode('.', $name);
	$name = $name[count($name) - 1];
	
	if (!$check) return $name;
	
	if (!$extensions){
		global $config;
		$extensions = explode(',', $config['format']);
	}else $extensions = explode('.', $extensions);
	
	foreach ($extensions as $val){
		if (strcasecmp($name, $val) == 0) return 1;
	}
	
	return 0;
}

function remove_dir($directory){
	$dir = opendir($directory);
	try{
		while(($file = readdir($dir))){
			if (is_file("${directory}/${file}"))
				unlink("${directory}/${file}");
			else if (is_dir("${directory}/${file}") && ($file !== '.') && ($file !== '..'))
				remove_dir("${directory}/${file}");
		}
		
		closedir($dir);
		rmdir($directory);
		
		return 1;  
	}catch (Exception $e){ return 0; }
}

function resize_img($path, $name, $thumb, $config){
	ini_set('memory_limit', '64M');
	
	try{
		$frm = explode('.', $name);
		$frm = strtolower($frm[count($frm) - 1]);
		
		switch ($frm){
			case 'jpg' : $img = imagecreatefromjpeg("${path}${name}"); break;
			case 'jpeg' : $img = imagecreatefromjpeg("${path}${name}"); break;
			case 'png' : $img = imagecreatefrompng("${path}${name}"); break;
			case 'gif' : $img = imagecreatefromgif("${path}${name}"); break;
		}
		
		$rh = imagesy($img);	
		$rw = imagesx($img);
		
		$max_w = $config['systemThumb'] === 1 ? 64 : 128;
		$max_h = $config['systemThumb'] === 1 ? 67 : 128;
		
		if ($rw > $max_w || $rh > $max_h){
			if ($rw > $rh){ 
				$w = $max_w; 
				$h =  ceil ($w * $rh/$rw); 
				$new = imagecreatetruecolor($w, $h);
				imagefilledrectangle($new, 0, 0, $w, $h, imagecolorallocate($new, 255, 255, 255));
				imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $rw, $rh);
			}else{ 
				$h = $max_h; 
				$w = ceil ($h * $rw/$rh);
				$new = imagecreatetruecolor($w, $h);
				imagefilledrectangle($new, 0, 0, $w, $h, imagecolorallocate($new, 255, 255, 255));
				imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $rw, $rh);
			}
		}else $new = $img;
		
		$file = "${path}.thumb_${thumb}.jpg";
		
		if ($config['systemThumb'] === 1){
			$back = imagecreatefrompng("${config['filemanager_path']}manager/media/browser/mcpuk/images/EmptyFile.png"); 
			
			if ($w != $max_w){
				$new_w = 32 - $w / 2;
				imagecopy($back, $new, 32 + $new_w, 38, 0, 0, $w, $h);
			}
			else if ($h != $max_h){
				$new_h = 38 - $h / 2;
				imagecopy($back, $new, 32, 38 + $new_h, 0, 0, $w, $h);
			}
			else imagecopy($back, $new, 32, 38, 0, 0, $w, $h);
			
			if (file_exists($file)) unlink($file);
			imagejpeg($back, $file, 80);
		}else imagejpeg($new, $file, 80);
		
		if ($config['resizeThumb'] === 1){
			if ($rw > $config['widthThumb'] || $rh > $config['heightThumb']){
				if ($rw > $rh){ 
					$w = $config['widthThumb']; 
					$h =  ceil ($w * $rh/$rw);
				}else{ 
					$h = $config['heightThumb']; 
					$w = ceil ($h * $rw/$rh);
				}
				$new = imagecreatetruecolor($w, $h);
				imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $rw, $rh);
			}else if ($rw < $config['widthThumb'] && $rh < $config['heightThumb']) $new = 'none';
			else $new = $img;
			
			if ($new != 'none')
				switch ($frm){
					case 'jpg' : {
						$file = "${path}.thumb_user_${thumb}.jpg";
						if (file_exists($file)) unlink($file);
						imagejpeg($new, $file, 80);
					} break;
					case 'jpeg' : {
						$file = "${path}.thumb_user_${thumb}.jpg";
						if (file_exists($file)) unlink($file);
						imagejpeg($new, $file, 80);
					} break;
					case 'png' : {
						$file = "${path}.thumb_user_${thumb}.png";
						if (file_exists($file)) unlink($file);
						imagepng($new, $file);
					} break;
					case 'gif' : {
						$file = "${path}.thumb_user_${thumb}.gif";
						if (file_exists($file)) unlink($file);
						imagegif($new, $file);
					} break;
				}
			}
		
		if ($config['resizeImg'] === 1){
			if ($rw > $config['widthImg'] || $rh > $config['heightImg']){
				if ($rw > $rh){ 
					$w = $config['widthImg']; 
					$h =  ceil ($w * $rh/$rw);
				}else{ 
					$h = $config['heightImg']; 
					$w = ceil ($h * $rw/$rh);
				}
				$new = imagecreatetruecolor($w, $h);
				imagecopyresampled($new, $img, 0, 0, 0, 0, $w, $h, $rw, $rh);
			}else $new = $img;
			
			$file = "${path}${name}";
			if (file_exists($file)) unlink($file);
			
			switch ($frm){
				case 'jpg' : {
					imagejpeg($new, $file, 80);
				} break;
				case 'jpeg' : {
					imagejpeg($new, $file, 80);
				} break;
				case 'png' : {
					imagepng($new, $file);
				} break;
				case 'gif' : {
					imagegif($new, $file);
				} break;
			}
		}
		
		imagedestroy($new);
		@imagedestroy($back);
		@imagedestroy($img);
		
		return 1;
	}catch (Exception $e){ return 0; }
}

?>