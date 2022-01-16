<?php include_once 'template/_head.php'?>
<!-- CONTAINER -->
<body>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-4">
            <!-- LOGO -->
            <div class="logo pull-left">
                <a href="index.php" ><img src="images/stamford_logo.PNG" style="height: 93px; width: 532px;" alt="Stamford University Logo and Name"></a>
            </div><!-- //LOGO -->
        </div>
        <div class="col-2" style="margin-top: 22px;">
            <button style="background-color: #23B0ED;border: 1px solid #fff;border-radius:10px; height: 44px;width: 185px; color: white;" href="#"><b>Online Admission</b></button>
        </div>
        <div class="col-3">
            <div class="pull-left">
                <img src="images/suborno_50.png" id="sublogopic" alt="Stamford University Logo and Name" style="height: 80px;">
                <img src="images/mujib.png" id="sublogopic" alt="Stamford University Logo and Name" style="height: 80px;">
            </div>
        </div>
<?Php
    include_once 'database_connection.php';
    $conn = connect();
    $sql = "SELECT * FROM batches WHERE status='Active'";
    $batches= $conn->query($sql);
?>
    </div><!-- //CONTAINER -->
    <hr class="hline">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
                <form class="search" action="search_result.php" name="search" method="GET">
                    <select class="searchTerm" name="batch_id">
                        <option>Select Option</option>
                        <?php foreach ($batches as $batch){ ?>
                        <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
        </div>
        <div class="col-4"></div>
    </div>
    <div class="row text-center mt-4">
        <div class="col-4"></div>
        <div class="col-4">
            <h1><u>Seat Plans</h1>
        </div>
        <div class="col-4"></div>
    </div>
<?php
        $sql = "SELECT * FROM seat_plans";
        $result= $conn->query($sql);
    foreach ($result as $row){
        $first_batch    = $row['first_batch'];
        $first_subject  = $row['first_subject'];
        $second_batch   = $row['second_batch'];
        $second_subject = $row['second_subject'];
        $exam_name      = $row['exam_name'];
        $date           = $row['date'];
        $time           = $row['time'];
        $room_no        = $row['room_no'];
        $seat           = $row['seat'];
        $column         = $row['column_number'];

        $sql = "SELECT student_id FROM students WHERE batch_id='$first_batch' AND status='Active'";
        $first_batch_student= $conn->query($sql);
        $first_batch_students = [];
        foreach ($first_batch_student as $first){
            $first_batch_students[] = $first;
        }
        $first_batch_number = $first_batch_student->num_rows;

        $sql = "SELECT student_id FROM students WHERE batch_id='$second_batch' AND status='Active'";
        $second_batch_student= $conn->query($sql);
        $second_batch_students = [];
        foreach ($second_batch_student as $second){
            $second_batch_students[] = $second;
        }
        $second_batch_number = $second_batch_student->num_rows;

        $sql = "SELECT name FROM batches WHERE id='$first_batch'";
        $first_batch_name= $conn->query($sql);

        $sql = "SELECT name FROM batches WHERE id='$second_batch'";
        $second_batch_name= $conn->query($sql);
    ?>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
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
        <div class="col-md-3"></div>
    </div>
<?php } ?>
<?php include_once 'template/footer.php'?>

<style>
 body{
     background-color: white;
 }
 hr.hline{
     border: 8px solid midnightblue;
 }

 .search {
     width: 100%;
     position: relative;
     display: flex;
 }

 .searchTerm {
     width: 100%;
     border: 3px solid #00B4CC;
     border-right: none;
     padding: 5px;
     height: 36px;
     border-radius: 5px 0 0 5px;
     outline: none;
     color: #9DBFAF;
 }

 .searchTerm:focus{
     color: #00B4CC;
 }

 .searchButton {
     width: 40px;
     height: 36px;
     border: 1px solid #00B4CC;
     background: #00B4CC;
     text-align: center;
     color: #fff;
     border-radius: 0 5px 5px 0;
     cursor: pointer;
     font-size: 20px;
 }

 /*Resize the wrap to see the search bar change!*/
 .wrap{
     width: 30%;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
 }
</style>