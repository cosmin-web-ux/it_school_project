<?php


echo "<pre>";
print_r($_POST);
print_r($_FILES);

if(!empty($_FILES['photo']['name'])) {
    
    $tmpPath = $_FILES['photo']['tmp_name'];
    $fileName = $_FILES['photo']['name'];
    
    $uploaded = move_uploaded_file($tmpPath, 'files/' . $fileName);
    
    if($uploaded) {
        $localImage = 'files/'.$fileName;
        
        $imPhp = imagecreatefromjpeg($localImage);
        $size = getimagesize($localImage);
        
        $width = $size[0];
        $height = $size[1];
        
        if($width > $height) {
            // landscape
        } else {
            //protret
        }
        
        $imPhp = imagescale($imPhp, 640);
        $newHeight = imagesy($imPhp);
        imagejpeg($imPhp, $directory.'resized/'.$fileName);        
        
        echo "fisier uploadat";
        echo "<img width='100' src='files/$fileName'>";
    } else {
        echo "eroare upload";
    }
    
}