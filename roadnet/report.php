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

        <!-- For captcha -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script>

          function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            }
            else { 
              document.getElementById("gpscoord").value = "Geolocation is not supported by this browser.";
            }
          }
          
          function showPosition(position) {
            document.getElementById("gpscoord").value = "Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude;
          }

        </script>

        <title>Report</title>

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
                        <a class="nav-link" href="http://localhost/roadnet/login.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="http://localhost/roadnet/report.php">Report<span class="sr-only">(current)</span></a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/roadnet/login.php">Login</a>
                        </li>
                    </ul>
                </span>
            </div>
        </nav>
        
        <?php 
              if (isset($_POST['saveBtn'])) {

              $secretKey = "6LeA5asaAAAAAJZcdX6J6orp2TbvTwSjH0oZlJ0I";
              $responseKey = $_POST['g-recaptcha-response'];

              $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
              $response = file_get_contents($url);
              $response = json_decode($response);

              if ($response->success) {

                $conn = mysqli_connect("localhost", "root", "", "roadnet");

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $telephone = $_POST['telephone'];
                $parish = $_POST['parish'];
                $town = $_POST['town'];
                $gpscoord = $_POST['gpscoord'];
                $address = $_POST['address'];
                $direction = $_POST['direction'];
                $incident = $_POST['incident'];
                $description = $_POST['description'];
                $media = $_POST['media'];
                $status = "Pending";
                date_default_timezone_set('Jamaica');
                $date = date("Y/m/d");
                $prior = "Low"; 

                $save = "INSERT INTO report(firstname, lastname, telephone, parish, town, gpscoord, address, direction, incident, description, media, vstatus, rdate, priority) VALUES ('".$firstname."', '".$lastname."', '".$telephone."', '".$parish."', '".$town."', '".$gpscoord."', '".$address."', '".$direction."', '".$incident."', '".$description."', '".$media."', '".$status."', '".$date."', '".$prior."')";         
                $query = mysqli_query($conn, $save);

                $repIDquery = "SELECT MAX(reportID) as reportID from report WHERE telephone = '{$telephone}'";
                $represult = mysqli_query($conn, $repIDquery);
                while ($row = $represult->fetch_assoc()) {
                  $reportIDno = $row['reportID'];
                }

                ob_start();
               
                echo '<h3 class="alert alert-success text-center" role="alert">';
                echo "Your report has been submitted. <br><b>Your report ID is $reportIDno, please keep your report ID safe.</b>";
                echo '</h3>';
                header("refresh:6; http://localhost/roadnet/report.php");

                ob_end_flush();
              }
              else {
                echo '<h3 class="alert alert-danger text-center" role="alert">';
                echo "Please verify that you are not a human by checking the RECAPTCHA."; 
                echo '</h3>';
              }
            }
        ?>

        <form class="main-form col-10 col-sm-10 col-md-8 col-lg-6 col-xl-6 mx-auto " method="POST" action="" required>
          <div class="form-row p-2">

            <!-- First Name -->
            <div class="form-group col-md-6">
              <label class="h6 text-success" for="firstname">First Name</label>
              <div class="">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
              </div>
            </div>

            <!-- Last Name -->
            <div class="form-group col-md-6">
              <label class="h6 text-success" for="lastname">Last Name</label>
              <div class="">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
              </div>
            </div>

          </div>

          <!-- Telephone Number -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="telephone">Telephone Number</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="18761234567" pattern="[0-9]{4}[0-9]{3}[0-9]{4}" required>
          </div>

          <div class="form-row p-2">
            <div class="form-group col-md-6">

              <!-- Parish -->
              <label class="h6 text-success" for="parish">Parish</label>
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

            <!-- Town/City/District -->
            <div class="form-group col-md-6">
              <label class="h6 text-success" for="town">Town/City/District</label>
              <div class="">
                <input type="text" class="form-control" id="town" name="town" placeholder="Enter Town/City/District" required>
              </div>
            </div>
          </div>

          <div class="p-2 col-12">

            <!-- GPS Coordinates -->
            <label class="h6 text-success" for="GPS">GPS Coordinate</label>
            <button onclick="getLocation()">Click Here for GPS Location</button>
            <div class="">
              <input type="text" class="form-control readonly" autocomplete="off" id="gpscoord" name="gpscoord" placeholder="GPS Coordinates" required>

              <script>
                $(".readonly").on('keydown paste focus mousedown', function(e){
                if(e.keyCode != 9) // ignore tab
                  e.preventDefault();
                });
              </script>

            </div>
          </div>

          <!-- Address -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="address">Address (Street Number and Street name)</label>
            <div class="">
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter address of incident" required>
            </div>
          </div>

          <!-- Direction of the incident -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="direction">Direction</label>
            <div class="">
              <input type="text" class="form-control" id="direction" name="direction" placeholder="Enter directions of the incident" required>
            </div>
          </div>

          <!-- Incident Type -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="incident" >Incident Type</label>
            <p> What is the primary category of the incident you are reporting? <!-- *If none is listed, select one closest to the type of incident being reported.--> </p>
            <div class="">
              <select name="incident" id="incident" name="incident" class="form-control" required>
        
                <option disabled selected value=""> -- Select an incident type -- </option>
                <option disabled></option>

                <option value="Potholes">Potholes</option>
                <option value="Cracked Pavement">Cracked Pavement</option>
                <option value="Sinkholes">Sinkholes</option>
                <option value="Falling shoulders">Falling shoulders</option>
                <option value="Flooded roads">Flooded roads</option>
                <option value="Malfunctioning traffic signal">Malfunctioning traffic signal</option>
                <option value="Missing road signs">Missing road signs</option>
                <option value="Missing road lines">Missing road lines</option>
                <option value="Other">Other</option>

              </select>
            </div>
          </div>

          <!-- Description -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="description">Description</label>
            <div class="">
              <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter the incident details" required></textarea>
            </div>
          </div>

          <!-- Media -->
          <div class="p-2 col-12">
            <label class="h6 text-success" for="media">Media</label>
            <p>Upload your picture or video of the incident </p>
            <div class="">
              <input type="file" id="media" name="media" multiple required>
            </div>
          </div>

          <br>

          <!-- Captcha -->
          <div class="g-recaptcha" data-sitekey="6LeA5asaAAAAAMnR3JS_GLuRPY1HD2pjWfDUzPb4"></div>

          <br>

          <!-- Submit Button -->
          <div class="p-2 col-12">
            <div class="">
              <button type="submit" class="btn btn-success" name="saveBtn">Submit</button>
            </div>
          </div>
        </form>
    </body>
</html>