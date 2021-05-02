<?php

    $connect = mysqli_connect("localhost", "root", "", "roadnet");
    session_start();

        if(!isset($_SESSION['staff_login'])) {
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

        if(isset($_SESSION['contractor_login'])) {
            header("location: http://localhost/roadnet/contractor/contractor_home.php");
        }

        if(isset($_SESSION['staff_login'])) {
            $ename = $_SESSION['staff_login'];
        }
?>

<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$contract = "";
$errcontract = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];
    $contract = $_POST["contract"];
    

    // Prepare an update statement
    $sql = "UPDATE report SET assignedTo=? WHERE reportID=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_assign, $param_id);

        // Set parameters

        $param_assign = $contract;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to landing page
            header("location: viewReport.php");
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
        $sql = "SELECT * FROM report WHERE reportID = ?";
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
                    $contract = $row['assignedTo'];
                    
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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
       
        <link rel="stylesheet" href="http://localhost/roadnet/css/parishstyles.css">
        <title>Staff View Report</title>
        
    </head>

    <body>
        <div class="container  col-12 col-md-8 col-lg-8">
            <div class="widebox mx-auto bg-warning p-4 mt-4 mb-5">
                <p class="h1 ml-3 mt-3 text-white">Update Priority</p>
                <p class="lead mt-3 ml-3 text-white">Update the priority of this report. </p>
            </div>
        </div>

        
            <form  class="main-form col-12 col-md-7 col-lg-7 mx-auto" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group mx-auto ">
                    <label class="">Select Contractor to Assign Report to</label>
                    <div class="">
                        <select name="contract" id="contract" class="form-control" required>
                            <option class="form-control" selected disabled>-- Select Contractor --</option>
                            <option class="form-control" selected value="<?php echo $contract; ?>"><?php echo $contract; ?></option>

                            <?php
                                $connect = mysqli_connect("localhost", "root", "", "roadnet");

                                $query = "SELECT username FROM employee WHERE role = 'Contractor'";
                                $result = mysqli_query($connect, $query);

                                while($row = mysqli_fetch_array($result)) {
                                    echo "<option class='form-control' id='contractor' value='" . $row['username'] . "'>".$row['username']."</option>";
                                }
                                echo '</select>';
                            ?>
                        
                    </div>
                </div>

                <br>

                <div class="text-right">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-warning " value="Submit">
                    <a href="viewReport.php" class="btn btn-danger ml-2">Cancel</a>
                </div>
            </form>
        </div> 
    
    </body>
</html>