<?php
session_start();

require_once "function.php";
if (isset($_SESSION['login'])) {
  header("Location: ../index.php");
  exit;
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    // cek password
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = $username;
      header("Location:../dashboard/index.php");
      exit;
    }
  }
  $error  = true;
?>

<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>The King - Login</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="../_assets/css/bootstrap.min.css">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
  <script src="../_assets/js/bootstrap.min.js"></script>

</head>

<body class=" bg-gradient-primary">

  <div class="container" style="padding-top: 10%; padding-left: 1%; width: 50%;">

    <!-- Outer Row -->
    <!-- <div class="row justify-content-center">

      <div class="col-lg-5"> -->

    <div class="row">
      <div class="col-lg-10 offset-1">
        <div class="card o-hidden border-0 shadow-lg bg-gradient-light">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">selamat datang admin!</h1>
                  </div>
                  <?php if (isset($error)) : ?>
                    <p style="color : red; font-style:italic">
                      username / password salah
                    </p>
                  <?php endif; ?>
                  <form class="user" action="" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan username anda..." required="" autofocus>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" required placeholder="Masukkan password anda">
                    </div>
                    <div class="text-center">
                      <input type="submit" name="login" class="btn btn-user btn-primary btn-block" value="login"></input>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body><br><br><br><br><br><br><br><br>

<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>