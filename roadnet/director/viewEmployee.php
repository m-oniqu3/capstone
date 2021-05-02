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
            $_SESSION['director_login'];
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
        
        <title>Director View Employee</title>
        
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
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/director/viewEmployee.php">View Employee<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/generateReport.php">Report Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/broadcast.php">Broadcast Message</a>
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

        <div class="d-flex justify-content-center">

            <br>
            <h1>View Employee</h1>

        </div>

        <div class="container col-lg-5 mx-auto">
            <br>
            <form class="main-form " method="POST" action="">

                <!-- Parish -->
                <div class="">
                    <label class="">Select the parish for the reports you wish to view.</label>
                    <div class="">
                        <select name="parish" id="parish" class="form-control" required>
            
                            <option disabled selected value=""> -- Select a Parish -- </option>
                            <option disabled></option>

                            <option disabled>Cornwall County</option>
                            <option value="Hanover">Hanover</option>
                            <option value="St. James">St. James</option>
                            <option value="Trelawny">Trelawny</option>
                            <option value="Westmoreland">Westmoreland</option>
                            <option value="St. Elizabeth">St. Elizabeth</option>

                            <option disabled></option>

                            <option disabled>Middlesex County</option>
                            <option value="St. Ann">St. Ann</option>
                            <option value="St. Mary">St. Mary</option>
                            <option value="Clarendon">Clarendon</option>
                            <option value="Manchester">Manchester</option>
                            <option value="St. Catherine">St. Catherine</option>

                            <option disabled></option>

                            <option disabled>Surrey County</option>
                            <option value="Portland">Portland</option>
                            <option value="St. Andrew">St. Andrew</option>
                            <option value="Kingston">Kingston</option>
                            <option value="St. Thomas">St. Thomas</option>
                        </select>
                    </div>
                </div>
                    
                <div class="container mb-4 mt-3">
                    <div class="row">
                        <div class="col text-center">
                            <input class="btn btn-success" type="submit" name="searchRep" id="searchRep" value="Search">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container">
            <?php 
                $connect = mysqli_connect("localhost", "root", "", "roadnet");

                if (isset($_POST['searchRep'])) {
                    $parish = $_POST['parish'];

                    echo '
                    <table id="employee_data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>Employee ID</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Username</td>
                                <td>Email</td>
                                <td>Parish</td>
                                <td>Role</td>
                            </tr>
                        </thead>';

                        $query = "SELECT eid, fname, lname, username, email, parish, role FROM employee WHERE parish = '$parish'";
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result)) {
                                echo "
                                <tr>
                                    <td>".$row['eid']."</td>
                                    <td>".$row['fname']."</td>
                                    <td>".$row['lname']."</td>
                                    <td>".$row['username']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['parish']."</td>
                                    <td>".$row['role']."</td>
                                </tr>";
                        }
                    echo '</table>';
                }
            ?>
        </div>
    </body>

    <script>
        $(document).ready(function() {
            $('#employee_data').DataTable();
        });
    </script>
</html>