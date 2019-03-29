<?php ob_start(); session_start();
 date_default_timezone_set("America/Los_Angeles");
  if(isset($_POST)) {
  
  //echo $output = $_POST['output'];  die;
  
  
  /** text format **/
   $signName = $_POST['signname'];
   $name = $signName."_signature";//$_SESSION['id'];//$_POST['name']; 
   $sign = $_POST['inputtext'];
  //$signaturestyle = $_POST['font'];   
   $val = $_POST['font'];
   
 
 //$fontstyle = 'Yippy.ttf';//$_POST['font'].$ext;
 //echo $fontstyle1 = "'".$fontstyle."'"; 
  }

header('Content-type: image/png');

//$img = imagecreatetruecolor(350, 40);

//$bgColour = imagecolorallocate($img, 0xff, 0xff, 0xff);
//$penColour = imagecolorallocate($img, 0, 0, 0);
//imagefilledrectangle($img, 0, 0, 349, 39, $bgColour);

$text = $sign;//'Sir John A. Macdonald';
$font = $val.".ttf";
/*if ($val ==1) 
$font = 'journal.ttf';
else if($val==2)
$font = 'Smile.ttf';
else 
$font = 'Yippy.ttf';
*/
$datSave = '../Signature/'.$name.'_date.png';
exec('convert -background white -fill black -pointsize 12 label:"'.date('Y-m-d').'\n'.date('H:i:s').'" ../Signature/'.$name.'_date.png');


//imagettftext($img, 20, 0, 10, 20, $penColour, $font, $text);


$save = "../Signature/". $name ."_sign.png";

if(!isset($_GET['size'])) $_GET['size'] = 20;
    if(!isset($_GET['text'])) $_GET['text'] = $text;

    $size = imagettfbbox($_GET['size'], 0, $font, $_GET['text']);
	
	$xsize = abs($size[0]) + abs($size[2]);
    $ysize = abs($size[5]) + abs($size[1]);

    $image = imagecreate($xsize, 40);
    $blue = imagecolorallocate($image, 0xff, 0xff, 0xff);
    $white = imagecolorallocate($image, 0,0,0);
    imagettftext($image, $_GET['size'], 0, abs($size[0]), abs($size[5]), $white, $font, $_GET['text']);

    header("content-type: image/png");
    imagepng($image,$save);
    imagedestroy($image);




echo "success";//.$font;//.$name;
//echo $sign;

//imagepng($img,$save);
//imagedestroy($img);

exec("convert $save $datSave +append ../Signature/$name.png");


?>
