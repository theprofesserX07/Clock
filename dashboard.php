<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
$username = $_SESSION['username'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - Clock App</title>
  <link rel="stylesheet" href="style.css" />
  <script defer src="script.js"></script>
</head>
<body>
  <div class="container">
    <div class="header">
      <div>Logged in as: <?php echo htmlspecialchars($username); ?></div>
      <div><a class="btn-link" href="logout.php" style="color:#fca5a5;">Logout</a></div>
    </div>

    <h2>Your Clock</h2>

    <div class="clock-wrap">
      <div id="greeting" class="greeting">...</div>
      <div id="time" class="time">--:--:--</div>
      <div class="controls">
        <a class="btn-link" href="logout.php"><button class="logout" type="button">Log out</button></a>
      </div>
    </div>
  </div>
</body>
</html>
