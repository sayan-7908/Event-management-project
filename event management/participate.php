<?php
include "db.php";
// Student joins an event
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$uid = $_SESSION['user_id'];
$id = $_GET['id'];

// already joined?
$check = mysqli_query($conn, "SELECT * FROM participants WHERE user_id = $uid AND event_id = $id");
// seats left?
$ev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT seats FROM events WHERE id = $id"));
$c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM participants WHERE event_id = $id"));

if (mysqli_num_rows($check) > 0) {
    $msg = "You already joined this event.";
} else if ($ev['seats'] - $c['total'] <= 0) {
    $msg = "Sorry, no seats left.";
} else {
    $today = date('Y-m-d');
    mysqli_query($conn, "INSERT INTO participants (user_id, event_id, registered_on) VALUES ($uid, $id, '$today')");
    $msg = "You are registered. See you there!";
}
header("Location: event.php?id=$id&msg=" . urlencode($msg));
