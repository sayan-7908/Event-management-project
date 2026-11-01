<?php
include "db.php";
$page_title = "Event Details";
include "header.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM events WHERE id = $id");
$e = mysqli_fetch_assoc($result);

if (!$e) {
    echo "<div class='container mt-5'><div class='alert alert-warning'>Event not found.</div></div>";
    include "footer.php";
    exit;
}

// Seats left
$c = mysqli_query($conn, "SELECT COUNT(*) AS total FROM participants WHERE event_id = $id");
$row = mysqli_fetch_assoc($c);
$left = $e['seats'] - $row['total'];

// Did this student already join?
$joined = false;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $check = mysqli_query($conn, "SELECT * FROM participants WHERE user_id = $uid AND event_id = $id");
    if (mysqli_num_rows($check) > 0) { $joined = true; }
}
?>
<div class="container mt-5">
  <?php if (isset($_GET['msg'])) { ?>
    <div class="alert alert-info"><?php echo $_GET['msg']; ?></div>
  <?php } ?>
  <div class="card p-4">
    <span class="badge <?php echo badge_color($e['category']); ?> mb-2 align-self-start"><?php echo $e['category']; ?></span>
    <h2 class="fw-bold"><?php echo $e['title']; ?></h2>
    <p><?php echo $e['description']; ?></p>
    <p><i class="bi bi-calendar-event"></i> <b>Date:</b> <?php echo $e['event_date']; ?></p>
    <p><i class="bi bi-clock"></i> <b>Time:</b> <?php echo $e['event_time']; ?></p>
    <p><i class="bi bi-geo-alt"></i> <b>Venue:</b> <?php echo $e['venue']; ?></p>
    <p><i class="bi bi-people"></i> <b>Seats left:</b> <?php echo $left; ?> of <?php echo $e['seats']; ?></p>

    <?php if (!isset($_SESSION['user_id'])) { ?>
      <a href="login.php" class="btn btn-accent align-self-start">Login to Participate</a>
    <?php } else if ($joined) { ?>
      <button class="btn btn-success align-self-start" disabled>You have joined this event</button>
    <?php } else if ($left <= 0) { ?>
      <button class="btn btn-secondary align-self-start" disabled>Event Full</button>
    <?php } else { ?>
      <a href="participate.php?id=<?php echo $id; ?>" class="btn btn-accent align-self-start">Participate</a>
    <?php } ?>
  </div>
</div>
<?php include "footer.php"; ?>
