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
                    <h1>Batch management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Batches</li>
                        <li class="active">Batch edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <?php include_once '_messages.php'?>
        <?php

            include_once 'database_connection.php';
            $conn = connect();
            $sql = "SELECT * FROM departments";
            $departments= $conn->query($sql);
        ?>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Batch creation form</div>
                    <div class="card-body card-block">
                        <form action="batch_create_action.php" method="POST" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="name" placeholder="Batch name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-info-circle"></i></div>
                                    <input type="text" id="username" name="details" placeholder="Details" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building"></i></div>
                                    <select name="dept" id="select" class="form-control">
                                        <option value="">Select department</option>
                                        <?php foreach ($departments as $department){ ?>
                                            <option value="<?= $department['id']?>"><?= $department['name']?>(<?= $department['slug']?>)</option>
                                       <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" id="username" name="co" placeholder="Batch co-ordinator" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status"><b>Status</b></label>
                                <br>
                                <input type="radio" name="status"   value="Active" id="active">
                                <label for="active">Active</label>
                                <input type="radio" name="status" value="Inactive" id="inactive">
                                <label for="inactive">Inactive</label>
                            </div>
                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>

        <!--/.col-->


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<?php include_once 'template/footer.php'?>


