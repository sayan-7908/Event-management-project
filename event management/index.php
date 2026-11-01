<?php
include "db.php";
$page_title = "SKF Events";
include "header.php";

// Only show events from today onwards
$today = date('Y-m-d');
$result = mysqli_query($conn, "SELECT * FROM events WHERE event_date >= '$today' ORDER BY event_date");
?>
<div class="hero text-center">
  <div class="container">
    <h1 class="fw-bold">Discover. Join. Celebrate!</h1>
    <p class="lead">All the fun college events of SKF in one place.</p>
    <a href="#events" class="btn btn-accent btn-lg px-4">See Events</a>
  </div>
</div>

<div class="container mt-5" id="events">
  <h2 class="fw-bold mb-4">Upcoming Events</h2>
  <div class="row g-4">
  <?php while ($e = mysqli_fetch_assoc($result)) {
      // seats left = total seats - number of participants
      $c = mysqli_query($conn, "SELECT COUNT(*) AS total FROM participants WHERE event_id = " . $e['id']);
      $row = mysqli_fetch_assoc($c);
      $left = $e['seats'] - $row['total'];
  ?>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 p-3">
        <div class="card-body">
          <span class="badge <?php echo badge_color($e['category']); ?> mb-2"><?php echo $e['category']; ?></span>
          <h5 class="fw-bold"><?php echo $e['title']; ?></h5>
          <p class="text-muted mb-1"><i class="bi bi-calendar-event"></i> <?php echo $e['event_date']; ?> at <?php echo $e['event_time']; ?></p>
          <p class="text-muted"><i class="bi bi-geo-alt"></i> <?php echo $e['venue']; ?></p>
          <p><i class="bi bi-people"></i> Seats left: <b><?php echo $left; ?></b></p>
          <a href="event.php?id=<?php echo $e['id']; ?>" class="btn btn-accent">View Details</a>
        </div>
      </div>
    </div>
  <?php } ?>
  </div>
</div>
<?php include "footer.php"; ?>
