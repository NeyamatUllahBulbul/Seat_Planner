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
    $exam_name      = $_POST['exam_name'];
    $date           = $_POST['date'];
    $time           = $_POST['time'];
    $room_no        = $_POST['room_no'];
    $seat           = $_POST['seats'];
    $column         = $_POST['columns'];

    include_once 'database_connection.php';
    $conn = connect();

    $sql="INSERT INTO seat_plans (first_batch,first_subject,second_batch,second_subject,exam_name,date,time,room_no,seat,column_number)
				            VALUES ('$first_batch','$first_subject','$second_batch','$second_subject','$exam_name','$date','$time','$room_no','$seat','$column')";
    $conn->query($sql);

    if ($first_batch == '' || $first_subject == ''){
        $_SESSION['error']= 'First batch or subject name cannot be empty.<br>';
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
    if ($second_batch == '' || $second_subject == ''){
            $_SESSION['error']= 'Second batch and subject cannot be empty.<br>';
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

    if (isset($second_batch_number)){
        $total_student = $first_batch_number + $second_batch_number;
    }
    if ($total_student > $seat){
        $_SESSION['error']= 'Number of students cannot be greater than number of seats<br>';
        header('location:create_seat_plan.php');
        exit;
    }

    $sql = "SELECT name FROM batches WHERE id='$first_batch'";
    $first_batch_name= $conn->query($sql);

    $sql = "SELECT name FROM batches WHERE id='$second_batch'";
    $second_batch_name= $conn->query($sql);

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
                        <button class="btn btn-warning" value="print" onclick="printDiv('print')"><i class="fa fa-print"></i> Print </button>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <div class="content mt-3" >
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="print">
                    <div class="row mt-5">
                        <div class="col-lg-12 text-center">
                            <h2>Stamford University Bangladesh</h2>
                            <h5><?=$exam_name?></h5>
                            <h6>Examination date:<?=date('d/m/Y',strtotime($date))?></h6>
                            <h6>Examination time:<?=date('h:i A',strtotime($time))?></h6>
                            <h6>Room number:<?=$room_no?></h6>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-1"></div>
                        <div class="col-5 float-left">
                            <?php foreach ($first_batch_name as $first_name){ ?>
                                <h6>Batch name: <?=$first_name['name']?></h6>
                            <?php } ?>
                            <h6>Subject: <?=$first_subject?></h6>
                        </div>
                        <div class="col-5 text-right">
                            <?php foreach ($second_batch_name as $second_name){ ?>
                                <h6>Batch name: <?=$second_name['name']?></h6>
                            <?php } ?>
                            <h6>Subject: <?=$second_subject?></h6>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <div class="card-b text-center">
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

    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
        $(window).bind("load", function() {
            if(window.localStorage.getItem('print') == 'print'){
                window.localStorage.removeItem('print');
                setTimeout(function() {
                    printDiv('print');
                }, 2000);
            }
        });
    </script>