<?php
    session_start();

        if(!isset($_SESSION['director_login'])) {
            header("location: http://localhost/roadnet/login.php");
        }

        if(isset($_SESSION['parishmanager_login'])) {
            header("location: http://localhost/roadnet/parishmanager/parishmanager_home.php");
        }

        if(isset($_SESSION['admin_login'])) {
            header("location: http://localhost/roadnet/admin/admin_home.php");
        }

        if(isset($_SESSION['staff_login'])) {
            header("location: http://localhost/roadnet/staff/staff_home.php");
        }

        if(isset($_SESSION['contractor_login'])) {
            header("location: http://localhost/roadnet/contractor/contractor_home.php");
        }

        if(isset($_SESSION['director_login'])) {
            $ename = $_SESSION['director_login'];
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
        
        <title>Director Home</title>
        
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
                        <a class="nav-link" href="http://localhost/roadnet/director/director_home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/viewReport.php">View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/viewEmployee.php">View Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/generateReport.php">Report Statistics</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/director/broadcast.php">Broadcast Message<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['director_login'].'</a>
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

            if (isset($_POST['saveBtn'])) {
                $recp = $_POST['recipient'];
                $title = $_POST['title'];
                $message = $_POST['message'];
                date_default_timezone_set('Jamaica');
                $date = date("Y/m/d");

                $connect = mysqli_connect("localhost", "root", "", "roadnet");

                $iquery = "INSERT INTO drannouncement(receiver, aDate, aMessage, aTitle, username) values ('".$recp."', '".$date."', '".$message."', '".$title."', '".$ename."')";
                $riquery = mysqli_query($connect, $iquery);

                ob_start();
               
                echo '<h3 class="alert alert-success text-center" role="alert">';
                echo "Your message has been successfully broadcasted.";
                echo '</h3>';
                header("refresh:4; http://localhost/roadnet/director/broadcast.php");

                ob_end_flush();
            }
        ?>

        <div class="">
            <h1>Broadcast Message</h1>
        </div>
        <div class="container ">
            <form class="main-form col-10 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto " method="POST" action="" required>
                <div class="form-group ">
                    <label class="h6 text-success" for="recipient">Recipient</label>
                    <div class="">
                        <select name="recipient" id="recipient" class="form-control " required>
                            <option disabled selected value> -- Send To -- </option>
                            <option value="Staff">Staff</option>
                            <option value="Contractor">Contractor</option>
                            <option value="Parish Manager">Parish Manager</option>
                            <option value="All">All</option>
                        </select>
                    </div>

                    <br>

                    <div class="">
                        <label class="h6 text-success" for="title">Title</label>
                        <div class="">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter broadcast title" required></input>
                        </div>
                    </div>

                    <br>

                    <div class="">
                        <label class="h6 text-success" for="message">Message</label>
                        <div class="">
                            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Type your message here.." required></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="">
                        <button type="submit" class="btn btn-success" name="saveBtn">Broadcast</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>