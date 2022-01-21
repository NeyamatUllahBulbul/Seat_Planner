<?php
session_start();
if ($_POST){
    $name       = $_POST['name'];
    $credit    = $_POST['credit'];
   
    if($name == ''){
        $_SESSION['error']= 'Please insert your subject name<br>';
        header('location:create_subject.php');
        exit;
    }
    if($credit == ''){
        $_SESSION['error']= 'Please insert your subject credit<br>';
        header('location:create_subject.php');
        exit;
    }
    
    include_once 'database_connection.php';
    $conn = connect();

    $sql = "SELECT * FROM subjects WHERE name = '$name'";
    $output= $conn->query($sql);
    
    if ($output->num_rows > 0){
        $_SESSION['error']= 'Subject name already exists';
        header('location:create_subject.php');
        exit;
    } else {
        $sql="INSERT INTO subjects (name,credit)
				VALUES ('$name','$credit')";
        $conn->query($sql);
        $_SESSION['success']= 'Subject created successfully';
        header('location:create_subject.php');
    }

}
?>