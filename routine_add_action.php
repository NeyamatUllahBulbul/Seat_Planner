<?php
session_start();
if ($_POST){
    $batch_id       = $_POST['batch_id'];
    $semister_id    = $_POST['semister_id'];

    if($batch_id == ''){
        $_SESSION['error']= 'Please select your batch name<br>';
        header('location:add_exam_routine.php');
        exit;
    }
    if($semister_id == ''){
        $_SESSION['error']= 'Please select your semister name<br>';
        header('location:add_exam_routine.php');
        exit;
    }

    // File Upload
    $image_save_folder = "images/routine/";
    $file_name = $image_save_folder . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    }

    // Check if file already exists
    if (file_exists($file_name)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $file_name)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
   
    include_once 'database_connection.php';
    $conn = connect();

    $sql="INSERT INTO exam_routine (batch_id,semister_id,photo)
            VALUES ('$batch_id','$semister_id','$file_name')";
    $conn->query($sql);
    $_SESSION['success']= 'Routine Added successfully';
    header('location:add_exam_routine.php');
    

}
?>



<?php

?>