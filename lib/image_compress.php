<?php
function my_image_resize($width, $height, $path, $inputName) //32x32
{
    //Оригінал висота і ширина
    list($w,$h)= getimagesize($_FILES[$inputName]['tmp_name']); //204x247
    $maxSize=0;
    //Обчислюємо максмильан знечення або ширина або висота
    if(($w>$h) and ($width>$height)) //204>247 and 32>32
        $maxSize=$width;
    else
        $maxSize=$height; //32
    //MaxSize=32
    $width=$maxSize; //32
    $height=$maxSize; //32
    $ration_orig=$w/$h; //204/247=0.82
    if(1>$ration_orig) //1>0.82 вірно
    {
        $width=ceil($height*$ration_orig); /*32*0.82=26.24 = 27 */     //34- all //10- records page  ceil(3.4)
    }
    else//Хибно
    {
        $height=ceil($width/$ration_orig);
    }
    //27x32

    //Створюємо новий файл
    $imgString=file_get_contents($_FILES[$inputName]['tmp_name']);
    $image=imagecreatefromstring($imgString);
    $tmp=imagecreatetruecolor($width,$height); //розмір нового зображення 27x32
    imagecopyresampled($tmp,$image,
        0,0,
        0,0,
        $width, $height,
        $w,$h
    );
    //Збереження зображення
    switch($_FILES[$inputName]['type'])
    {
        case 'image/jpeg':
            imagejpeg($tmp,$path,30);
            break;
        case 'image/png':
            imagepng($tmp,$path,0);
            break;
        case 'image/gif':
            imagegif($tmp,$path);
            break;
        default:
            exit;
            break;
    }
    return $path;
    //Очисчаємо память
    imagedestroy($image);
    imagedestroy($tmp);
}