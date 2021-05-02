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

        <title>View Report</title>
    
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/report.php">Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/viewReport.php">Update</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/searchReports.php">Find your Reports<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Live Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/roadnet/login.php">Login</a>
                        </li>
                    </ul>
                </span>
            </div>
        </nav>

        <div class="container">
            <br>
            <h1>View All Your Reports</h1>
            <div class="container col-lg-5 mx-auto">
                <form class="main-form"  method="POST" action="">

                    <br>
                    <br>

                    <!-- First Name -->
                    <div class="">
                        <label class="" for="telephone">Enter your Telephone Number</label>
                        <div class="">
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="18761234567" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" required>
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

            <table id="report_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Report ID</td>
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
                    </tr>
                </thead>

                <?php
                
                    $connect = mysqli_connect("localhost", "root", "", "roadnet");
                    if (isset($_POST['searchRep'])) {
                        $tele = $_POST['telephone'];

                        $ecount = "SELECT COUNT(telephone) FROM report WHERE telephone = '{$tele}'";
                        $equery = $connect->query($ecount);
                        $ecrow = $equery->fetch_assoc();
                        foreach ($ecrow as $ecval) {
                            $ecountVal = $ecval;
                        }

                        if ($ecountVal >= 1) {
                            $query = "SELECT reportID, parish, town, gpscoord, address, direction, incident, description, media, vstatus, rdate, priority FROM report WHERE (telephone = '{$tele}') ORDER BY reportID DESC";
                            $result = mysqli_query($connect, $query);

                            while($row = mysqli_fetch_array($result)) {
                                echo '
                                <tr>
                                    <td>'.$row["reportID"].'</td>
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
                                </tr>
                                ';
                            }
                        }
                        else {
                            echo '<h2 class="alert alert-danger" role="alert">';
                            echo "There is no report associated with that telephone number.";
                            echo '</h2>';
                        }
                    }
                ?>
            </table>
        </div>
    </body>
</html>