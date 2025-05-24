<?php
$host = 'db';
$db   = 'ctf';
$user = 'user';
$pass = 'pass';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$message = '';
$query_display = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Membentuk query yang rawan SQL Injection
        $sql = "SELECT username, password FROM users WHERE username='$username' AND password='$password'";
        $query_display = $sql;

        $result = $mysqli->query($sql);
        if ($result && $result->num_rows > 0) {
            $rs = $result->fetch_all();
            $message = 'Login Berhasil: ' . $rs[0][0];
            $alertType = 'success';

            $flag = getenv('FLAG') ?: 'FLAG_NOT_SET';
            $message .= "<br><strong>FLAG:</strong> {$flag}";
            
        } else {
            $message = 'Login Gagal';
            $alertType = 'danger';
        }
    } catch (Exception $e) {
        $message = 'Query Error';
        $alertType = 'warning';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>System Login</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="card shadow-sm">
          <div class="card-header text-center">
            <h3>System Login</h3>
          </div>
          <div class="card-body">

            <?php if ($message): ?>
              <div class="alert alert-<?= htmlspecialchars($alertType) ?>">
                <?= $message ?></div>
            <?php endif; ?>

            <form method="post" autocomplete="off">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" 
                       class="form-control" 
                       id="username" 
                       name="username" 
                       required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password">
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <hr>

            <h6>Generated Query</h6>
            <pre class="bg-light p-2 border"><?= htmlspecialchars($query_display ?: '—') ?></pre>

          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Bootstrap 5 JS Bundle (optional for components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
