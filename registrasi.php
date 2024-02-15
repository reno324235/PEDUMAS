<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Registrasi Pengguna Baru</h2>
        <form method="POST" action="proses_registrasi.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" id="nik" name="nik" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="telp">Nomor Telepon:</label>
                <input type="tel" id="telp" name="telp" class="form-control" required>
            </div>

            <button type="submit" name="register" class="btn btn-primary btn-block mt-4">Daftar</button>
        </form>
    </div>
    <?php
    include 'conn/koneksi.php'; 
    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));
        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']); 
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']); 
        $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

        
        
       
        $query = mysqli_query($koneksi, "INSERT INTO masyarakat (username, password, nik, nama, telp) VALUES ('$username', '$password','$nik', '$nama', '$telp')"); // Menambahkan variabel $nik, $nama, dan $telp

        if ($query) {
            echo "<script>alert('Registrasi berhasil!')</script>";
         
            header('location:login.php');
            exit; 
        } else {
            echo "<script>alert('Registrasi gagal!')</script>";
        }
    }
?>

    
</body>

</html>