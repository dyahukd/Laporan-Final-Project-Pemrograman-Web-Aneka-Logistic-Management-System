<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {

  $email    = trim($_POST['email']);
  $password = trim($_POST['password']);

  // ambil user berdasarkan email
  $stmt = $conn->prepare(
    "SELECT id, name, email, password, role 
     FROM users 
     WHERE email = ? AND is_active = 1
     LIMIT 1"
  );

  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result();
  $user   = $result->fetch_assoc();

  // verifikasi password
  if ($user && password_verify($password, $user['password'])) {

    // simpan session
    $_SESSION['login']   = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];
    $_SESSION['email']   = $user['email'];
    $_SESSION['role']    = $user['role'];

    // redirect sesuai role
    if ($user['role'] === 'superadmin') {
      header("Location: dashboard_superadmin.php");
    } elseif ($user['role'] === 'admin') {
      header("Location: dashboard_admin.php");
    } else {
      header("Location: dashboard_customer.php");
    }
    exit;

  } else {
    $error = "Email atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Aneka Logistic</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f4f4;
    }
    .login-card {
      border-radius: 18px;
    }
  </style>
</head>
<body class="d-flex align-items-center" style="min-height:100vh;">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card login-card shadow p-4">

        <h3 class="fw-bold mb-1">Login</h3>
        <p class="text-muted mb-4">Aneka Logistic Management System</p>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input 
              type="email" 
              name="email" 
              class="form-control" 
              placeholder="email@example.com"
              required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input 
              type="password" 
              name="password" 
              class="form-control" 
              required>
          </div>

          <button type="submit" name="login" class="btn btn-danger w-100">
            Login
          </button>

          <div class="text-center mt-3">
            Belum punya akun? <a href="register.php">Register</a>
          </div>

          <div class="text-center mt-2">
            <a href="index.php">← Kembali ke Landing Page</a>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
