<?php
include "../db.php";
// Only log out the admin
unset($_SESSION['admin']);
header("Location: login.php");
