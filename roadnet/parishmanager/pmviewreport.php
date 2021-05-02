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

        <div class="widebox mx-auto p-4 mt-4 mb-5">
            <p class="h1 ml-3 mt-3 text-white">View Reports</p>
            <p class="lead mt-3 ml-3 text-white">View submitted incident reports in a particular location in your parish. Search for the report by its address or its town. </p>
        </div>

    <!--<div class="container mt-4">
        <form>
            <div class="form-row p-2">
                <div class="form-group col-md-6">
                    <label class="h6 text-success" for="location">Location</label>
                    <div class="">
                        <select name="location" id="location" class="form-control" required>

                            <option disabled selected value> -- Choose Location By -- </option>
                            <option value="Address">Address</option>
                            <option value="Town">Town</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="h6 text-success" for="search">Search For</label>
                    <input type="text" class="form-control" id="search" name="search" required>
                </div>

                <div class="p-2 col-12">
                    <div class="text-right">
                      <button type="submit" class="btn text-white c">Search</button>
                      
                    </div>
                </div>
            </div>
        </form>
    </div>-->

        <div class="container-fluid  ">
            <div class="row p-2">

                <?php
                // Include config file
                require_once "config.php";

                // Attempt select query execution
                $connect = mysqli_connect("localhost", "root", "", "roadnet");

                $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
                $sresult = mysqli_query($connect, $staffPar);
                $presult = $sresult->fetch_assoc();

                $sql = "SELECT * FROM report WHERE (parish = '".$presult["parish"]."')";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table id="myTable" class="table c table-bordered text-center table-sm table-responsive">';
                        echo '<thead>';
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>First Name</th>";
                        echo "<th>Last Name</th>";
                        echo "<th>Phone</th>";
                        /*echo "<th>Parish</th>";*/
                        echo "<th>Town</th>";
                        /*echo "<th>GPS Coordinates</th>";*/
                        echo "<th>Address</th>";
                        /*echo "<th>Direction</th>";*/
                        echo "<th>Type</th>";
                        /*echo "<th>Description</th>";*/
                        echo "<th>Status</th>";
                        echo "<th>Date</th>";
                        echo "<th>Priority</th>";
                        echo "<th>Assigned To</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['reportID'] . "</td>";
                            echo "<td>" . $row['firstname'] . "</td>";
                            echo "<td>" . $row['lastname'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            /*echo "<td>" . $row['parish'] . "</td>";*/
                            echo "<td>" . $row['town'] . "</td>";
                            /*echo "<td>" . $row['gpscoord'] . "</td>";*/
                            echo "<td>" . $row['address'] . "</td>";
                            /*echo "<td>" . $row['direction'] . "</td>";*/
                            echo "<td>" . $row['incident'] . "</td>";
                            /*echo "<td>" . $row['description'] . "</td>";*/
                            echo "<td>" . $row['vstatus'] . "</td>";
                            echo "<td>" . $row['rdate'] . "</td>";
                            echo "<td>" . $row['priority'] . "</td>";
                            echo "<td>" . $row['assignedTo'] . "</td>";
                            echo '<td>';
                            echo '<a href="?id=' . $row['reportID'] . '" class=" mx-auto  btn btn-success" >View</a>';
                            echo "</td>";

                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No reports were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(function() {
            $('#myTable').dataTable();
        });
    </script>

</html>