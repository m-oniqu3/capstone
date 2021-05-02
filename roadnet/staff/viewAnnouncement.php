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

        <title>Staff View Announcement</title>
        
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
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/viewReport.php">View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/searchReport.php">Update Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/staff/liveChat.php">Live Chat</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/staff/viewAnnouncement.php">Announcement<span class="sr-only">(current)</span></a>
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

        <div class="container">
            <br>
            <h1>View Parish Manager Announcements</h1>

            <table id="data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Title</td>
                        <td>Message</td>
                        <td>Username</td>
                    </tr>
                </thead>

            <?php

                $connect = mysqli_connect("localhost", "root", "", "roadnet"); 


                $equery = "SELECT parish from employee WHERE username = '".$ename."'";
                $eresult = mysqli_query($connect, $equery);
                $presult = $eresult->fetch_assoc();
                

                $pquery = "SELECT username FROM employee WHERE (role = 'Parish Manager' AND parish = '".$presult["parish"]."')";
                $uresult = mysqli_query($connect, $pquery);
                $uname = $uresult->fetch_assoc();

                $aquery = "SELECT aDate, aMessage, aTitle, username FROM pmAnnouncement WHERE (username = '".$uname["username"]."' AND receiver = 'Staff' OR receiver = 'All') ORDER BY announcementID DESC";
                $aresult = mysqli_query($connect, $aquery);
                while ($row = $aresult->fetch_assoc()) {
                    echo '
                    <tr>
                        <td>'.$row["aDate"].'</td>
                        <td>'.$row["aTitle"].'</td>
                        <td>'.$row["aMessage"].'</td>
                        <td>'.$row["username"].'</td>
                    </tr>';
                }
                echo '</table>';
            

            ?>
            
        </div>

        <div class="container">
            <br>
            <h1>View Director Announcements</h1>

            <table id="data2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Title</td>
                        <td>Message</td>
                        <td>Username</td>
                    </tr>
                </thead>

            <?php

                $connect = mysqli_connect("localhost", "root", "", "roadnet"); 

                $aquery = "SELECT aDate, aMessage, aTitle, username FROM drAnnouncement WHERE (receiver = 'Staff' OR receiver = 'All') ORDER BY announcementID DESC";
                $aresult = mysqli_query($connect, $aquery);
                while ($row = $aresult->fetch_assoc()) {
                    echo '
                    <tr>
                        <td>'.$row["aDate"].'</td>
                        <td>'.$row["aTitle"].'</td>
                        <td>'.$row["aMessage"].'</td>
                        <td>'.$row["username"].'</td>
                    </tr>';  
                }
                echo '</table>'; 

            ?>
            
        </div>
    </body>
    <script>
        /*$(document).ready(function(){
            $('#data').dataTable();
        });

        $(document).ready(function(){
            $('#data2').dataTable();
        });*/
    </script>
</html>