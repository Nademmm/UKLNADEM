<?php
session_start();
include 'connect.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
        $username = $_POST["username"];
        $password = $_POST["pswd"];

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username'], 'pp_user' => $user['pp_user']];
                if ($user['username'] === 'admin') {
                    header("Location: /MY_NUSANTARA/admin/admin.php");
                } else {
                    header("Location: index1.php");
                }
                exit;
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Akun tidak di temukan.";
        }
    } elseif (isset($_POST['form_type']) && $_POST['form_type'] === 'signup') {
        $username = $_POST["txt"];
        $password = password_hash($_POST["pswd"], PASSWORD_DEFAULT);

        $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username sudah terdaftar.";
        } else {
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($conn, $query)) {
                $success = "Pendaftaran berhasil. Silakan klik login.";
            } else {
                $error = "Terjadi kesalahan saat mendaftar.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet" />
    <title>Login Pengguna</title>
    <link rel="stylesheet" href="/MY_NUSANTARA/css/newlogin.css" />
  </head>
  <body>
    <div class="main">
      <input type="checkbox" id="chk" aria-hidden="true" />
      <div class="signup">
        <form method="POST" action="">
          <input type="hidden" name="form_type" value="signup" />
          <label for="chk" aria-hidden="true">Daftar</label>
          <input type="text" name="txt" placeholder="Username" required />  
          <input type="password" name="pswd" placeholder="Password" required />
          <button type="submit">Daftar</button>
          <?php if ($success): ?>
          <p class="success" style="color: black; text-align: center; margin-top: 10px;"><?= $success ?></p>
          <?php endif; ?>
          <?php if ($error): ?>
          <p class="error" style="color: red; text-align: center; margin-top: 10px;"><?= $error ?></p>
          <?php endif; ?>
          <a href="index1.php" class="buy-button" style="margin-top:0.5em;">Kembali</a>
        </form>
      </div> 
  
      <div class="login"> 
        <form method="POST" action="">
          <input type="hidden" name="form_type" value="login" />
          <label for="chk" aria-hidden="true">Login</label>
          <input type="text" name="username" placeholder="Username" required />
          <input type="password" name="pswd" placeholder="Password" required />
          <button type="submit">Login</button>
        </form>
        
        
      </div>
    </div>
  </body>
</html>
