<?php
session_start();
$dane=$_SESSION['wykres'];
$obrazki=array('1','2','3','4','5','6','7','8','9');
             $suma=array_sum($dane);
             $img=imagecreate(380,300);
             $kol[]=imagecolorallocate($img,204,102,0);
             $kol[]=imagecolorallocate($img,154, 137, 115);
             $kol[]=imagecolorallocate($img,242, 137, 115);
             $kol[]=imagecolorallocate($img,23, 137, 115);
             $kol[]=imagecolorallocate($img,23, 137, 0);
             $kol[]=imagecolorallocate($img,229, 239, 0);
             $kol[]=imagecolorallocate($img,100, 68, 0);
             $kol[]=imagecolorallocate($img,5, 182, 254);
             $kol[]=imagecolorallocate($img,164, 182, 254);
             $kol[]=imagecolorallocate($img,196, 92, 254);
             $bia=imagecolorallocate($img,255,255,255);
             $cza=imagecolorallocate($img,0,0,0);
             imagefill($img,0,0,$bia);
             for($i=0,$s=0;$i<count($dane);$i++)
             {
                 $k=(((100*$dane[$i])/$suma)*360)/100;
                imagefilledarc($img,130,150,256,256,$s+270,$s+$k+270,$kol[$i],IMG_ARC_PIE);
                imagefilledarc($img,130,150,256,256,$s+270,$s+$k+270,$kol[$i],IMG_ARC_EDGED+IMG_ARC_NOFILL);
                $s=$s+$k;
                imagefilledrectangle($img,270,10+($i*20),290,20+($i*20),$kol[$i]);
                imagerectangle($img,270,10+($i*20),290,20+($i*20),$cza);
                imagestring($img,3,300,7+($i*20),$obrazki[$i],$cza);
                imagestring($img,1,334,7+($i*20),round((100*$dane[$i])/$suma).'%',$cza);
                imagestring($img,1,334,14+($i*20),(($dane[$i])?$dane[$i]:'0'),$cza);
             }
             header('Content-type: image/png');
            imagepng($img);
            imagedestroy($img);
?>