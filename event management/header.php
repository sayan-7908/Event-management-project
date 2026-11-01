<?php
// Shared top part of every page. Set $base = "../" and $is_admin = true on admin pages.
if (!isset($base)) { $base = ""; }
if (!isset($is_admin)) { $is_admin = false; }
if (!isset($page_title)) { $page_title = "SKF Events"; }

// Pick a badge color for each category
function badge_color($cat) {
    if ($cat == "Technical") return "bg-primary";
    if ($cat == "Cultural") return "bg-danger";
    if ($cat == "Sports") return "bg-success";
    if ($cat == "Academic") return "bg-info text-dark";
    return "bg-secondary";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Poppins', sans-serif; background: #f3eefe; }
  .grad { background: linear-gradient(90deg, #7b2ff7, #f107a3); }
  .hero { background: linear-gradient(135deg, #7b2ff7, #f107a3); color: white; padding: 70px 0; }
  .card { border: 0; border-radius: 20px; box-shadow: 0 4px 14px rgba(123,47,247,0.15); }
  .btn-accent { background: #ff8a00; color: white; border: 0; border-radius: 30px; font-weight: 600; }
  .btn-accent:hover { background: #e67a00; color: white; }
  .badge { border-radius: 20px; }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark grad">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo $base; ?><?php echo $is_admin ? 'index.php' : 'index.php'; ?>">
      <img src="https://skf.edu.in/images/skf-newlogo-new1.jpg" height="40" class="me-2 rounded" alt="logo">
      SKF Events
      <?php if ($is_admin) { ?><span class="badge bg-warning text-dark ms-2">Admin</span><?php } ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <?php if ($is_admin) { ?>
          <?php if (isset($_SESSION['admin'])) { ?>
            <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="add_event.php">Add Event</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php } ?>
          <li class="nav-item"><a class="nav-link" href="../index.php">Student Site</a></li>
        <?php } else { ?>
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <?php if (isset($_SESSION['user_id'])) { ?>
            <li class="nav-item"><a class="nav-link" href="my_events.php">My Events</a></li>
            <li class="nav-item"><span class="nav-link text-warning">Hi, <?php echo $_SESSION['user_name']; ?></span></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php } else { ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
          <?php } ?>
          <li class="nav-item"><a class="nav-link" href="admin/login.php">Admin</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
