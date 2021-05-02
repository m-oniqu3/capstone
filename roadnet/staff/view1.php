<?php

    $connect = mysqli_connect("localhost", "root", "", "roadnet");
    session_start();

        if(!isset($_SESSION['staff_login'])) {
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

        if(isset($_SESSION['contractor_login'])) {
            header("location: http://localhost/roadnet/contractor/contractor_home.php");
        }

        if(isset($_SESSION['staff_login'])) {
            $ename = $_SESSION['staff_login'];
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
        
        <!-- Datatables -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

        <title>Staff View Report</title>
        
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
                        <a class="nav-link" href="http://localhost/roadnet/staff/staff_home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/staff/viewReport.php">View Report<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/searchReport.php">Update Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/liveChat.php">Live Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/viewAnnouncement.php">Announcement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/sendMessage.php">Message</a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['staff_login'].'</a>
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

        <!--<div class="container">-->
            <br>
            <h1>View Report</h1>
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
                            <td>Priority</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php

                        $connect = mysqli_connect("localhost", "root", "", "roadnet");

                        $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
                        $sresult = mysqli_query($connect, $staffPar);
                        $presult = $sresult->fetch_assoc();

                        $count = "SELECT COUNT(parish) FROM report WHERE parish = '".$presult["parish"]."'";
                        $cquery = $connect->query($count);
                        $crow = $cquery->fetch_assoc();
                        foreach ($crow as $cval) {
                            $countVal = $cval;
                        }

                        if ($countVal >= 1) {
                            $query = "SELECT reportID, firstname, lastname, telephone, parish, town, gpscoord, address, direction, incident, description, media, vstatus, rdate, priority FROM report WHERE (parish = '".$presult["parish"]."') ORDER BY reportID DESC";
                            $result = mysqli_query($connect, $query);

                            while($row = mysqli_fetch_array($result)) {
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
                                    <td>'.$row["priority"].'</td>
                                    <td>';
                                        echo '<a href="updatereport1.php?id=' . $row['reportID'] . '" class=" mx-auto  btn btn-warning" >Update</a>';
                                echo '</tr>
                                ';
                            }
                        }
                        else {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "There is no available report in your parish.";
                            echo '</h2>';
                        }
                    ?>
                </table>
        <!--</div>-->
    </body>

    <script>
        $(document).ready(function() {
            $('#report_data').DataTable();
        }); 
    </script>

</html>
            