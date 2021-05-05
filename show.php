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
  
  margin-left: 43%;
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
      $movieid1 = $_GET["m1"];
      	$sql2=$conn->query("SELECT moviename FROM movies  where movieid='$movieid1'");
         $result2=$sql2->fetch_assoc();
         echo "<h1>".$result2['moviename']. "</h1><br>" ;
      	 $sql = "SELECT performancedate FROM moviedates where movieid='$movieid1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
             <th>Movie Dates</th>
            <th>Book</th>
          </tr>";
          while($row = $result->fetch_assoc()) {
          	$performancedate=$row["performancedate"];
            echo"<tr><td>" . $row["performancedate"]."</td><td>"."<div><button onclick=book($movieid1,'$performancedate')>book now</button></div>". "<br>" . "</td></tr> ";
            
          }
         
          echo "</table>";
        
        } else {
          echo "0 results";
        }
       
  	}
      	

?>
</body>
</html>

<script type="text/JavaScript">
     function book(mov,p2) {
        var mov1  = mov;
        var p3=p2;
        window.location.href = "moviedetails.php?m2=" + mov1+ "&m3=" +p2;

    };
</script>