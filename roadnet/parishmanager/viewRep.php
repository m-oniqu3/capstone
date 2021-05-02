<?php
    session_start();

        if(!isset($_SESSION['parishmanager_login'])) {
            header("location: http://localhost/roadnet/login.php");
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
            header("location: http://localhost/roadnet/contractor/contractor_home.php");
        }

        if(isset($_SESSION['parishmanager_login'])) {
            $ename = $_SESSION['parishmanager_login'];
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
        
        <!-- DataTable -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        <link rel="stylesheet" href="http://localhost/roadnet/css/parishstyles.css">

        <title>Parish Manager View Report</title>

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
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/parishmanager_home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/parishmanager/pmviewreport.php">View Report<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/setpriority.php">Prioritize Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/generateReport.php">Generate Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/broadcast.php">Broadcast Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/viewMessage.php">View Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/viewAnnouncement.php">Director Announcement</a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['parishmanager_login'].'</a>
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
            <div class="container">
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "roadnet");

                    $squery = "SELECT * FROM report where reportID = 1 ORDER BY reportID DESC";
                    $result = mysqli_query($connect, $squery);
                    while ($row = $result->fetch_assoc()) {
                        echo 'Report ID ' . $row["reportID"];

                        echo '<br><br>';

                        echo 'First Name ' . $row["firstname"];

                        echo '<br><br>';

                        echo 'Last Name ' . $row["lastname"];

                        echo '<br><br>';

                        echo 'Telephone Number ' . $row["telephone"];

                        echo '<br><br>';

                        echo 'Parish ' . $row["parish"];

                        echo '<br><br>';

                        echo 'Town ' . $row["town"];

                        echo '<br><br>';

                        echo 'GPS Coordinates ' . $row["gpscoord"];

                        echo '<br><br>';

                        echo 'Address ' . $row["address"];

                        echo '<br><br>';

                        echo 'Direction ' . $row["direction"];

                        echo '<br><br>';

                        echo 'Incident Type ' . $row["incident"];

                        echo '<br><br>';

                        echo 'Incident Description ' . $row["description"];

                        echo '<br><br>';

                        echo 'Media ' . $row["media"];

                        echo '<br><br>';         

                        echo 'Verification Status ' . $row["vstatus"];

                        echo '<br><br>';

                        echo 'Report Date ' . $row["rdate"];

                        echo '<br><br>';

                        echo 'Priority ' . $row["priority"];
                        
                        echo '<br><br>';
                        
                        echo 'Assigned To ' . $row["assignedTo"];
                    }

                ?>
            </div> 
        </div>
        
    </body>
</html>