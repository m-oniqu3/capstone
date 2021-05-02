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
            header("location: http://localhost/roadnet/staff/staff_home.php");
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

    <title>Create User</title>

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
                  echo '
                      <li class="nav-item">
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

    <form class="main-form col-10 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto " action="http://localhost/roadnet/admin/createusr/insert.php" method="POST">
    <div class="form-row p-2">
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="fullname">First Name</label>
        <div class="">
          <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="lastname">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
      </div>
    </div>
    <div class="form-row p-2">
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="staffuser">Username</label>
        <div class="">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="staffpwd">Password</label>
        <div class="">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
      </div>
    </div>
    <!-- Email and Parish-->
    <div class="form-row p-2">
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="johnbrown@example.com" required>
      </div>
      
      <div class="form-group col-md-6">
        <label class="h6 text-success" for="parish">Parish</label>
        <div class="">
          <select name="parish" id="parish" class="form-control" required>
            <option disabled selected value> -- Select a Parish -- </option>
            <option disabled></option>
            <option disabled> Cornwall County </option>
            <option value="Hanover">Hanover</option>
            <option value="St. James">St. James</option>
            <option value="Trelawny">Trelawny</option>
            <option value="Westmoreland">Westmoreland</option>
            <option value="St. Elizabeth">St. Elizabeth</option>
            <option disabled></option>
            <option disabled> Middlesex County </option>
            <option value="St. Ann">St. Ann</option>
            <option value="St. Mary">St. Mary</option>
            <option value="Clarendon">Clarendon</option>
            <option value="Manchester">Manchester</option>
            <option value="St. Catherine">St. Catherine</option>
            <option disabled></option>
            <option disabled> Surrey County </option>
            <option value="Portland">Portland</option>
            <option value="St. Andrew">St. Andrew</option>
            <option value="Kingston">Kingston</option>
            <option value="St. Thomas">St. Thomas</option>
          </select>
        </div>
      </div>
    </div>
    <!-- User Role-->
    <div class="p-2 col-12">
      <label class="h6 text-success" for="role">Role</label>
      <div class="">
        <select name="role" id="role" class="form-control" required>
          <option disabled selected value> -- Select a Role -- </option>
          <option value="Staff">Staff</option>
          <option value="Parish Manager">Parish Manager</option>
          <option value="Director">Director</option>
          <option value="Admin">Admin</option>
          <option value="Contractor">Contractor</option>
        </select>
      </div>
    </div>
    <br>
    <!-- Submit Button -->
    <div class="p-2 col-12">
      <div class="text-right">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="http://localhost/roadnet/admin/crud.php" class="btn btn-danger ml-2">Cancel</a>
      </div>
    </div>
    <br>
  </form>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>

</html>