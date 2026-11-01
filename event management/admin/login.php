<?php
include "../db.php";
$error = "";
if (isset($_POST['username'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$u' AND password = '$p'");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin'] = $u;
        header("Location: index.php");
        exit;
    }
    $error = "Wrong username or password.";
}
$base = "../"; $is_admin = true; $page_title = "Admin Login";
include "../header.php";
?>
<div class="container mt-5" style="max-width:450px">
  <div class="card p-4">
    <h3 class="fw-bold mb-3">Admin Login</h3>
    <?php if ($error != "") { ?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
    <form method="post">
      <input class="form-control mb-3" name="username" placeholder="Username" required>
      <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
      <button class="btn btn-accent w-100">Login</button>
    </form>
  </div>
</div>
<?php include "../footer.php"; ?>
