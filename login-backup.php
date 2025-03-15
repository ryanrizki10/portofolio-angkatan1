<?php
require_once "koneksi.php";
session_start();
session_regenerate_id();
//INDEX DIMULAI DARI 0
// $mobil = ["Toyota", "BMW", "SUZUKI"];

// echo $mobil[2];

if (isset($_POST["login-yuk"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $q_login = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  if (mysqli_num_rows($q_login) > 0) {
    $user = mysqli_fetch_assoc($q_login);
    if ($email == $user['email'] && $password == $user['password']) {
      $_SESSION["EMAILLLLLL"] = $user['email'];;
      $_SESSION["USERNAME"] = $user['username'];
      header("Location: dashboard.php");
    } else {
      header("Location: login.php");
    }
  }



  // echo $email . "<br>";
  // echo $password;

  // if (isset($users[$email]) && $users[$email] === $password) {
  //   $_SESSION["EMAILLLLLL"] = $email;
  //   header("Location: dashboard.php");
  // } else {
  //   header("Location: login.php");
  // }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
</head>

<body>
  <div class="container">
    <div class="row mt-4">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="card">
          <div class="card-header text-center">LOGIN</div>
          <div class="card-body">
            <form action="" method="POST" onsubmit="return validasi()">
              <div class="mt-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" />
                <span id="emailError" class="text-danger" style="display: none">Email Tidak Valid!</span>
              </div>
              <div class="mt-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
                <span id="passwordError" class="text-danger" style="display: none">Password harus terdiri dari 8 karakter, termasuk satu huruf besar, satu huruf kecil, satu angka, dan satu karakter khusus.</span>
              </div>
              <div class="mt-2 text-end">
                <button type="submit" name="login-yuk" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function validasi() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;
      var emailError = document.getElementById("emailError");
      var passwordError = document.getElementById("passwordError");
      var isValid = true;
      var emailReg = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      var passReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;
      if (emailReg.test(email)) {
        // console.log("Valid Email address");
        emailError.style.display = "none";
      } else if (!emailReg.test(email)) {
        // console.log("Invalid Email address");
        emailError.style.display = "block";
        isValid = false;
      }
      if (passReg.test(password)) {
        passwordError.style.display = "none";
      } else if (!passReg.test(password)) {
        passwordError.style.display = "block";
        isValid = false;
      }
      return isValid;
      // console.log(passReg.test(password));
    }
  </script>
</body>

</html>