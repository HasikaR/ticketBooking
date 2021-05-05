<?php
session_start();
if(!isset($_SESSION['aname']))
      header("Location: front.html");
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
  
  margin-left: 0.5%;
  border: 2px solid black;
  font-size: 20px;
  background-color: #262525;
}
.c3{
  margin-left: 23%;
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
  <div align="right" style="font-size:20px"> <?php  echo "Logged in as " . $_SESSION["aname"] ; ?></div> 
<div class="topnav">
  <a class="home" href="frontpage.php">Home</a>
  <a class="movie" href="adminhome.php">Movie</a>
  <a class="show" href="adminhome2.php">Shows</a>
  <a class="view" href="adminhome3.php">View</a>
  <a class="end" href="logout2.php">Logout</a>
</div>
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

       $sql = "SELECT * FROM movies";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
            <th>Movie Id</th>
            <th>Movie names</th>
            <th>Movie dates</th>
            
          </tr>";
          while($row = $result->fetch_assoc()) {
            echo"<tr><td>" . $row["movieid"]."</td><td>". $row["moviename"]."</td><td>" . $row["description"]. "<br>" . "</td></tr>
            ";
          }
          echo "</table><br>";
        } else {
          echo "0 results";
        }
        
        $sql2 = "SELECT * FROM moviedates";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            echo "<table class='c3'>";
            echo "<tr>
            <th>Movie Id</th>
            <th>Movie dates</th>
            <th>Total ticket</th>
            <th>No.of Booked tickets</th>
            <th>No.of Available tickets</th>

          </tr>";
          while($row2 = $result2->fetch_assoc()) {
            echo"<tr><td>" . $row2["movieid"]."</td><td>". $row2["performancedate"]."</td><td>" . $row2["totaltic"]."</td><td>" . $row2["bookedtic"]."</td><td>" . $row2["availabletic"]. "<br>" . "</td></tr>
            ";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }
    $conn->close();
    }

?>
</body>
</html>

