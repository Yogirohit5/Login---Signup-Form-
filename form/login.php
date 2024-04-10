<?php
include"config.php";
$masssge="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $Email=$_POST["Email"];
  $password=$_POST["password"];

$sql = "SELECT * FROM data WHERE email='$Email' AND password='$password'";
$result = $conn->query($sql);
 
$datafatch = $result->fetch_assoc();

if($datafatch){
if ($datafatch['email'] === $Email && $datafatch['password'] === $password)  {
     $masssge = "Login successfull";
     $_SESSION['user_id'] = $datafatch['id'];
     header("Location: welcome.php");
  }
} 
 else {
  $masssge = "Login failed. Please check your username and password";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>login</title>
</head>
<body>
<?php include "component/nav.php"
?>
<div class="container mt-5">
<form action="login.php" method="post"> 
  <div class="mb-3 ">
    <label for="Email" class="form-label">Email address</label>
    <input  type="email" class="form-control" id="exampleInputEmail1" name="Email" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password"  id="passwordinput">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="signup.php"> New member? Sign In </a>
     <label for="msg" class="form-label"><?php echo "$masssge" ?></label>
</form>

</div>
    
</body>
</html>