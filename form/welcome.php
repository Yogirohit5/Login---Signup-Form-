<?php
include "config.php";
$message = "";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM data WHERE id='$userId'";
$result = $conn->query($sql);
$userData = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $newEmail = $_POST["newEmail"];
    $newPassword = $_POST["newPassword"];
    $newphone = $_POST["newphone"];

    $sql = "UPDATE data SET email='$newEmail', password='$newPassword' , phone='$newphone' WHERE id='$userId'";
    if ($conn->query($sql) === TRUE) {
        $message = "Information updated successfully";
    } else {
        $message = "Error updating information: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Welcome</title>
</head>

<body>
    <?php include "component/nav.php" ?>

    <div class="container mt-5">
        <h1>Welcome, <?php echo $userData['username']; ?></h1>
        <h2>Update Information</h2>
        <form action="welcome.php" method="post">
            <div class="mb-3">
                <label for="newEmail" class="form-label">New Email address</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" aria-describedby="emailHelp" value="<?php echo $userData['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" name="newPassword" id="newPassword" value="<?php echo $userData['password'] ?>">
            </div>
            <div class="mb-3">
                <label for="newPhone" class="form-label">New phone</label>
                <input type="phone" class="form-control" name="newphone" id="newphone" value="<?php echo $userData['phone'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Information</button>
            <a href="logout.php"> Log Out </a>
            <label for="newPhone" class="form-label"><?php echo "$message" ?></label>
        </form>
    </div>

</body>

</html>