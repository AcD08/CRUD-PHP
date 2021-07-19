<?php 
    require 'functions.php';

    if (isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }


    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        // cek username
        $checkUserName = mysqli_query($DB, "SELECT * FROM master_users where username = '$username'");
        // cek password
        if (mysqli_num_rows($checkUserName) === 1) {
            $checkPassword = mysqli_fetch_assoc($checkUserName);
            if(password_verify($password, $checkPassword["password"])) {
                echo "
                <script>
                    alert ('berhasil login!');
                    document.location.href = 'index.php';
                </script>
            ";
            }
        }
        $error = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Web</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<?php if ( isset($error) ) : ?>
    <p style="color: red; font-style: italic;">username atau password salah!</p>
<?php endif; ?>

<div class="container">
<form action="" method="post">
    <legend>Login Page</legend>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <!-- <?php 
  $cekPassword = password_verify('123', '$2y$10$JAKNEtU2PXB0gZ67kuX1oOvCnrRUa4U7wPN/GNp6Cbn');
  var_dump($cekPassword);
  ?> -->
  <button type="submit" class="btn btn-primary" name="login" id="login">Login</button>
  <a class="btn btn-danger" href="registrasi.php" role="button">Register</a>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>