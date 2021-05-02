<?php

    $connect = mysqli_connect("localhost", "root", "", "roadnet");
    session_start();

        if(!isset($_SESSION['contractor_login'])) {
            header("location: http://localhost/roadnet/login.php");
        }

        if(isset($_SESSION['parishmanager_login'])) {
            header("location: http://localhost/roadnet/parishmanager/parishmanager_home.php");
        }

        if(isset($_SESSION['admin_login'])) {
            header("location: http://localhost/roadnet/admin/admin_home.php");
        }

        if(isset($_SESSION['director_login'])) {
            header("location: http://localhost/roadnet/director/director_home.php");
        }

        if(isset($_SESSION['staff_login'])) {
            header("location: http://localhost/roadnet/staff/staff_home.php");
        }

        if(isset($_SESSION['contractor_login'])) {
            $ename = $_SESSION['contractor_login'];
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap Bundle -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        
        <title>Verify Report</title>
        
    </head>

    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-brand col-6 col-lg-2">
                <img src="http://localhost/roadnet/rimages/logo.png" class="img-fluid">
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/contractor_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/viewReport.php">View Report</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/contractor/verifyReport.php">Verify<span class="sr-only">(current)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/viewAnnouncement.php">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/sendMessage.php">Message</a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['contractor_login'].'</a>
                                </li>';
                            echo '
                                <li class="nav-item">
                                    <a  href="http://localhost/roadnet/logout.php" class="nav-link text-center text-danger">Logout</a>
                                </li>';
                        ?>
                    </ul>
                    
                </span>
            </div>
        </nav>

        <div class="container">

            <br>
            <h1>View Update on your Report</h1>

            <div class="container col-lg-5 mx-auto">
                <form class="main-form"  method="POST" action="">

                    <br>
                    <br>

                    <!-- First Name -->
                    <div class="">
                        <label class="">Enter Report Number</label>
                        <div class="">
                            <input type="text" class="form-control" id="repNum" name="repNum" placeholder="Enter report number ">
                        </div>

                        <div class="container mb-4 mt-5">
                            <div class="row">
                                <div class="col text-center">
                                    <input class="btn btn-success" type="submit" name="searchRep" id="searchRep" value="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <br>
                    
            <table id="report_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Report ID</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Telephone</td>
                        <td>Parish</td>
                        <td>Town</td>
                        <td>GPS Coordinates</td>
                        <td>Address</td>
                        <td>Direction</td>
                        <td>Incident Type</td>
                        <td>Description</td>
                        <td>Media</td>
                        <td>Verification Status</td>
                        <td>Report Date</td>
                    </tr>
                </thead>

                <?php
                
                    $connect = mysqli_connect("localhost", "root", "", "roadnet");
                    if (isset($_POST['searchRep'])) {
                        $reportNo = $_POST['repNum'];

                        $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
                        $sresult = mysqli_query($connect, $staffPar);
                        $presult = $sresult->fetch_assoc();

                        $count1 = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo)";
                        $cquery1 = $connect->query($count1);
                        $crow1 = $cquery1->fetch_assoc();
                        foreach ($crow1 as $cval1) {
                            $countVal1 = $cval1;
                        }

                        $count = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo and parish='". $presult["parish"]."') ";
                        $cquery = $connect->query($count);
                        $crow = $cquery->fetch_assoc();
                        foreach ($crow as $cval) {
                            $countVal = $cval;
                        }

                        if ($countVal == 1) {
                            $squery = "SELECT reportID, firstname, lastname, telephone, parish, town, gpscoord, address, direction, incident, description, media, vstatus, rdate FROM report WHERE reportID=$reportNo ORDER BY reportID DESC";
                            $result = mysqli_query($connect, $squery);
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <tr>
                                    <td>'.$row["reportID"].'</td>
                                    <td>'.$row["firstname"].'</td>
                                    <td>'.$row["lastname"].'</td>
                                    <td>'.$row["telephone"].'</td>
                                    <td>'.$row["parish"].'</td>
                                    <td>'.$row["town"].'</td>
                                    <td>'.$row["gpscoord"].'</td>
                                    <td>'.$row["address"].'</td>
                                    <td>'.$row["direction"].'</td>
                                    <td>'.$row["incident"].'</td>
                                    <td>'.$row["description"].'</td>
                                    <td>'.$row["media"].'</td>
                                    <td>'.$row["vstatus"].'</td>
                                    <td>'.$row["rdate"].'</td>
                                </tr>';
                            }
                        }
                        elseif ($countVal1 < 1) {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "The report number entered does not exists. Please try a new report number";
                            echo '</h2>';
                        }
                        else {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "You are not authorized to view this report.";
                            echo '</h2>';
                        }     
                    }
                ?>
            </table>

            <br>

            <form class="main-form"  method="POST" action="">
                <label class="">Enter Report Number</label>
                <div class="">
                    <input type="text" class="form-control" id="repNum" name="repNum2" placeholder="Enter report number">
                </div>

                <label class="">Select option</label>
                <div class="">
                    <select id="verifyOp" name="verifyOp" required>
                        <option value="Verified">Verified</option>
                        <option value="Fake">Fake</option>
                    </select>
                </div>

                <div class="container mb-4 mt-5">
                    <div class="row">
                        <div class="col text-center">
                            <input class="btn btn-success" type="submit" name="searchRep2" id="searchRep" value="Submit">
                        </div>
                    </div>
                </div>
                
                <?php
                
                    $connect = mysqli_connect("localhost", "root", "", "roadnet");
                    if (isset($_POST['searchRep2'])) {
                        $reportNo2 = $_POST['repNum2'];
                        $option= $_POST['verifyOp'];

                        $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
                        $sresult = mysqli_query($connect, $staffPar);
                        $presult = $sresult->fetch_assoc();

                        $count1 = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo2)";
                        $cquery1 = $connect->query($count1);
                        $crow1 = $cquery1->fetch_assoc();
                        foreach ($crow1 as $cval1) {
                            $countVal1 = $cval1;
                        }

                        $count = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo2 and parish='". $presult["parish"]."') ";
                        $cquery = $connect->query($count);
                        $crow = $cquery->fetch_assoc();
                        foreach ($crow as $cval) {
                            $countVal = $cval;
                        }

                        if ($countVal == 1) {
                            $squery = "UPDATE report SET vstatus = '$option' WHERE reportID = $reportNo2";
                            $result = mysqli_query($connect, $squery);
                        }
                
                        elseif($countVal1 < 1) {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "The report number entered does not exists. Please try a new report number";
                            echo '</h2>';
                        }

                        else {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "You are not authorized to view this report.";
                            echo '</h2>';
                        }     
                    }
                ?>
            </form>
        </div>
    </body>
</html>