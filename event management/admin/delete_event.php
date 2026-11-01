<?php
include "../db.php";
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

$id = $_GET['id'];
// delete the participants first, then the event
mysqli_query($conn, "DELETE FROM participants WHERE event_id = $id");
mysqli_query($conn, "DELETE FROM events WHERE id = $id");
header("Location: index.php");
