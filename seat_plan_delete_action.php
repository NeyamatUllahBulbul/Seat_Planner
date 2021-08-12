<?php
if (isset($_POST)){
    $sp_id = $_POST['sp_id'];
}
include_once 'database_connection.php';
$conn = connect();

$sql="DELETE FROM seat_plans WHERE id= '$sp_id' ";
$conn->query($sql);
$_SESSION['success']= 'Seat plan deleted successfully';
header('location:seat_plan_index.php');
?>
