<?php
include "db.php";
// Student cancels participation
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$uid = $_SESSION['user_id'];
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM participants WHERE user_id = $uid AND event_id = $id");
header("Location: my_events.php");
