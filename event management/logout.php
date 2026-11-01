<?php
include "db.php";
// Only log out the student (admin session is separate)
unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
header("Location: index.php");
