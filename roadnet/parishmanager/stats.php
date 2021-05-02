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

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


        <title>Director Home</title>

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
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/director/viewEmployee.php">View Employee</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/director/generateReport.php">Report Statistics<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/broadcast.php">Broadcast Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/viewMessage.php">View Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/roadnet/parishmanager/viewAnnouncement.php">Director Announcement</a>
                    </li>
                </ul>
                
                <span class="navbar-text">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            echo 
                                '<li class="nav-item">
                                    <a class="nav-link text-center text-info">Welcome, '.$_SESSION['parishmanager_login'].'</a>
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
       
    <script type="text/javascript">

        var data = <?php echo json_encode($_POST) ?>;
        var parish=data.parish;
        var startd=data.start;
        var endd=data.end;

        var p=parish.trim();



    </script>   
    <?php

    $connect = mysqli_connect("localhost", "root", "", "roadnet");

        $staffPar = "SELECT parish FROM employee WHERE username = '$ename'";
        $sresult = mysqli_query($connect, $staffPar);
        $presult = $sresult->fetch_assoc();

        $x = $presult["parish"];
        $s=$_POST['start'];
        $e=$_POST['end'];

        
        $query0 = "DROP VIEW IF EXISTS SINK,POT,CRACK,FALL,TRAFF,SIGN,LINE,OTHER,DATE1";

        $query1 ="Create view POT AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Potholes' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query2 = "Create view SINK AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Sinkholes' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query3 = "Create view CRACK AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Cracked Pavement' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query4 = "Create view FALL AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Falling shoulders' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query5 = "Create view TRAFF AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Malfunctioning traffic signal' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query6 = "Create view SIGN AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Missing road signs' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query7 = "Create view LINE AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Missing road lines' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";
        $query8 = "Create view OTHER AS select Count(incident) AS AMOUNT, rdate AS DATE FROM report WHERE (incident= 'Other' and parish= '".$x."'  and rdate between '$s' and '$e') group by rdate";


        $query9 = "Create view DATE1 AS select value from (select SINK.DATE as value from SINK union select POT.DATE as value from POT 
        union select CRACK.DATE as value from CRACK 
        union select FALL.DATE as value from FALL 
        union select TRAFF.DATE as value from TRAFF
        union select SIGN.DATE as value from SIGN
        union select LINE.DATE as value from LINE
        union select OTHER.DATE as value from OTHER
        ORDER BY value ASC) tt where value is not null";

        

        $res1=mysqli_query($connect,$query0);
        
        $res1=mysqli_query($connect,$query1);
        $res1=mysqli_query($connect,$query2);
        $res1=mysqli_query($connect,$query3);
        $res1=mysqli_query($connect,$query4);
        $res1=mysqli_query($connect,$query5);
        $res1=mysqli_query($connect,$query6);
        $res1=mysqli_query($connect,$query7);
        $res1=mysqli_query($connect,$query8);

        $res1=mysqli_query($connect,$query9);

    ?>

        

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {

        
        var data = google.visualization.arrayToDataTable([

          ['DATE', 'POTHOLES', 'SINKHOLES','CRACKED PAVEMENT','FALLING SHOULDERS','TRAFFIC SIGNAL','ROAD SIGNS','ROAD LINES','OTHER']


           

          <?php


        

          $connect = mysqli_connect("localhost", "root", "", "roadnet");
          
      
          
      

          

          $query="SELECT distinct DATE1.value AS DATE_ , POT.AMOUNT AS POTHOLES, SINK.AMOUNT AS SINKHOLES
           ,CRACK.AMOUNT AS CRACKR
           ,FALL.AMOUNT AS FALLS 
           ,TRAFF.AMOUNT AS TRAFFS 
           ,SIGN.AMOUNT AS RSIGN 
           ,LINE.AMOUNT AS RLINE 
           ,OTHER.AMOUNT AS OTHER1  
          FROM DATE1 left join POT On DATE1.value=POT.DATE 
          left join SINK on SINK.DATE=DATE1.value
          left join CRACK on CRACK.DATE=DATE1.value
          left join FALL on FALL.DATE=DATE1.value
          left join TRAFF on TRAFF.DATE=DATE1.value
          left join SIGN on SIGN.DATE=DATE1.value
          left join LINE on LINE.DATE=DATE1.value
          left join OTHER on OTHER.DATE=DATE1.value ORDER BY DATE1.value ASC";
          
          

          $res=mysqli_query($connect,$query);
          while ($data=mysqli_fetch_array($res)){
              $date=$data['DATE_'];
              $pot=$data['POTHOLES'];
              $sink=$data['SINKHOLES'];

              $crack=$data['CRACKR'];
              $fall=$data['FALLS'];
              $traff=$data['TRAFFS'];
              $rsign=$data['RSIGN'];
              $rline=$data['RLINE'];
              $other1=$data['OTHER1'];
              

              if ($sink<1){
                  $sink='0';
              }
              if ($pot<1){
                $pot='0';
              }
              if ($crack<1){
                $crack='0';
            }
            if ($fall<1){
                $fall='0';
            }
            if ($traff<1){
                $traff='0';
            }
            if ($rsign<1){
              $rsign='0';
            }
            if ($rline<1){
                $rline='0';
            }
            if ($other1<1){
                $other1='0';
            }
        ?>

    


        ,['<?php echo $date;?>',<?php echo $pot;?>,<?php echo $sink;?>,<?php echo $crack;?>,<?php echo $fall;?>,<?php echo $traff;?>,<?php echo $rsign;?>,<?php echo $rline;?>,<?php echo $other1;?>]

        <?php
          }
        ?>
      
      ]);

        var options = {
          title: 'Report Statistics',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

    

        <?php
        
        echo '<div class="Container">
        <br><h2>Statistics Generated</h2><br>';
        echo '<h3>Generated Report for the parish of ' . $x . '</h3>';
        echo '</div>';

        ?>
        <div class="col md-5" id="curve_chart" style="width: 2200px; height: 500px;;"></div>

        

    

    </body>

</html>
                