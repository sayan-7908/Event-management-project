<?php
include "db.php";
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$page_title = "My Events";
include "header.php";

$uid = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT events.* FROM participants JOIN events ON participants.event_id = events.id WHERE participants.user_id = $uid ORDER BY events.event_date");
?>
<div class="container mt-5">
  <h2 class="fw-bold mb-4">My Events</h2>
  <?php if (mysqli_num_rows($result) == 0) { ?>
    <div class="alert alert-info">You have not joined any event yet.</div>
  <?php } ?>
  <div class="row g-4">
  <?php while ($e = mysqli_fetch_assoc($result)) { ?>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 p-3">
        <div class="card-body">
          <span class="badge <?php echo badge_color($e['category']); ?> mb-2"><?php echo $e['category']; ?></span>
          <h5 class="fw-bold"><?php echo $e['title']; ?></h5>
          <p class="text-muted mb-1"><i class="bi bi-calendar-event"></i> <?php echo $e['event_date']; ?> at <?php echo $e['event_time']; ?></p>
          <p class="text-muted"><i class="bi bi-geo-alt"></i> <?php echo $e['venue']; ?></p>
          <a href="event.php?id=<?php echo $e['id']; ?>" class="btn btn-outline-secondary btn-sm">View</a>
          <a href="cancel.php?id=<?php echo $e['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Cancel participation?')">Cancel participation</a>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
<?php include "footer.php"; ?>
