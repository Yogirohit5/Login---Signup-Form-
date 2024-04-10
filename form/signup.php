<?php
include "config.php";
$message = "";
$condition = false;
$usernameError = $emailError = $phoneError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $username = $_POST["username"];
  $Email = $_POST["Email"];
  $password = $_POST["password"];
  $phone = $_POST["phone"];


  if (empty($username) or strlen($username) <= 7) {
    $condition = true;
    $usernameError = "Please enter the name (at least 10 characters)";
  }
  if (empty($Email) or strpos($Email, '@') === false or strpos($Email, '.') === false) {
    $condition = true;
    $emailError = "Please enter a valid email";
  }
  if (empty($password) or strlen($password) <= 6) {
    $condition = true;
    $passwordError = "Please enter a valid password (at least 6 characters)";
  }
  if (empty($phone) or strlen($phone) <= 9) {
    $condition = true;
    $phoneError = "Please enter a valid phone (at least 10 characters)";
  }
  
  if (!$condition) {
    if ($conn->query($sql)) {
      $message = "Registration successful";
    } else {
      $message = "Error: " . $conn->error;
    }
  };
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <title>signup</title>
</head>

<body>
  <?php include "component/nav.php"
  ?>
  <div class="container mt-5">
    <form action="signup.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="username" class="form-control" name="username" id="exampleInputPassword1">
        <span id="$usernameError"><?php echo $usernameError; ?></span>
      </div>
      <div class="mb-3">
        <label for="Email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="Email" id="exampleInputEmail1" aria-describedby="emailHelp">
        <span id="emailerror"><?php echo $emailError; ?></span>
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" value="">
        <span id="passworderror"><?php echo $passwordError; ?></span>
      </div>
      <div class="mb-3">
        <label for="Phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" id="phone">
        <span id="phoneerror"><?php echo $phoneError; ?></span>
      </div>
      <!-- <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" name="image">
      </div> -->
      <div>
        <button type="submit" class="btn btn-primary ">Submit</button><br>
        <a href="login.php"> Already a member? Log In </a>
        <label for="msg" class="msg"> <?php echo $message; ?></label>
      </div>
    </form>
  </div>

</body>

</html>