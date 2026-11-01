<?php
include "../db.php";
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
$base = "../"; $is_admin = true; $page_title = "Admin Dashboard";
include "../header.php";

// Counts for the dashboard
$a = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM events"));
$b = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"));
$c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM participants"));
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date");
?>
<div class="container mt-5">
  <h2 class="fw-bold mb-4">Dashboard</h2>
  <div class="row g-3 mb-4">
    <div class="col-md-4"><div class="card p-3 text-center"><h6>Events</h6><h2><?php echo $a['total']; ?></h2></div></div>
    <div class="col-md-4"><div class="card p-3 text-center"><h6>Students</h6><h2><?php echo $b['total']; ?></h2></div></div>
    <div class="col-md-4"><div class="card p-3 text-center"><h6>Registrations</h6><h2><?php echo $c['total']; ?></h2></div></div>
  </div>
  <div class="card p-3">
    <div class="d-flex justify-content-between mb-3">
      <h4 class="fw-bold">All Events</h4>
      <a href="add_event.php" class="btn btn-accent">+ Add Event</a>
    </div>
    <div class="table-responsive">
    <table class="table align-middle">
      <tr><th>ID</th><th>Title</th><th>Category</th><th>Date</th><th>Venue</th><th>Seats</th><th>Actions</th></tr>
      <?php while ($e = mysqli_fetch_assoc($events)) { ?>
      <tr>
        <td><?php echo $e['id']; ?></td>
        <td><?php echo $e['title']; ?></td>
        <td><span class="badge <?php echo badge_color($e['category']); ?>"><?php echo $e['category']; ?></span></td>
        <td><?php echo $e['event_date']; ?></td>
        <td><?php echo $e['venue']; ?></td>
        <td><?php echo $e['seats']; ?></td>
        <td>
          <a href="participants.php?id=<?php echo $e['id']; ?>" class="btn btn-sm btn-info">Participants</a>
          <a href="edit_event.php?id=<?php echo $e['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete_event.php?id=<?php echo $e['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </table>
    </div>
  </div>
</div>
<?php include "../footer.php"; ?>
