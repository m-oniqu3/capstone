<?php

require_once 'connection.php';

session_start();

if(isset($_SESSION["admin_login"])) {
    header("location: http://localhost/roadnet/admin/admin_home.php");
}

if(isset($_SESSION["parishmanager_login"])) {
    header("location: http://localhost/roadnet/parishmanager/parishmanager_home.php");
}

if(isset($_SESSION["director_login"])) {
    header("location: http://localhost/roadnet/director/director_home.php");
}

if(isset($_SESSION["staff_login"])) {
    header("location: http://localhost/roadnet/staff/staff_home.php");
}

if(isset($_SESSION["contractor_login"])) {
    header("location: http://localhost/roadnet/contractor/contractor_home.php");
}

if(isset($_REQUEST['btn_login'])) {
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $role = $_REQUEST["role"];

    if(empty($username)) {
        $errorMsg[] = "Please enter username";
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Please enter your username and try again.';
        echo '</div>';
    }
    else if(empty($password)) {
        $errorMsg[] = "Please enter password";
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Please enter your password and try again.';
        echo '</div>';
    }
    else if(empty($role)) {
        $errorMsg[] = "Please select your role";
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Please enter your role and try again.';
        echo '</div>';
    }
    else if($username AND $password AND $role) {
        try {
            $select_stmt = $db->prepare("SELECT username, password, role FROM employee WHERE username=:uuser AND password=:upass AND role=:urole");
            $select_stmt->bindParam(":uuser", $username);
            $select_stmt->bindParam(":upass", $password);
            $select_stmt->bindParam(":urole", $role);
            $select_stmt->execute();

            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) {
                $dbuser = $row["username"];
                $dbpassword = $row["password"];
                $dbrole = $row["role"];
            }

            if($username!=null AND $password!=null AND $role!=null) {
                if($select_stmt->rowCount()>0) {
                    if($username==$dbuser AND $password==$dbpassword AND $role==$dbrole) {
                        switch($dbrole) {
                            case "Admin";
                            $_SESSION["admin_login"]=$username;
                            $loginMsg="Admin has been successfully logged in.";
                            echo '<div class="alert alert-success" role="alert">';
                            echo $loginMsg;
                            echo '</div>';
                            header("refresh:1.5; http://localhost/roadnet/admin/admin_home.php");
                            break;

                            case "Parish Manager";
                            $_SESSION["parishmanager_login"]=$username;
                            $loginMsg="Parish Manager has been successfully logged in.";
                            echo '<div class="alert alert-success" role="alert">';
                            echo $loginMsg;
                            echo '</div>';
                            header("refresh:1.5; http://localhost/roadnet/parishmanager/parishmanager_home.php");
                            break;

                            case "Director";
                            $_SESSION["director_login"]=$username;
                            $loginMsg="Director has been successfully logged in.";
                            echo '<div class="alert alert-success" role="alert">';
                            echo $loginMsg;
                            echo '</div>';
                            header("refresh:1.5; http://localhost/roadnet/director/director_home.php");
                            break;

                            case "Staff";
                            $_SESSION["staff_login"]=$username;
                            $loginMsg="Staff has been successfully logged in.";
                            echo '<div class="alert alert-success" role="alert">';
                            echo $loginMsg;
                            echo '</div>';
                            header("refresh:1.5; http://localhost/roadnet/staff/staff_home.php");
                            break;

                            case "Contractor";
                            $_SESSION["contractor_login"]=$username;
                            $loginMsg="Contractor has been successfully logged in.";
                            echo '<div class="alert alert-success" role="alert">';
                            echo $loginMsg;
                            echo '</div>';
                            header("refresh:1.5; http://localhost/roadnet/contractor/contractor_home.php");
                            break;

                            default:
                            $errorMsg[]="Wrong username or password or role";
                            echo '<div class="alert alert-danger" role="alert">';
                            echo 'Incorrect credentials. Please try again.';
                            echo '</div>';
                        }
                    }
                    else {
                        $errorMsg[]="Wrong username or password or role";
                        echo '<div class="alert alert-danger" role="alert">';
                        echo 'Incorrect credentials. Please try again.';
                        echo '</div>';
                    }
                }
                else {
                    $errorMsg[]="Wrong username or password or role";
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Incorrect credentials. Please try again.';
                    echo '</div>';
                }
            }
            else {
                $errorMsg[]="Wrong username or password or role";
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Incorrect credentials. Please try again.';
                echo '</div>';
            }
        }
        catch(PDOException $e) {
            $e->getMessage();
        }
    }
    else {
        $errorMsg[]="Wrong username or password or role";
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Incorrect credentials. Please try again.';
        echo '</div>';
    }
}
?>