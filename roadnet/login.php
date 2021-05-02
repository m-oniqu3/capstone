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

        <title>Roadnet Login</title>

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
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/searchReports.php">Find your Reports</a>
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
                        <li class="nav-item active">
                            <a class="nav-link text-primary" href="http://localhost/roadnet/login.php">Login<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </span>
            </div>
        </nav>

        <?php 

            require 'logRedirect.php'

        ?>

        <br>
        

        <div class="container">
            <form method="POST" class="col-lg-6 mx-auto mt-5">

                <div class="form-group">
                    <label class="control-label">Username</label>
                    <div class="">
                        <input type="text" name="username" class="form-control" placeholder="Enter username" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Password</label>
                    <div class="">
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label">Select Role</label>
                    <div class="">   
                        <select class="form-control" id="loginRole" name="role" required>
                            <option selected disabled> -- Please select your role -- </option>
                            <option value="Admin">Admin</option>
                            <option value="Director">Director</option>
                            <option value="Parish Manager">Parish Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="Contractor">Contractor</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <input type="submit" name="btn_login" class="btn btn-success" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>


