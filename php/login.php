<!DOCTYPE html>
<?php
// Start the session
session_start();

$_SESSION["cookiename"] = "";
$_SESSION["cookiepassword"] = "";
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <h2 class="inactive underlineHover"><a href="signup.php">Sign Up </a></h2>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="text" id="login" class="fadeIn second" placeholder="name" name="name">
      <input type="password" id="password" class="fadeIn third" placeholder="password" name="myPassword">
      <input type="submit" class="fadeIn fourth" value="Log In" name="btn">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="sendEmail.php">Forgot Password?</a>
    </div>

  </div>
</div>

  </body>
</html>

<?php

include('connectionLogin.php');

if (isset($_POST['btn'])) {
  if ($_POST['name'] != '' && $_POST['myPassword'] != '') {

    $myPassword = $_POST['myPassword'];
    $name = $_POST['name'];

    $dpassword = base64_encode($myPassword);
    $demail = base64_encode($email);

    $sql = "select name, password from USER where name = '$name' AND password = '$dpassword'";
    $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "Login successful!";

    session_start();

    $_SESSION["cookiename"] = $name;
    $_SESSION["cookiepassword"] = $myPassword;

	  $sql3 = "update USER set status = 'online' where name = '$name'";

          if ($conn->query($sql3) === TRUE) {
            echo "online!";
          } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
          }

	  header("Location: ../index.php");

}
else{
  echo "Error";
}
$conn->close();
}
}
 ?>
