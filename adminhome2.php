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


input[type=reset] {
  width: 100%;
  align-self: center;
  background-color:  #b38600;
  color: white;
  padding: 0.5%;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=reset]:hover {
  background-color: #007acc;
}

table, th,td {
  align-content: center;
  margin-left: 23%;
  border: 2px solid black;
 font-size: 120%;
 background-color: #262525;
}
#f{
  margin-left: 35%;
  font-size: 120%;
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

input[type=text], select {
  width: 25%;
  align-self: center;
  padding: 0.5%;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
 
}
input[type=integer], select {
  width: 25%;
  align-self: center;
  padding: 0.5%;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
 
}
input[type=date], select {
  width: 25%;
  align-self: center;
  padding: 0.5%;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
 
}
input[type=submit] {
  width: 10%;
  align-self: center;
  background-color: red  ;
  color: white;
  padding: 0.5%;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=reset] {
  width: 10%;
  align-self: center;
  background-color: red  ;
  color: white;
  padding: 0.5%;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


</style>
  <title>Welcome </title>
</head>
<body>
  <br>
<h1>SPOT LIGHT</h1>
<h2>BOOK MY MOVIE</h2>
<div align="right" style="font-size:20px"> <?php  echo "Logged in as " . $_SESSION["aname"] ; ?></div>
<div class="topnav">
  <a class="home" href="frontpage.php">Home</a>
  <a class="movie" href="adminhome.php">Movie</a>
  <a class="show" href="adminhome2.php">Shows</a>
  <a class="view" href="adminhome3.php">View</a>
  <a class="end" href="logout2.php">Logout</a>
</div>

<h3>ADMIN LOGIN</h3>

<div class="form1">

  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
    <h3>Add Perforamce Date</h3>
    <label for="movieid">Movie Id</label>
    <br>
    <input type="integer" id="movieid" name="movieid" placeholder="Movie id.."  maxlength="15" required>
    <br>
    <label for="performancedate">Performace Date</label>
    <br>
    <input type="date" id="performancedate" name="performancedate" placeholder="performance date.." required>
    <br>
    <input type="submit"  name="submit2" value="Submit" >
    <input type="reset" value="Clear">
    
  </form>

</div>
<br>
<div class="form1">

  <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
    <h3>Delete Performance Date</h3>
    
    <label for="movieid">Performace date</label>
    <br>
    <input type="date" id="performancedate" name="performancedate" placeholder="performance date.."  required>
      <br>
    <input type="submit" name="submit1" value="Submit" >
    <input type="reset" value="Clear">
    
  </form>

</div>
<br>
<br>
<?php 
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $performancedate =$_POST['performancedate'] ;
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
    
       if(!empty( $_POST['submit2'] )) {
        $movieid=$_POST['movieid'];
       $sql2 = "INSERT into moviedates(movieid,performancedate)VALUES ('$movieid','$performancedate')";
       if ($conn->query($sql2) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
      
      
      }
      if( !empty($_POST['submit1'] )) {
      $sql = "DELETE FROM moviedates where performancedate='$performancedate' ";
        if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
         
        }
       if (isset($_POST['submit1']) || isset($_POST['submit2'])) {
       $sql = "SELECT * FROM moviedates";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
            <th>Movie Id</th>
            <th>Movie dates</th>
            <th>Total ticket</th>
            <th>No.of Booked tickets</th>
            <th>No.of Available tickets</th>

          </tr>";
          while($row = $result->fetch_assoc()) {
            echo"<tr><td>" . $row["movieid"]."</td><td>". $row["performancedate"]."</td><td>" . $row["totaltic"]."</td><td>" . $row["bookedtic"]."</td><td>" . $row["availabletic"]. "<br>" . "</td></tr>
            ";
          }
          echo "</table>";
        } else {
          echo "0 results";
        }
      }
    }

    $conn->close();
    }

?>
</body>
</html>

<!--
  if($INSERT){
        echo "<script type='text/javascript'>alert('Inserted successfully!')</script>";
      }
      $stmt->close();-->