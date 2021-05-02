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

        <title>Success</title>
    </head>
    <body>
        <?php
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $parish = $_POST['parish'];
            $role = $_POST['role'];
    
            if (!empty($firstname) || !empty($lastname) || !empty($username) || !empty($password)  || !empty($email) || !empty($parish) || !empty($role)) {
                $host = "localhost";
                $dbUsername = "root";
                $dbPassword = "";
                $dbname = "roadnet";
            
                $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
            
                if (mysqli_connect_error()) {
                    die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
                }
                else {
                    $SELECT = "SELECT username From employee WHERE username = ? Limit 1";
                    $SELECT2 = "SELECT email From employee WHERE email = ? Limit 1";
                    $INSERT = "INSERT into employee (fname, lname, username, password, email, parish, role) values (?, ?, ?, ?, ?, ?, ?)";
            
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($username);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;
            
                    $stmt2 = $conn->prepare($SELECT2);
                    $stmt2->bind_param("s", $email);
                    $stmt2->execute();
                    $stmt2->bind_result($email);
                    $stmt2->store_result();
                    $rnum2 = $stmt2->num_rows;
            
                    if ($rnum==0) {
                        $stmt->close();
            
                        if($rnum2==0) {
                            $stmt2->close();
            
                        $stmt = $conn->prepare($INSERT);
                        $stmt->bind_param("sssssss", $firstname, $lastname, $username, $password, $email, $parish, $role);
                        $stmt->execute();
                        echo '<h2 class="alert alert-success" role="alert">';
                        echo 'User has been created successfully! Redirecting to CRUD Page';
                        echo '</h2>';
                        echo '<br>';
                        echo '<br>';
                        echo '<img src="https://media.giphy.com/media/jAYUbVXgESSti/giphy.gif" width="480" height="270" class="rounded mx-auto d-block">';
    
                        header("refresh:3.9; http://localhost/roadnet/admin/crud.php");
                        exit();
                    }
                    else {
                        echo "This email is not unique.";
                         }
                    }
                    else {
                        echo "There is already a staff with that username.";
                    }
            
                    $conn->close();
                }
            }
            else {
                echo "All fields are required";
                die();
            }
        ?>
    </body>
</html>
