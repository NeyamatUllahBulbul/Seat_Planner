<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])){
    header('location:admin.php');
    exit;
}
?>
<?php
if($_POST){
    $first_batch    = $_POST['first_batch'];
    $first_subject  = $_POST['first_subject'];
    $second_batch   = $_POST['second_batch'];
    $second_subject = $_POST['second_subject'];
    $room_no        = $_POST['room_no'];
    $seat          = $_POST['seats'];
    $column        = $_POST['columns'];

    include_once 'database_connection.php';
    $conn = connect();

    if ($first_batch == '' || $first_subject == ''){
        $_SESSION['error']= 'First batch or subject name cannot be empty<br>';
        header('location:create_seat_plan.php');
        exit;
    }else {
        $sql = "SELECT student_id FROM students WHERE batch_id='$first_batch' AND status='Active'";
        $first_batch_student= $conn->query($sql);
        $first_batch_students = [];
        foreach ($first_batch_student as $first){
            $first_batch_students[] = $first;
        }
        $first_batch_number = $first_batch_student->num_rows;
    }
    if ($second_batch != ''){
        if ($second_subject == ''){
            $_SESSION['error']= 'Second batch subject name cannot be empty<br>';
            header('location:create_seat_plan.php');
            exit;
        }else {
            $sql = "SELECT student_id FROM students WHERE batch_id='$second_batch' AND status='Active'";
            $second_batch_student= $conn->query($sql);
            $second_batch_students = [];
            foreach ($second_batch_student as $second){
                $second_batch_students[] = $second;
            }
            $second_batch_number = $second_batch_student->num_rows;
        }
    }
    if (isset($second_batch_number)){
        $total_student = $first_batch_number + $second_batch_number;
    }else {
        $total_student = $first_batch_number;
    }
    if ($total_student > $seat){
        $_SESSION['error']= 'Number of students cannot be greater than number of seats<br>';
        header('location:create_seat_plan.php');
        exit;
    }

}

?>
<?php include_once 'template/_head.php'?>

<body>


<!-- Left Panel -->
<?php include_once 'template/leftNav.php'?>
<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    <?php include_once 'template/header.php'?>
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Seat planning</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <button class="btn btn-warning" value="print" onclick="PrintDiv();">Print</button>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <div class="content mt-3" id="divToPrint">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All batches</strong>
                    </div>
                    <div class="card-body text-center">
                        <table id="bootstrap-data-table-export" class="table table-bordered" >
                            <thead>
                            <tr>
                            <?php for ($i=1;$i<=$column;$i++){ ?>

                                <th>Column <?= $i ?></th>

                            <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr >
                            <?php
                            $seat_per_column = $seat / $column;
                            $room = [];
                            $j = 0;
                            for ($i=1;$i<=$column;$i++){
                                echo '<td>';
                                if ($i%2 == 1) {
                                    $j++;
                                    foreach ($first_batch_students as $index=>$first_batch_student) {
                                        if ($index < ($seat_per_column*$j)) { ?>

                                                <p style="color: black!important;font-size: 25px;"><?=$first_batch_student['student_id']?></p>

                                <?php        unset($first_batch_students[$index]);
                                        }
                                    }
                                } else {
                                    foreach ($second_batch_students as $index=>$second_batch_student) {
                                        if ($index < $seat_per_column*$j) { ?>

                                                <p style="color: black!important;font-size: 25px;"><?=$second_batch_student['student_id']?></p>


                            <?php            unset($second_batch_students[$index]);
                                        }
                                    }
                                }
                            }

                            ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<?php include_once 'template/footer.php'?>

<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=300');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>