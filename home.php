<!-- <!doctype html> -->
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <title>IITG - Mess Rating System</title>
</head>

<body>


    <div>

        <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "IITGMessRating";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['login']))
    {
      $des = $_POST['options'];
      $uname=$_POST['username'];
      $upassword=$_POST['password'];
      $sql = "";
      if ($des == "Student")
      $sql = "SELECT * FROM Users WHERE Username='".$uname."' AND Designation='student'";
      else if ($des == "MessManager")
      $sql = "SELECT * FROM Hostels WHERE MessManagerUsername='".$uname."'";
      else if ($des == "Admin")
      $sql = "SELECT * FROM Users WHERE Username='".$uname."' AND Designation='admin'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
          // if(.$row["Password"].==$upassword){
          $pass = "Password";
          $user1 = "Username";
          if ($des == "MessManager"){
            $pass = "MessManagerPassword";
          }
          if($row[$pass]==$upassword ){
            $_SESSION[$user1] = $uname;
            $_SESSION['Designation'] = '';
            $_SESSION['logged_in'] = true;
            if ($des == "Student"){
              header("Location: profile.php");
              $_SESSION['Designation'] = 'student';
            }
            else if ($des == "MessManager"){
              header("Location: profile_messmanager.php");
              $_SESSION['Designation'] = 'messmanager';
            }
            else if ($des == "Admin"){
              header("Location: profile_admin.php");
              $_SESSION['Designation'] = 'admin';
            }
          }
          else {

            $message = "Invalid Password";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
        }

      } else {
        $message = "Invalid Username";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }

    $conn->close();
    ?>

    </div>



    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slide1.jpg" class="d-block w-100" alt="image">
                <div class="carousel-caption d-none d-md-block">
                    <div class="cards" style="opacity: 0.9">

                        <h2>IITG Mess Feedback System</h2>
                        <h5>The one stop solution to Mess Reports, Feedback, Change Mess and Admin support</h5>
                        <div class="card-body">
                            <form action="home.php" method="post">
                                <p><input class="form-control" name='username' placeholder="Username" type="text"
                                        size="50" style="text-align:center;" required /></p>
                                <p><input class="form-control" name='password' placeholder="Password" type="password"
                                        size="50" style="text-align:center;" required /></p>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-danger active">
                                        <input type="radio" name="options" value="Student" autocomplete="off" checked>
                                        Student
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio" name="options" value="MessManager" autocomplete="off"> Mess
                                        Manager
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio" name="options" value="Admin" autocomplete="off"> Admin
                                    </label>
                                </div>
                                <input class="btn btn-primary" name="login" type="submit" value="Login" />
                            </form>
                        </div>
                    </div>

                    <p>Enter credentials to continue</p>
                    <br><br><br><br><br><br>
                </div>
            </div>

            <div class="carousel-item">
                <img src="images/slide2.jpg" class="d-block w-100" alt="image">
                <div class="carousel-caption">
                    <div class="cards" style="opacity: 0.9">

                        <h2>IITG Mess Feedback System</h2>
                        <h5>The one stop solution to Mess Reports, Feedback, Change Mess and Admin support</h5>
                        <div class="card-body">
                            <form action="home.php" method="post">
                                <p><input class="form-control" name='username' placeholder="Username" type="text"
                                        size="50" style="text-align:center;" required /></p>
                                <p><input class="form-control" name='password' placeholder="Password" type="password"
                                        size="50" style="text-align:center;" required /></p>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-danger active">
                                        <input type="radio" name="options" value="Student" autocomplete="off" checked>
                                        Student
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio" name="options" value="MessManager" autocomplete="off"> Mess
                                        Manager
                                    </label>
                                    <label class="btn btn-danger">
                                        <input type="radio" name="options" value="Admin" autocomplete="off"> Admin
                                    </label>
                                </div>
                                <input class="btn btn-primary" name="login" type="submit" value="Login" />
                            </form>
                        </div>
                    </div>

                    <p>Enter credentials to continue</p>

                    <br><br><br><br><br><br>
                </div>
            </div>


        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col align-self-center">






            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

    <!-- {% block your_content %}
  {% endblock %} -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- {% block scripts %}
  {% endblock %} -->
</body>

</html>