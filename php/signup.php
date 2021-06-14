<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="icon.png">
  </head>
  <body>

    <div class="wrapper fadeInDown">
  <div id="formContent">

    <!-- Tabs Titles -->
    <h2 class="inactive underlineHover"><a href="login.php">Sign In </a></h2>
    <h2 class="active"> Sign Up </h2>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="text" id="login" class="fadeIn second" placeholder="name" name="name">
      <input type="email" id="email" class="fadeIn third" placeholder="email" name="email">
      <input type="password" id="password1" class="fadeIn third" placeholder="password" name="password1">
      <input type="password" id="password2" class="fadeIn third" placeholder="password" name="password2">
      <input type="submit" class="fadeIn fourth" value="Sign Up" name="btn">
    </form>

  </div>
</div>

  </body>
</html>

<?php

include('connectionLogin.php');

      if(isset($_POST['btn'])){
        if($_POST['name'] != '' && $_POST['email'] != '' && $_POST['password1'] != '' && $_POST['password2'] != '' && $_POST['password1'] == $_POST['password2']){
          $name = $_POST['name'];
          $email = $_POST['email'];
          $password1 = $_POST['password1'];


          $sql = "select name from USER where name = '$name'";
          $resultName = $conn->query($sql);

        if ($resultName->num_rows > 0) {
          echo "name already exists!";
        } else {

          $sql = "select email from USER where email = '$email'";
          $resultEmail = $conn->query($sql);

          if ($resultEmail->num_rows > 0) {
            echo "email already exists!";
          } else {

            $name = htmlspecialchars($name);
            $password1 = htmlspecialchars($password1);
            $email = htmlspecialchars($email);

          $dpassword = base64_encode($password1);
          $demail = base64_encode($email);

          include('regex.php');

          if((preg_match($regex, $name)==1) and (preg_match($regex, $password1)==1) and (preg_match($regex, $email)==1)){
            echo "";
          }
          else{

          $sql = "INSERT INTO USER (name, email, password)
          VALUES ('$name', '$demail', '$dpassword')";

          if ($conn->query($sql) === TRUE) {
            echo "Signup successful!";
            header("Location: login.php");
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

          $conn->close();
        }
        }
          }
        }
        else{
          echo "Error";
        }
      }
     ?>
