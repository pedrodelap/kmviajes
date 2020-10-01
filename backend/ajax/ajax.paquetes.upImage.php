<?php

$output = "";
if (is_array($_FILES) && count($_FILES) > 0) {

    if (($_FILES["file"]["type"] == "image/pjpeg") ||
        ($_FILES["file"]["type"] == "image/jpeg")  ||
        ($_FILES["file"]["type"] == "image/png")   || 
        ($_FILES["file"]["type"] == "image/gif"))  {

            $nombre = rand(0, 100);

            $info = new SplFileInfo($_FILES['file']['name']);
            
            $extension = $info->getExtension();

            if (move_uploaded_file($_FILES["file"]["tmp_name"], "../vistas/images/paquetes/temporal/".$nombre.".".$extension)) {

                $images = glob("../vistas/images/paquetes/temporal/*.*");

                foreach($images as $image)
                {
                    $img = substr($image, 3);

                    $output .= '<img src="'.$img.'" width="100px" height="100px" style="margin-top:15px; padding:8px; border:1px solid #ccc;" />';
                }

                echo $output;

            } else {
                
                echo 0;

            }
        
    } else {

            echo 0;
    }

} else {

    echo 0;
    
}