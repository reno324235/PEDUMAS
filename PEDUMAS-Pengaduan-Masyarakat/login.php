<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" integrity="..." crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            width: 40%;
            margin: 0 auto;
            margin-top: 10%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #3498db;
        }

        form {
            margin-top: 20px;
        }

        .input_field {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            height: 40px;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 100%;
            background-color: #27ae60;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218c54;
        }

        .error-message {
            color: #e74c3c;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h3 class="display-4 text-center mb-4" style="color: #3498db; font-family: 'Arial', sans-serif;">
            <i class="fal fa-sign-in-alt"></i> Login
        </h3>
        <form method="POST">
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
            <button type="submit" name="login" class="btn btn-success">
                <i class="fal fa-sign-in-alt"></i> Login
            </button>
        </form>
         <?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			header('location:masyarakat/');
		}
		elseif($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:petugas/');
			}
		}
		else{
			echo "<script>alert('Gagal Login Sob')</script>";
		}

	}
 ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
