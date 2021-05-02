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

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$fname = $lname = $username = $password =$email = $parish = $role = "";
$errorfname = $errorlname = $errorusername = $errorpassword = $errorparish = $errorrole = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];
    $fname =  $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST['email'];
    $parish = $_POST["parish"];
    $role = $_POST["role"];

    // Prepare an update statement
    $sql = "UPDATE employee SET fname=?, lname=?, username=?, password=?, email=?, parish=?, role=? WHERE eid=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssssi", $param_fname, $param_lname, $param_uname, $param_pwd, $param_email, $param_address, $param_role, $param_id);

        // Set parameters

        $param_fname = $fname;
        $param_lname = $lname;
        $param_uname = $username;
        $param_pwd = $password;
        $param_email = $email;
        $param_address = $parish;
        $param_role = $role;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to landing page
            header("location: http://localhost/roadnet/admin/crud.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    // Close statement
    mysqli_stmt_close($stmt);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM employee WHERE eid = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $parish = $row['parish'];
                    $role = $row['role'];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <form class="main-form col-10 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
        <h2 class="mt-5">Update Record</h2>
        <p>Please edit the input values and submit to update the employee record.</p>
        <div class="form-row p-2">

            <div class="form-group col-md-6">
                <label class="h6 text-success" for="fullname">First Name</label>
                <div class="">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $fname; ?>" required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label class="h6 text-success" for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>" required>
            </div>
        </div>

        <div class="form-row p-2">
            <div class="form-group col-md-6">
                <label class="h6 text-success" for="staffuser">Username</label>
                <div class="">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label class="h6 text-success" for="staffpwd">Password</label>
                <div class="">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                </div>
            </div>
        </div>

        <!-- Address  -->
        <div class="form-row p-2">
            <div class="form-group col-md-6">
                <label class="h6 text-success" for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group col-md-6">
                
                    <label class="h6 text-success" for="parish">Parish</label>
                    <div class="">
                        <select name="parish" id="parish" class="form-control" required>

                            <option selected value="<?php echo $parish; ?>"> <?php echo $parish; ?> </option>
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

                    <option selected value="<?php echo $role; ?>"> <?php echo $role; ?> </option>
                    <option value="Staff">Staff</option>
                    <option value="Parish Manager">Parish Manager</option>
                    <option value="Director">Director</option>
                    <option value="Admin">Admin</option>
                    <option value="Contractor">Contractor</option>
                </select>
            </div>
        </div>
        <br>
        <div class="text-right">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="submit" class="btn btn-success " value="Submit">
            <a href="crud.php" class="btn btn-danger  ml-2">Cancel</a>
        </div>
    </form>

</body>

</html>