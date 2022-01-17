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
                    <h1>Student management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Students</li>
                        <li class="active">Student edit</li>
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
            if (isset($_GET['sid'])){
                $student_id = $_GET['sid'];
                include_once 'database_connection.php';
                $conn = connect();
                $sql = "SELECT * FROM students WHERE id='$student_id'";
                $result = $conn->query($sql);
                $student = $result->fetch_assoc();
                $sql = "SELECT * FROM batches";
                $batches= $conn->query($sql);
            }
        ?>

        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">Student edit form</div>
                    <div class="card-body card-block">
                        <form action="student_edit_action.php" method="POST" class="">
                            <div class="row">
                                <div class="col-6">
                                    <p style="color: black">Personal Information</p>
                                    <input type="hidden" value="<?= $student['id']?>" name="sid">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="username" name="name" value="<?= $student['name']?>" placeholder="Student name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="username" name="g_name" value="<?= $student['guardian_name']?>" placeholder="Guardian's name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" id="username" name="phone" value="<?= $student['phone']?>" placeholder="Contact number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=""><b>Date of Birth</b></label><br>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="date" id="username" name="dob" value="<?= $student['date_of_birth']?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="separator" id="separator" style="height: 78%;width: 1px;background: black;top: 68px;bottom: 0;position: absolute;left: 50%;"></div>
                                <div class="col-6">
                                    <p style="color: black">Academic Information</p>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="username" name="student_id" value="<?= $student['student_id']?>" placeholder="Student ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" id="username" name="student_email" value="<?= $student['student_email']?>" placeholder="Student academic email(e.g.12345@sub.ac)" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                            <select name="batch_id" id="select" class="form-control">
                                                <option value="">Select batch</option>
                                                <?php foreach ($batches as $batch){ ?>
                                                    <option <?php if($student['batch_id']==$batch['id']){echo 'selected';} ?> value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status"><b>Status</b></label>
                                        <br>
                                        <input type="radio" name="status"  <?php if($student['status']=='Active'){echo 'checked';} ?> value="Active" id="active">
                                        <label for="active">Active</label>
                                        <input type="radio" name="status" <?php if($student['status']=='Inactive'){echo 'checked';} ?> value="Inactive" id="inactive">
                                        <label for="inactive">Inactive</label>
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


