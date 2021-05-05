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
  <BR>
  <h1>SPOT LIGHT</h1>
<h2>BOOK MY MOVIE</h2>
<br>
<form name ="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="fo" onsubmit="return validateForm()">
    <div id="fhead">
    <h2>Sign Up/Sign In</h2>
    </div>
    <label for="fname">User Name</label>
    <br>
    <input type="text" id="fname" name="username" placeholder="Your name.." pattern="[a-zA-Z]+" required >
    <br>
    <label for="email">Email</label>
    <br>
    <input type="email" id="ema" name="email" placeholder="Your email.." required >
    <br>
    <label for="pass">Password</label>
    <br>
    <input type="password" id="pass" name="password" placeholder="Your password.." pattern="[a-zA-Z0-9]+" required> 
    <br>
    <input type="submit" name="sig" value="Sign Up /Sign In" >
  </form>
   <p align="center" ><a style="color: red" href="movieadminlogin.php" >Admin</a></p>
<br>
<?php 
if (isset($_POST['sig'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (!empty($username)  && !empty($email)&& !empty($password)) {
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
     
      $SELECT = "SELECT email From register Where email = ? Limit 1";
      $INSERT = "INSERT into register(username,email,password )VALUES (?,?,?)";
         $stmt = $conn->prepare($SELECT);
         $stmt->bind_param("s", $email);
         $stmt->execute();
         $stmt->bind_result($email);
         $stmt->store_result();
         $rnum = $stmt->num_rows;
         if ($rnum==0) 
         {
          $stmt->close();
          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("sss",$username,$email,$password);
          $stmt->execute();
          if($INSERT){
            echo "<script type='text/javascript'>alert('Regiserted successfully!')</script>";
            $_SESSION['username'] = $username;
               header("location: booking.php");
          }
         } 
         else 
         {
          if($_SERVER["REQUEST_METHOD"] == "POST") 
         {
          
            $username = $_POST['username'];
           $db='movie';
          $sql = "SELECT username FROM register WHERE username = '$username' and email='$email' and password = '$password'";
          $result = $conn->query($sql);
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
          
          $count = mysqli_num_rows($result);
          if($count == 1)
           {
                echo "<script type='text/javascript'>alert('Login Successful!')</script>";
               $_SESSION['username'] = $username;
               header("location: booking.php");
          }
          else 
          {
             echo "Your Id or Email or Password  is invalid!";
          }
         }
     }
      
      $stmt->close();
      $conn->close();
      
    }
  }
  else 
  {
   echo "All fields are required!";
   die();
  }
}
?>
</body>
</html>