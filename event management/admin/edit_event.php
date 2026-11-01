<?php
include "../db.php";
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

$id = $_GET['id'];
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $venue = $_POST['venue'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $seats = $_POST['seats'];
    $cat = $_POST['category'];
    mysqli_query($conn, "UPDATE events SET title='$title', description='$desc', venue='$venue', event_date='$date', event_time='$time', seats=$seats, category='$cat' WHERE id=$id");
    header("Location: index.php");
    exit;
}
$e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events WHERE id = $id"));
$base = "../"; $is_admin = true; $page_title = "Edit Event";
include "../header.php";
$cats = array("Technical", "Cultural", "Sports", "Academic");
?>
<div class="container mt-5" style="max-width:650px">
  <div class="card p-4">
    <h3 class="fw-bold mb-3">Edit Event</h3>
    <form method="post">
      <input class="form-control mb-3" name="title" value="<?php echo $e['title']; ?>" required>
      <textarea class="form-control mb-3" name="description" rows="3"><?php echo $e['description']; ?></textarea>
      <input class="form-control mb-3" name="venue" value="<?php echo $e['venue']; ?>" required>
      <input class="form-control mb-3" type="date" name="event_date" value="<?php echo $e['event_date']; ?>" required>
      <input class="form-control mb-3" type="text" placeholder="e.g. 10:00 AM" name="event_time" value="<?php echo $e['event_time']; ?>" required>
      <input class="form-control mb-3" type="number" name="seats" value="<?php echo $e['seats']; ?>" required>
      <select class="form-select mb-3" name="category">
        <?php foreach ($cats as $c) {
            $sel = ($c == $e['category']) ? "selected" : "";
            echo "<option $sel>$c</option>";
        } ?>
      </select>
      <button class="btn btn-accent">Update Event</button>
      <a href="index.php" class="btn btn-light">Back</a>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
