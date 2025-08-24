<?php
require_once 'config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username_email'] ?? '');
    $password        = $_POST['password'] ?? '';

    if ($usernameOrEmail === '' || $password === '') {
        $errors[] = 'Please enter username/email and password.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, email, password_hash FROM users WHERE username = :ue OR email = :ue LIMIT 1');
        $stmt->execute([':ue' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $errors[] = 'Invalid credentials.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - Clock App</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Welcome Back</h2>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $e) { echo htmlspecialchars($e) . '<br>'; } ?>
      </div>
    <?php endif; ?>

    <form method="post" action="login.php" autocomplete="off">
      <div class="form-group">
        <label>Username or Email</label>
        <input type="text" name="username_email" placeholder="bentali or you@example.com" required />
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required />
      </div>

      <button type="submit">Log In</button>
    </form>

    <div class="alt">
      New here? <a class="btn-link" href="register.php">Create an account</a>
    </div>
  </div>
</body>
</html>
