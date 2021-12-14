<?php
$font="Pacifico.ttf";
$font2="Aller_Bd.ttf";
$image=imagecreatefromjpeg("Certificate.jpg");
$color=imagecolorallocate($image,19,21,22);
$name="Abidur Rahman Nabil";
$name_len=strlen($name);
imagettftext($image,30,0,1000-($name_len*10),800,$color,$font,$name);
$course="C# course";
$course_len=strlen($course);
imagettftext($image,30,0,1000-($course_len*10),1050,$color,$font,$course);
$date=date("jS \of F Y");
imagettftext($image,23,0,1355,1190,$color,$font2,$date);
imagejpeg($image,"Certificate/".$name.".jpg");
imagedestroy($image);
echo "done";
?>