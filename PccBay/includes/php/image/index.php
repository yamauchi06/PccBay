<?php
header('content-type: image/png');	
function convertImage($originalImage, $outputImage, $quality)
{
    $exploded = explode('.',$originalImage);
    $ext = $exploded[count($exploded) - 1]; 

    if (preg_match('/jpg|jpeg/i',$ext))
        $imageTmp=imagecreatefromjpeg($originalImage);
    else if (preg_match('/png/i',$ext))
        $imageTmp=imagecreatefrompng($originalImage);
    else if (preg_match('/gif/i',$ext))
        $imageTmp=imagecreatefromgif($originalImage);
    else if (preg_match('/bmp/i',$ext))
        $imageTmp=imagecreatefrombmp($originalImage);
    else
        return 0;
    imagejpeg($imageTmp, $outputImage, $quality);
    imagedestroy($imageTmp);
    print $outputImage;
}
convertImage("/home/content/53/10471353/html/sites/pccbay_test".$_GET['img'], null, 100);
?>