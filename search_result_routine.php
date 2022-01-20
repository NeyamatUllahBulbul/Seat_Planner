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
        if ($_GET['batch_id'] == ''){
            header('location:index.php');
            exit;
        }
        $batch_id = $_GET['batch_id'];
        include_once 'database_connection.php';
        $conn = connect();
        $sql = "SELECT * FROM batches";
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
        <h1><a href="index.php"><u>Examination Routine</a></h1>
        <h1><a href="seat_plans.php"><u>Seat Plans</a></h1>
    </div>
    <div class="col-4"></div>
</div>
<?php
$sql = "SELECT er.id,er.photo, batches.name as BName, semesters.name as SName
        FROM exam_routine er
        INNER JOIN batches ON er.batch_id=batches.id
        INNER JOIN semesters ON er.semister_id=semesters.id
        WHERE er.batch_id = '$batch_id'
        ";
$routines= $conn->query($sql);
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php foreach ($routines as $routine) { ?>
            <div class="card">
                <div class="card-header">
                    <h5 style="color: black;">Batch name: <?= $routine['BName'] ?></h5>
                    <p style="color: black;">Semester name: <?= $routine['SName'] ?></p>
                    <img style="width: 100%;" src="<?= $routine['photo'] ?>">
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-2"></div>
</div>
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
