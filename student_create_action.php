<?php
session_start();
if ($_POST){
    $name           = $_POST['name'];
    $g_name         = $_POST['g_name'];
    $phone          = $_POST['phone'];
    $dob            = $_POST['dob'];
    $student_id     = $_POST['student_id'];
    $student_email  = $_POST['student_email'];
    $batch_id     = $_POST['batch_id'];
    $status         = $_POST['status'];
    if ($status == ''){
        $status = 'Active';
    }

    if($name == ''){
        $_SESSION['error']= 'Please insert your name<br>';
        header('location:student_create.php');
        exit;
    }
    if($g_name == ''){
        $_SESSION['error']= 'Please insert guardian name<br>';
        header('location:student_create.php');
        exit;
    }
    if($phone == ''){
        $_SESSION['error']= 'Please insert contact number<br>';
        header('location:student_create.php');
        exit;
    }
    if($dob == ''){
        $_SESSION['error']= 'Please insert date of birth<br>';
        header('location:student_create.php');
        exit;
    }
    if($student_id == ''){
        $_SESSION['error']= 'Please insert a student id<br>';
        header('location:student_create.php');
        exit;
    } elseif (strlen($student_id) != 11) {
        $_SESSION['error']= 'Student id cannot be more or less than 11 digits<br>';
        header('location:student_create.php');
        exit;
    }
    if($batch_id == ''){
        $_SESSION['error']= 'Please select a batch first<br>';
        header('location:student_create.php');
        exit;
    }

    include_once 'database_connection.php';
    $conn = connect();

    $sql = "SELECT * FROM students WHERE student_id = '$student_id' OR student_email = '$student_email'";
    $output= $conn->query($sql);

    if ($output->num_rows > 0){
        $_SESSION['error']= 'Student id or email already exists';
        header('location:student_create.php');
        exit;
    } else {
        $sql="INSERT INTO students (name,guardian_name,phone,date_of_birth,student_id,student_email,batch_id,status)
				            VALUES ('$name','$g_name','$phone','$dob','$student_id','$student_email','$batch_id','$status')";
        $conn->query($sql);
        $_SESSION['success']= 'Batch created successfully';
        header('location:student_create.php');
    }
}
?>



