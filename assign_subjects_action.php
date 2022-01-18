<?php
session_start();
if ($_POST){
    $batch_id       = $_POST['batch_id'];
    $semister_id    = $_POST['semister_id'];
    $subjects_id    = $_POST['subjects'];
   

    if($batch_id == ''){
        $_SESSION['error']= 'Please select your batch name<br>';
        header('location:assign_subjects.php');
        exit;
    }
    if($semister_id == ''){
        $_SESSION['error']= 'Please select your semister name<br>';
        header('location:assign_subjects.php');
        exit;
    }
    if($subjects_id == ''){
        $_SESSION['error']= 'Please select your subjects name<br>';
        header('location:assign_subjects.php');
        exit;
    }

    
   
    include_once 'database_connection.php';
    $conn = connect();
    foreach($subjects_id as $subject_id){
    $sql="INSERT INTO assigned_batch_subjects (batch_id,semister_id,subjects_id)
            VALUES ('$batch_id','$semister_id','$subject_id')";
    $conn->query($sql);
    }
    $_SESSION['success']= 'Routine Added successfully';
    header('location:assign_subjects_index.php');
    

}
?>



<?php

?>