<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Qn/TzcLZF5qJeRz3y6kjU5O9TzC1Lu9ubjwu5e6cqrnSo7pTkPnSBfPj40qW4F6t1fy+YhVQ7KfCWaS7jWVlgQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title> Halaman Utama</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" integrity="..." crossorigin="anonymous">
  <style>
    .btn-color {
      background-color: #0e1c36;
      color: #fff;

    }

    .profile-image-pic {
      height: 200px;
      width: 200px;
      object-fit: cover;
    }



    .cardbody-color {
      background-color: #ebf2fa;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card my-5">

        <form method="POST" class="card-body cardbody-color p-lg-5">
          <div class="text-center">
            <img src="https://e0.pxfuel.com/wallpapers/117/529/desktop-wallpaper-amazing-diversity-indonesia-culture-in-garuda-silhouete-stock-vector-batik-art-silhouette-illustration-indonesian-art-multicultural.jpg" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
          </div>

          <div class="mb-3 input_field">
            <label for="username" class="form-label">
              <i class="fal fa-user"></i> Username
            </label>
            <input id="username" type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3 input_field">
            <label for="password" class="form-label">
              <i class="fal fa-lock"></i> Password
            </label>
            <input id="password" type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" name="login" class="btn btn-color px-5 mb-5 w-100">Login</button>
          <div style="display: flex; align-items: center;">
            <a href="registrasi.php" style="text-decoration: none; color: inherit; margin-right: 10px;">Tidak punya akun? Silahkan registrasi.</a>
          </div>


        </form>
        <?php
        include "conn/koneksi.php";
        if (isset($_POST['login'])) {
          $username = mysqli_real_escape_string($koneksi, $_POST['username']);
          $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

          $sql = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
          $cek = mysqli_num_rows($sql);
          $data = mysqli_fetch_assoc($sql);

          $sql2 = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
          $cek2 = mysqli_num_rows($sql2);
          $data2 = mysqli_fetch_assoc($sql2);

          if ($cek > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['data'] = $data;
            $_SESSION['level'] = 'masyarakat';
            header('location:masyarakat/');
          } elseif ($cek2 > 0) {
            if ($data2['level'] == "admin") {
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['data'] = $data2;
              header('location:admin/');
            } elseif ($data2['level'] == "petugas") {
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['data'] = $data2;
              header('location:petugas/');
            }
          } else {
            echo "<script>alert('Gagal Login Sob')</script>";
          }
        }
        ?>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>