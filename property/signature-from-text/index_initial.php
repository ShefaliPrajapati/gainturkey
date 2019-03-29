<?php ob_start(); session_start();
 date_default_timezone_set("America/Los_Angeles");
  if(isset($_POST)) {
  
  /** text format **/
   $signName = $_POST['signname'];
   $name = $signName."_initial";
   $sign = $_POST['inputtext'];
   $val = $_POST['font'];
   
  }

header('Content-type: image/png');

$text = $sign;
$font = $val.".ttf";

$datSave = '../Signature/'.$name.'_date.png';
exec('convert -background white -fill black -pointsize 12 label:"'.date('Y-m-d').'\n'.date('H:i:s').'" ../Signature/'.$name.'_date.png');

$save = "../Signature/". $name ."_initial.png";

if(!isset($_GET['size'])) $_GET['size'] = 20;
    if(!isset($_GET['text'])) $_GET['text'] = $text;

    $size = imagettfbbox($_GET['size'], 0, $font, $_GET['text']);
	
	$xsize = abs($size[0]) + abs($size[2]);
    $ysize = abs($size[5]) + abs($size[1]);

    $image = imagecreate($xsize, 35);
    $blue = imagecolorallocate($image, 0xff, 0xff, 0xff);
    $white = imagecolorallocate($image, 0,0,0);
    imagettftext($image, $_GET['size'], 0, abs($size[0]), abs($size[5]), $white, $font, $_GET['text']);

    header("content-type: image/png");
    imagepng($image,$save);
    imagedestroy($image);

echo "success";
exec("convert $save $datSave +append ../Signature/$name.png");

?>
