<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <style>
body {
  background-image: url("black.jpg");
  background-size: cover;
  text-align: center;
  color:red;
}
table, th,td {
  
  margin-left: 30%;
  border: 2px solid black;
  font-size: 20px;
}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.home {
  background-color: red ;
  color: white;
}
.topnav a.end {
  float: right;
}

</style>
  <title>Welcome </title>
</head>
<body>
  <BR>
  <h1>SPOT LIGHT</h1>
  <h3>BOOK MY MMOVIE</h3>
  <div align="right" style="font-size:20px"> <?php  echo "Logged in as " . $_SESSION["username"] ; ?></div> 
<div class="topnav">
  <a class="home" href="frontpage.php">Home</a>
  <a class="end" href="logout2.php">Logout</a>
</div>
<br>

<h2>Movie Name</h2>

<br>
<?php
        $host='localhost';
          $user='root';
          $pass='';
          $db='movie';
          $conn = new mysqli($host, $user, $pass,$db);
          if (mysqli_connect_error()) 
          {
           die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
          } 
          else
          {
            $b2 = $_GET["w1"];
            $a2 = $_GET["w2"];
            $m2 = $_GET["w3"];
            $p2 = $_GET["w4"];
            $price = $_GET["w5"];
            $sql = "UPDATE moviedates SET bookedtic='$b2',availabletic='$a2' WHERE movieid='$m2'and performancedate ='$p2'; ";

            if ($conn->query($sql) === TRUE) {
              echo "<h3>Ticket booked successfully</h3>";
              echo "Ticket price $price";
              echo"<h3>Enjoy your Movie</h3>";
            } else {
              echo "Error in Ticket booking: " . $conn->error;
            }
               $conn->close();
          }
?>
</body>
</html>