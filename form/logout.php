<?php
include "config.php";
session_unset();
session_destroy();
header("Location: signup.php");
?>