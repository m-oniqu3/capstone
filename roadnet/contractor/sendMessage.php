<?php

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
        
        <title>Contractor Send Message</title>
        
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
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/verifyReport.php">Verify</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/contractor/viewAnnouncement.php">Announcement</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/contractor/sendMessage.php">Message<span class="sr-only">(current)</span></a>
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

        <?php
          
            $connect = mysqli_connect("localhost", "root", "", "roadnet");  
                
            if(isset($_POST['submit'])) {
                $reportNo = $_POST['repNum'];
                $message = $_POST['description'];
                date_default_timezone_set('Jamaica');
                $date = date("Y/m/d"); 

                $repIDquery = "SELECT MAX(messageID) AS updateNo FROM staffMessage WHERE (reportID = $reportNo AND username= '$ename')";
                $represult = $connect->query($repIDquery);
                $row = $represult->fetch_assoc();
                $updateNo = $row["updateNo"];
                $updateNo++;

                $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
                $sresult = mysqli_query($connect, $staffPar);
                $presult = $sresult->fetch_assoc();

                $count1 = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo)";
                $cquery1 = $connect->query($count1);
                $crow1 = $cquery1->fetch_assoc();
                foreach ($crow1 as $cval1) {
                    $countVal1 = $cval1;
                }

                $count = "SELECT COUNT(reportID) FROM report WHERE (reportID = $reportNo and parish = '".$presult["parish"]."') ";
                $cquery = $connect->query($count);
                $crow = $cquery->fetch_assoc();
                foreach ($crow as $cval) {
                    $countVal = $cval;
                }

                $pmquery = "SELECT username FROM employee WHERE (role = 'Parish Manager' AND parish = '".$presult["parish"]."')";
                $pmqresult = mysqli_query($connect, $pmquery);
                $pmresult = $pmqresult->fetch_assoc();
                $pmr = $pmresult["username"];

                if ($countVal == 1) {
                    $squery = "INSERT INTO staffMessage (reportID, txtMessage, username, messageID, mDate, mReceiver) values ('$reportNo', '$message', '$ename', '$updateNo', '$date', '$pmr')";
                    $result = mysqli_query($connect, $squery);  
                    echo '<h2 class="alert alert-success" role="alert">';
                    echo "Your message has been sent.";
                    echo '</h2>';
                    header("refresh:3; http://localhost/roadnet/contractor/sendMessage.php");
                }
                elseif ($countVal1 < 1) {
                    echo '<h2 class="alert alert-danger" role="alert">';
                    echo "The report number entered does not exists. Please try a new report number";
                    echo '</h2>';
                }   
                else {
                    echo '<h2 class="alert alert-danger" role="alert">';
                    echo "You are not authorized to comment on this report number.";
                    echo '</h2>';
                }   
            }     
        ?>       

        <div class="container">
            <h1>Report to Parish Manager</h1>
            <div class="container col-lg-5 mx-auto">
            
            <form class="main-form " method="POST" action="">

                <br>
                <br>

                <!-- Report Number -->
                <div class="">
                    <label class="" >Enter Report Number</label>
                    <div class="">
                        <input type="text" class="form-control" id="repNum" name="repNum" placeholder="Enter report number " required>
                    </div>
                </div>

                <br>

                <div class="p-2 col-12">
                    <label class="" for="pwd">Enter Your Findings</label>
                <div class="">
                    <textarea class="form-control" id="description" name="description" rows="7" placeholder="" required></textarea>
                </div>
                </div>
                
                <div class="container mb-4 mt-3">
                    <div class="row">
                        <div class="col text-center">
                            <input class="btn btn-success" type="submit" name="submit" id="submit" value="Submit">
                        </div>
                    </div>
                </div>

            </form>
        </div>           
    </body>
</html>