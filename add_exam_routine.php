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
                    <h1>Subject management</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Subjects</li>
                        <li class="active">Add Subject</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <?php include_once '_messages.php'?>
        

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Subject Adding form</div>
                    <div class="card-body card-block">
                        <form action="routine_add_action.php" method="POST" class="">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <select name="batch_id" id="select" class="form-control">
                                        <option value="">Select batch</option>
                                        <?php foreach ($batches as $batch){ ?>
                                            <option value="<?= $batch['id']?>"><?= $batch['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                    <select name="semister_id" id="select" class="form-control">
                                        <option value="">Select Semister</option>
                                        <?php foreach ($batches as $batch){ ?>
                                            <option value="<?= $semister['id']?>"><?= $semister['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <input type="file" id="photo" name="photo" class="form-control">
                                </div>
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


