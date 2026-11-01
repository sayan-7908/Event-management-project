<?php
include "db.php";
$page_title = "Register";
$error = "";

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $roll = $_POST['roll_no'];
    $dept = $_POST['department'];
    $sem = $_POST['semester'];
    $pass = $_POST['password'];

    // roll number must be unique
    $check = mysqli_query($conn, "SELECT * FROM users WHERE roll_no = '$roll'");
    if (mysqli_num_rows($check) > 0) {
        $error = "This roll number is already registered.";
    } else {
        mysqli_query($conn, "INSERT INTO users (name, roll_no, department, semester, password) VALUES ('$name', '$roll', '$dept', $sem, '$pass')");
        header("Location: login.php?msg=Registered. Please login.");
        exit;
    }
}
include "header.php";
?>
<div class="container mt-5" style="max-width:500px">
  <div class="card p-4">
    <h3 class="fw-bold mb-3">Student Register</h3>
    <?php if ($error != "") { ?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
    <form method="post">
      <input class="form-control mb-3" name="name" placeholder="Full name" required>
      <input class="form-control mb-3" name="roll_no" placeholder="Roll number" required>
      <select class="form-select mb-3" name="department">
        <option>BCA</option><option>BBA</option><option>BSc</option>
      </select>
      <select class="form-select mb-3" name="semester">
        <?php for ($i = 1; $i <= 8; $i++) { echo "<option value='$i'>Semester $i</option>"; } ?>
      </select>
      <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
      <button class="btn btn-accent w-100">Register</button>
    </form>
  </div>
</div>
<?php include "footer.php"; ?>
