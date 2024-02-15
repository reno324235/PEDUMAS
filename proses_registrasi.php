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