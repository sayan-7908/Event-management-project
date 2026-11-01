<?php
include "../db.php";
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
$base = "../"; $is_admin = true; $page_title = "Participants";
include "../header.php";

$id = $_GET['id'];
$e = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM events WHERE id = $id"));
$result = mysqli_query($conn, "SELECT users.name, users.roll_no, users.department, users.semester, participants.registered_on FROM participants JOIN users ON participants.user_id = users.id WHERE participants.event_id = $id");
?>
<div class="container mt-5">
  <div class="card p-4">
    <h3 class="fw-bold">Participants: <?php echo $e['title']; ?></h3>
    <p class="text-muted">Total: <?php echo mysqli_num_rows($result); ?> of <?php echo $e['seats']; ?> seats</p>
    <table class="table">
      <tr><th>Name</th><th>Roll No</th><th>Department</th><th>Semester</th><th>Registered On</th></tr>
      <?php while ($p = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $p['name']; ?></td>
        <td><?php echo $p['roll_no']; ?></td>
        <td><?php echo $p['department']; ?></td>
        <td><?php echo $p['semester']; ?></td>
        <td><?php echo $p['registered_on']; ?></td>
      </tr>
      <?php } ?>
    </table>
    <a href="index.php" class="btn btn-light align-self-start">Back</a>
  </div>
</div>
<?php include "../footer.php"; ?>
