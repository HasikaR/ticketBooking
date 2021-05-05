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
  <h3>BOOK MY MOVIE</h3>
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
      $movieid1 = $_GET["m2"];
      $perform1=$_GET["m3"];
      	$sql2=$conn->query("SELECT moviename FROM movies  where movieid='$movieid1'");
         $result2=$sql2->fetch_assoc();
         echo "<h1>".$result2['moviename']. "</h1>" ;
         $sql3=$conn->query("SELECT description FROM movies  where movieid='$movieid1'");
         $result3=$sql3->fetch_assoc();
         echo "<h3>".$result3['description']. "</h3><br>" ;
      	 $sql = "SELECT totaltic,bookedtic,availabletic FROM moviedates where movieid='$movieid1'and performancedate='$perform1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>
             <th>Total no. of tickets</th>
             <th>No.of Booked tickets</th>
             <th>No.of Available tickets</th>
            <th>Book</th>
          </tr>";
          while($row = $result->fetch_assoc()) {
            $t1=$row["totaltic"];
            $b1=$row["bookedtic"];
            $a1=$row["availabletic"];
            $perform2=$perform1;
            echo"<tr><td>" . $row["totaltic"]."</td><td>". $row["bookedtic"]."</td><td>". $row["availabletic"]."</td><td>"."<div class='form1'>
            $perform2
          <form id='for1' onSubmit='return checkTic($t1,$b1,$a1,$movieid1)' method='post'>
            <h3>No .of Tickets</h3>
            
            <label for='tickets'></label>
            <br>
            <input type='integer' id='tic' name='tic' placeholder='No of tickets required'  required >
            <br>
            <input type='submit' value='Submit'>
            <input type='reset' value='Clear'>
          </form>


        </div>". "<br>" . "</td></tr> ";

            
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
    function checkTic(t,b,a,m) {
      var m2 = parseInt(m);
      var t2 = parseInt(t);
      var b2 = parseInt(b);
      var a2 = parseInt(a);
      var pe2='<?php echo $perform2; ?>';
      var x=parseInt(document.getElementById("tic").value);
      if(x>t2 || x>a2)
        alert("Ticket exceeds the total range");
      else
      {
        b2=b2+x;
        a2=a2-x;
        var price=x*100;
        document.getElementById('for1').action="booked.php?w1=" +b2+ "&w2=" +a2+ "&w3=" +m2+ "&w4=" +pe2+ "&w5=" +price;
        
      }
      
      
      
    }
</script>


<!--

  PERFORMANCCE DATE SHOULD ALSO MATCH FOR SHOW TICKET UPDATE
  <button onclick=checkTic($movieid1)>

    window.location.href = "moviedetails.php?m2=" + s1+ "&w2=" + tic;

    var total="<?php echo($totaltic);?>";
      var avail="<?php echo($availabletic);?>";
      var booked="<?php echo($bookedtic);?>";
      if(t>total || t>avail)
        alert("Ticket exceeds the total range");
      else
      {
        
        alert("Ticket booked");
        window.location.href = "moviedetails.php?m2=" + mov;
        form.action ="booked.php?w1=" +b2+ "&w2=" +a2+ "&w3=" +m2;
      }
    -->