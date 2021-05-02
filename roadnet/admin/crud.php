<?php

session_start();

        if(!isset($_SESSION['admin_login'])) {
            header("location: http://localhost/roadnet/login.php");
        }

        if(isset($_SESSION['parishmanager_login'])) {
            header("location: http://localhost/roadnet/parishmanager/parishmanager_home.php");
        }

        if(isset($_SESSION['director_login'])) {
            header("location: http://localhost/roadnet/director/director_home.php");
        }

        if(isset($_SESSION['staff_login'])) {
            header("location: .http://localhost/roadnet/staff/staff_home.php");
        }

        if(isset($_SESSION['contractor_login'])) {
            header("location: http://localhost/roadnet/contractor/contractor_home.php");
        }

        if(isset($_SESSION['admin_login'])) {
            $_SESSION['admin_login'];
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
        
        <!-- NEW -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Datatables -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        <title>Administrator's Dashboard</title>

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
                        <a class="nav-link" href="http://localhost/roadnet/admin/admin_home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/admin/crud.php">View & Modify Users<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['admin_login'].'</a>
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

    <div class="container-fluid col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="row">
            <div class="col-md-12">
                <div class=" mb-3 list-inline">
                    <h2 class="list-inline-item text-info">Employee Records</h2>
                    <a href="http://localhost/roadnet/admin/createusr/createuser.php" class="btn btn-info list-inline-item pull-right"><i class="fa fa-plus-circle"></i> Create Employee</a>
                </div>
                <p class="lead">Create, Update and View employee records here. </p>
                <?php
                // Include config file
                require_once "config.php";

                // Attempt select query execution
                $sql = "SELECT * FROM employee";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table id="myTable" class="col-12 col-md-12 col-lg-12 col-xl-12 table text-center table-bordered table-striped">';
                        echo '<thead >';
                        echo "<tr>";
                        echo "<th>Employee ID</th>";
                        echo "<th>First Name</th>";
                        echo "<th>Last Name</th>";
                        echo "<th>Username</th>";
                        echo "<th>Password</th>"; 
                        echo "<th>Email Address</th>";
                        echo "<th>Parish</th>";
                        echo "<th>Role</th>";
                        echo "<th>Actions</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['eid'] . "</td>";
                            echo "<td>" . $row['fname'] . "</td>";
                            echo "<td>" . $row['lname'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['parish'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo '<td>';

                            echo '<a href="update.php?id=' . $row['eid'] . '" class=" mx-auto  btn btn-success" >Update</a>';
                            echo '<a href="delete.php?id=' . $row['eid'] . '" class=" ml-3  btn btn-danger" >Delete</a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No employee records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
    
</body>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>