<?php
require_once 'config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = 'All fields are required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        // Check duplicates
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1');
        $stmt->execute([':u' => $username, ':e' => $email]);
        if ($stmt->fetch()) {
            $errors[] = 'Username or email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $pdo->prepare('INSERT INTO users (username, email, password_hash) VALUES (:u, :e, :p)');
            $ins->execute([':u' => $username, ':e' => $email, ':p' => $hash]);
            $success = 'Registration successful. You can now log in.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - Clock App</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2>Create Account</h2>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $e) { echo htmlspecialchars($e) . '<br>'; } ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" action="register.php" autocomplete="off">
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="bentali" required />
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="you@example.com" required />
      </div>

      <div class="form-group">
        <label>Password (min 6 chars)</label>
        <input type="password" name="password" required />
      </div>

      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required />
      </div>

      <button type="submit">Register</button>
    </form>

    <div class="alt">
      Already have an account? <a class="btn-link" href="login.php">Log in</a>
    </div>
  </div>
</body>
</html>
