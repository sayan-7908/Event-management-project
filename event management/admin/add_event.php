<?php
include "../db.php";
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $venue = $_POST['venue'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $seats = $_POST['seats'];
    $cat = $_POST['category'];
    mysqli_query($conn, "INSERT INTO events (title, description, venue, event_date, event_time, seats, category) VALUES ('$title', '$desc', '$venue', '$date', '$time', $seats, '$cat')");
    header("Location: index.php");
    exit;
}
$base = "../"; $is_admin = true; $page_title = "Add Event";
include "../header.php";
?>
<div class="container mt-5" style="max-width:650px">
  <div class="card p-4">
    <h3 class="fw-bold mb-3">Add Event</h3>
    <form method="post">
      <input class="form-control mb-3" name="title" placeholder="Title" required>
      <textarea class="form-control mb-3" name="description" placeholder="Description" rows="3"></textarea>
      <input class="form-control mb-3" name="venue" placeholder="Venue" required>
      <input class="form-control mb-3" type="date" name="event_date" required>
      <input class="form-control mb-3" type="text" placeholder="e.g. 10:00 AM" name="event_time" required>
      <input class="form-control mb-3" type="number" name="seats" placeholder="Seats" required>
      <select class="form-select mb-3" name="category">
        <option>Technical</option><option>Cultural</option><option>Sports</option><option>Academic</option>
      </select>
      <button class="btn btn-accent">Save Event</button>
      <a href="index.php" class="btn btn-light">Back</a>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
