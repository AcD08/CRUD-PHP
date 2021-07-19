<?php 

    require 'functions.php';

    if (isset($_POST["register"])) {
        if (regist($_POST) > 0) {
            echo "
            <script>
                alert ('berhasil registrasi!');
            </script>
            ";
        } else {
            echo mysqli_error($DB);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Web</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c532509691.js" crossorigin="anonymous"></script>
</head>
<body>


<div class="container">
<form action="" method="post">
    <legend>Register Page</legend>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="password2" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="password2" name="password2">
  </div>
  <button type="submit" class="btn btn-primary" name="register">Register!</button>
  <a class="btn btn-danger" href="login.php" role="button">Login Page</a>
</form>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>