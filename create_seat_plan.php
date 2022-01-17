<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])){
    header('location:admin.php');
    exit;
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
        $sql = "SELECT * FROM batches WHERE status='Active'";
        $batches= $conn->query($sql);
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
                                    <div class="form-group">
                                        <label class=""><b>First batch</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <select name="first_batch" id="select" class="form-control">
                                                <option value="">Select batch</option>
                                                <?php foreach ($batches as $batch){ ?>
                                                    <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>First batch subject</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                            <input type="text" id="username" name="first_subject" placeholder="Subject name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=""><b>Second batch</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <select name="second_batch" id="select" class="form-control">
                                                <option value="">Select batch</option>
                                                <?php foreach ($batches as $batch){ ?>
                                                    <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Second batch subject</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-book"></i></div>
                                            <input type="text" id="username" name="second_subject" placeholder="Subject name" class="form-control">
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


