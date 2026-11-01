<?php
include "db.php";
$page_title = "Login";
$error = "";

if (isset($_POST['roll_no'])) {
    $roll = $_POST['roll_no'];
    $pass = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE roll_no = '$roll' AND password = '$pass'");
    if (mysqli_num_rows($result) == 1) {
        $u = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['user_name'] = $u['name'];
        header("Location: index.php");
        exit;
    }
    $error = "Wrong roll number or password.";
}
include "header.php";
?>
<div class="container mt-5" style="max-width:450px">
  <div class="card p-4">
    <h3 class="fw-bold mb-3">Student Login</h3>
    <?php if (isset($_GET['msg'])) { ?><div class="alert alert-success"><?php echo $_GET['msg']; ?></div><?php } ?>
    <?php if ($error != "") { ?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
    <form method="post">
      <input class="form-control mb-3" name="roll_no" placeholder="Roll number" required>
      <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
      <button class="btn btn-accent w-100">Login</button>
    </form>
    <p class="mt-3 mb-0">New here? <a href="register.php">Register</a></p>
  </div>
</div>
<?php include "footer.php"; ?>
