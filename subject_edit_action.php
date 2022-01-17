<?php
session_start();
if ($_POST){
    $subject_id   = $_POST['subject_id'];
    $name       = $_POST['name'];
    $credit    = $_POST['credit'];
   

    if($name == ''){
        $_SESSION['error']= 'Subject name cannot be empty<br>';
        header('location:subject_edit.php?bid='.$subject_id);
        exit;
    }
    if($credit == ''){
        $_SESSION['error']= 'Credit cannot be empty<br>';
        header('location:subject_edit.php?bid='.$subject_id);
        exit;
    }
    
    include_once 'database_connection.php';
    $conn = connect();

    $sql = "SELECT * FROM subjects WHERE name = '$name'";
    $output= $conn->query($sql);

    $sql="UPDATE subjects SET name='$name', credit='$credit' WHERE id= '$subject_id' ";
    $conn->query($sql);
    $_SESSION['success']= 'Subject information updated successfully';
    header('location:subject_edit.php?bid='.$subject_id);
}
?>