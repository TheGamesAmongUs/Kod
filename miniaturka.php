<?php


function miniaturka($fn, $m_mode)
{

$img = imagecreatefromjpeg($fn);

$width  = imagesx($img);
$height = imagesy($img);

$ratio1 = $height/$width;
$ratio2 = $width/$height; 

$dest = 150;


//echo $width;
//echo $height;


if($m_mode==1){ //Auto
if($width>$height){
//echo 'ratio1: '.$ratio1;
$Width_min = $dest;
$height_min = round($dest*$ratio1);


} else if($height>$width){
//echo 'ratio2: '.$ratio2;
$height_min = $dest;
$width_min = round($dest*$ratio2);
	}

} else if($m_mode==2){ //Zdefiniowanie szerokości
$Width_min = $dest;
$height_min = round(($dest/$width)*$height);
} else if($m_mode==3){// zdefiniowanie wysokości
$height_min = $dest;
$width_min = round(($dest/$height)*$width);
}


//echo 'szer: '.$width_min.' wys: '.$height_min;

$img_mini = imagecreatetruecolor($width_min, $height_min);
imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_min , $height_min, $width  , $height);


imagejpeg($img_mini, "".$fn."", 80); // utworzona miniaturka liczba (80) oznacza jakos obrazka od 0 do 100
imagedestroy($img);
imagedestroy($img_mini);

}

?>
