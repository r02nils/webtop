<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="icon.png">
  </head>
  <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active">Change Password</h2>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="text" id="login" class="fadeIn second" placeholder="name" name="name">
      <input type="password" id="password1" class="fadeIn third" placeholder="password" name="password1">
      <input type="password" id="password2" class="fadeIn third" placeholder="new password" name="newpassword1">
      <input type="password" id="password3" class="fadeIn third" placeholder="new password" name="newpassword2">
      <input type="submit" class="fadeIn fourth" value="Change Password!" name="btn">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="index.php">Back to chat!</a>
    </div>

  </div>
</div>
  </body>
</html>

<?php

session_start();

include('isLogedIn.php');
include('connectionLogin.php');

  if (isset($_POST['btn'])) {
    $password1 = $_POST['password1'];
    $newpassword1 = $_POST['newpassword1'];
    $newpassword2 = $_POST['newpassword2'];

    $newpassword1 = htmlspecialchars($newpassword1);

    $dpassword = base64_encode($password1);
    $dpassword1 = base64_encode($newpassword1);
    $dpassword2 = base64_encode($newpassword1);
    $demail = base64_encode($email);

    $dpassword1 = htmlspecialchars($dpassword1);

    if ($password1 == $_SESSION['cookiepassword'] && $newpassword1 == $newpassword2) {

      $namec = $_SESSION['cookiename'];
      $sql = "select name from USER where name = '$namec'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        include('regex.php');

        if(preg_match($regex, $dpassword1) == 1){
          echo "Error";
        }
        else{
        $sql = "update USER set password = '$dpassword1' where name = '$namec'";

        if ($conn->query($sql) === TRUE) {
          echo "New Password successful!";
          $_SESSION['cookiepassword'] = $newpassword1;
          header("Location: ../index.php");
        } else {
          echo "Error";
        }
      }
      }
      else{
      }
    }
    else{
      echo "Error";
    }
  }
 ?>
