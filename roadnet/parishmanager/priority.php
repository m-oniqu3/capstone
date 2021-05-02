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
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$priority = "";
$errpriority = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];
    $priority = $_POST["priority"];
    

    // Prepare an update statement
    $sql = "UPDATE report SET priority=? WHERE reportID=?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_prior, $param_id);

        // Set parameters

        $param_prior = $priority;
        $param_id = $id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records updated successfully. Redirect to landing page
            header("location: setpriority.php");
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
                    $priority = $row['priority'];
                    
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
        <title>Update/Set Priority</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://localhost/roadnet/css/parishstyles.css">

    </head>


    <body>
        <div class="container col-md-8">
            <div class="widebox mx-auto bg-warning p-4 mt-4 mb-5">
                <p class="h1 ml-3 mt-3 text-white">Update Priority</p>
                <p class="lead mt-3 ml-3 text-white">Update the priority of this report. </p>
            </div>
        </div>

        <form class="main-form col-10 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

            <div class="form-group mx-auto ">
                
                <label class="h6 text-warning" for="priority">Priority Type</label>
                <div class="">
                    <select name="priority" id="priority" class="form-control" required>

                        <!--<option selected  value="<?php /* echo $priority; ?>"> <?php echo $priority; */?></option>-->
                               
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Low">Low</option>
                                
                    </select>
                </div>
            </div>


            <br>
            <div class="text-right">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" class="btn btn-warning " value="Submit">
                <a href="http://localhost/roadnet/parishmanager/setpriority.php" class="btn btn-danger ml-2">Cancel</a>
            </div>
        </form>

    </body>
</html>













































<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://localhost/roadnet/css/parishstyles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-brand col-4 col-lg-1"> <img src="http://localhost/roadnet/images/logo.png" class="img-fluid">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Roadnet </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">View Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Generate Report </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Broadcast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Priortize</a>
                </li>
            </ul>
        </div>
    </nav>

    
    <div class="widebox mx-auto bg-warning p-4 mt-4 mb-5">
        <p class="h1 ml-3 mt-3 text-white">Update Priority</p>
        <p class="lead mt-3 ml-3 text-white">View submitted incident reports in a particular location in your parish. Search for the report by its address or its town. </p>
    </div>

    <div class="container mt-4 p-4 ">
        <form>
            <div class="form-group mx-auto col-lg-6 ">
                Select the priority type for this report.<br>
                <label class="h6 text-warning" for="recipient">Priority Type</label>
                <div class="">
                    <select name="type " id="type " class="form-control " required>

                        <option disabled selected value=""> -- Select an incident type -- </option>
                        <option disabled></option>
        
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Moderate">Moderate</option>
                        <option value="Low">Low</option>
                                
                    </select>
                </div>
            </div>

          
        </form>
    </div>

</body>

</html>-->