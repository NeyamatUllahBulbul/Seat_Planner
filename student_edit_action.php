<?php
session_start();
if ($_POST){
    $sid            = $_POST['sid'];
    $name           = $_POST['name'];
    $g_name         = $_POST['g_name'];
    $phone          = $_POST['phone'];
    $dob            = $_POST['dob'];
    $student_id     = $_POST['student_id'];
    $student_email  = $_POST['student_email'];
    $batch_id       = $_POST['batch_id'];
    $status         = $_POST['status'];
    if ($status == ''){
        $status = 'Active';
    }

    if($name == ''){
        $_SESSION['error']= 'Please insert your name<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }
    if($g_name == ''){
        $_SESSION['error']= 'Please insert guardian name<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }
    if($phone == ''){
        $_SESSION['error']= 'Please insert contact number<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }
    if($dob == ''){
        $_SESSION['error']= 'Please insert date of birth<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }
    if($student_id == ''){
        $_SESSION['error']= 'Please insert a student id<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    } elseif (strlen($student_id) != 6) {
        $_SESSION['error']= 'Student id cannot be more or less than 6 digits<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }
    if($batch_id == ''){
        $_SESSION['error']= 'Please select a batch first<br>';
        header('location:student_edit.php?sid='.$sid);
        exit;
    }

    include_once 'database_connection.php';
    $conn = connect();

    $sql="UPDATE students 
            SET name='$name', guardian_name='$g_name', phone='$phone', date_of_birth='$dob', student_id='$student_id', student_email='$student_email', batch_id='$batch_id', status='$status' 
            WHERE id= '$sid' ";
    $conn->query($sql);
    $_SESSION['success']= 'Student information updated successfully';
    header('location:student_edit.php?sid='.$sid);

}
?>



