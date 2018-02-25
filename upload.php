<?php

function image_upload(){

    $target_dir = "images/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // var_dump($target_file);


    // Check if image file is a actual image or fake image
    /*
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    */

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } 
    else {
        $uploadOk = 0;
    }

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }
    // Check file size
    if ($_FILES["image"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //     echo "Sorry, your file was not uploaded.";
    //     return NULL;
    //     // if everything is ok, try to upload file
    // } 
    else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            return $_FILES["image"]["name"];
        } else {
            // echo "Sorry, there was an error uploading your file.";
            return NULL;
        }
    }
}

?>