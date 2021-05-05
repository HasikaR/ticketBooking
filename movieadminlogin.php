<?php
setcookie("username", "admin", time()+60);
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
  align-content: center;
  margin-left: 31%;
  border: 2px solid black;
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
input[type=email], select {
  width: 25%;
  align-self: center;
  padding: 0.5%;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
 
}
input[type=password], select {
  width: 25%;
  align-self: center;
  padding: 0.5%;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
 
}
input[type=submit] {
  width: 25%;
  align-self: center;
  background-color: red ;
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
  <BR>
  <h1>SPOT LIGHT</h1>
<h2>BOOK MY MOVIE</h2>
<h3>ADMIN LOGIN</h3>
<br>
<div class="aform">
<form name ="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="fo">
    <label for="aname">User Name</label>
    <br>
    <input type="text" id="aname" name="aname" placeholder="Your name.." pattern="[a-zA-Z]+" required>
    <br>
    <label for="pass">Password</label>
    <br>
    <input type="password" id="pass" name="passw" placeholder="Your password.." pattern="[a-zA-Z0-9]+" required> 
    <br>
    <input type="submit" name="si" value="Sign In" >
  </form>
 

</div>
<br>
<button><a href="frontpage.php">Back</a></button>
<br>
<?php
    if(isset($_COOKIE["username"]))
    {
        echo "Cookie set with value: ".$_COOKIE["username"];
    }
    else
    {
        echo "cookie not set!";
    }
    ?>
<?php
if (isset($_POST['si'])) {
  $aname = $_POST['aname'];
  $passw = $_POST['passw'];
  if (!empty($aname)  && !empty($passw)) {
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
     if($_SERVER["REQUEST_METHOD"] == "POST") 
     {
      echo "hi";
      $sql = "SELECT aname FROM movieadmin WHERE aname = '$aname'  and passw = '$passw'";
      $result = $conn->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      if($count == 1)
       {
            echo "<script type='text/javascript'>alert('Login Successful!')</script>";
            $_SESSION['aname'] = $aname;
           header("location: adminhome.php");
       }
      else 
      {
         echo "Your username or Password  is invalid!";
      }
        

      $conn->close();
      
    }
    else 
    {
     echo "All fields are required!";
     die();
    }
  }
  }
}
  ?>

</body>
</html>