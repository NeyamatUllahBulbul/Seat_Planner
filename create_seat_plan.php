<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location:admin.php');
    exit;
}

if ($_POST) {
    $first_batch_id = $_POST['first_batch'];
    $second_batch_id = $_POST['second_batch'];
    $semester_id = $_POST['semester'];

    if ($semester_id == '') {
        $_SESSION['error'] = 'Select Semester first<br>';
        header('location:create_seat_plan_pre.php');
        exit;
    }
    if ($first_batch_id == '') {
        $_SESSION['error'] = 'Select First batch<br>';
        header('location:create_seat_plan_pre.php');
        exit;
    }
    if ($second_batch_id == '') {
        $_SESSION['error'] = 'Select Second batch<br>';
        header('location:create_seat_plan_pre.php');
        exit;
    } elseif ($first_batch_id == $second_batch_id) {
        $_SESSION['error'] = 'Two batches cannot be the same<br>';
        header('location:create_seat_plan_pre.php');
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
                        <li class="active">Seat plan</li>
                        <li class="active">Make seat plan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="row">
            <?php include_once '_messages.php'?>
        </div>
        <?php
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM batches WHERE id='$first_batch_id'";
        $result = $conn->query($sql);
        $first_batch_name= $result->fetch_assoc();

        $sql = "SELECT * FROM batches WHERE id='$second_batch_id'";
        $output = $conn->query($sql);
        $second_batch_name= $output->fetch_assoc();

        $sql = "SELECT * FROM semesters WHERE id='$semester_id'";
        $semester = $conn->query($sql);
        $semester_name= $semester->fetch_assoc();

        $sql5 = "SELECT * FROM subjects";
        $all_subjects= $conn->query($sql5);

        $sql = "SELECT * FROM assigned_batch_subjects WHERE batch_id = '$first_batch_id' AND semister_id='$semester_id'";
        $first_bs = $conn->query($sql);
        $first_subjects = $first_bs->fetch_assoc();
        $first_batch_subjects = [];
        foreach ($first_bs as $fbs) {
            array_push($first_batch_subjects, $fbs['subjects_id']);
        }

        $sql = "SELECT * FROM assigned_batch_subjects WHERE batch_id = '$second_batch_id' AND semister_id='$semester_id'";
        $second_bs = $conn->query($sql);
        $second_subjects = $second_bs->fetch_assoc();
        $second_batch_subjects = [];
        foreach ($second_bs as $sbs) {
            array_push($second_batch_subjects, $sbs['subjects_id']);
        }
        ?>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">Seat planning form</div>
                    <div class="card-body card-block">
                        <form action="create_seat_plan_action.php" method="POST" class="">
                            <div class="row">
                                <div class="col-6">
                                    <p style="color: black">Candidate Information</p>
                                    <input type="hidden" name="first_batch" value="<?= $first_batch_id ?>">
                                    <input type="hidden" name="second_batch" value="<?= $second_batch_id ?>">
                                    <input type="hidden" name="semester" value="<?= $semester_name['name'] ?>">
                                    <div class="form-group">
                                        <label class=""><b>First batch</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <input type="text" value="<?= $semester_name['name'] ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>First batch</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <input type="text" value="<?= $first_batch_name['name'] ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>First batch subject</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                            <select name="first_subject" id="select" class="form-control">
                                                <option value="">Select subject</option>
                                                <?php
                                                foreach ($all_subjects as $subject){
                                                    if (in_array($subject['id'], $first_batch_subjects)) {
                                                    ?>
                                                    <option value="<?= $subject['name']?>"><?= $subject['name']?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=""><b>Second batch</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <input type="text" value="<?= $second_batch_name['name'] ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Second batch subject</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                            <select name="second_subject" id="select" class="form-control">
                                                <option value="">Select subject</option>
                                                <?php
                                                foreach ($all_subjects as $subject){
                                                    if (in_array($subject['id'], $second_batch_subjects)) {
                                                        ?>
                                                        <option value="<?= $subject['name']?>"><?= $subject['name']?></option>
                                                    <?php } } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator" id="separator" style="height: 78%;width: 1px;background: black;top: 68px;bottom: 0;position: absolute;left: 50%;"></div>
                                <div class="col-6">
                                    <p style="color: black">Exam Information</p>
                                    <div class="form-group">
                                        <label class=""><b>Name of the Examination</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                            <input type="text" id="username" name="exam_name" placeholder="Examination name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Examination date</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="date" id="username" name="date" placeholder="Examination date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Examination time</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                            <input type="time" id="username" name="time" placeholder="Examination name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Room number</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <input type="text" id="username" name="room_no" placeholder="Room number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Number of seats</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></div>
                                            <input type="number" id="username" name="seats" placeholder="Number of seats" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Number of columns</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-columns"></i></div>
                                            <input type="number" id="username" name="columns" placeholder="Number of columns" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>

        <!--/.col-->


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<?php include_once 'template/footer.php'?>


