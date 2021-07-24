<?php
if (isset($_SESSION['success'])){
    ?>
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Success</span> <?= $_SESSION['success']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php
        unset($_SESSION['success']);
        }elseif (isset($_SESSION['error'])){
    ?>
    <div class="col-sm-12">
        <div class="alert  alert-warning alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-warning">Error</span> <?= $_SESSION['error']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php unset($_SESSION['error']);} ?>
