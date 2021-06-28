<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Change Name</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="icon.png">
  </head>
  <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active">Change Name</h2>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="text" id="name" class="fadeIn second" placeholder="name" name="name">
      <input type="submit" class="fadeIn fourth" value="change Name!" name="btn">
    </form>

  </div>
</div>
  </body>
</html>
<?php

session_start();


include('isLogedIn.php');
include('connectionLogin.php');

if(isset($_POST['btn'])){
  $name = $_POST['name'];
  $n = $_SESSION['cookiename'];
  if($name != ''){

    $name = htmlspecialchars($name);

    $sql = "select * from USER where name = '$n'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      include('regex.php');

      if(preg_match($regex, $name)==1){
        echo "Error";
      }
      else{
        $sqlname = "select name from USER where name = '$name'";
        $resultName = $conn->query($sqlname);

      if ($resultName->num_rows > 0) {
        echo "name already exists!";
      } else {

      $sql = "update USER set name = '$name' where name = '$n'";

      if ($conn->query($sql) === TRUE) {
        $_SESSION['cookiename'] = $name;
      } else {
        echo "Error";
      }

      $sql = "update Item set user = '$name' where name = '$n'";

      if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error";
      }
      header("Location: ../index.php");
    }
    }
    }
  }
  else{
    echo "Error";
  }

}
else{
    echo "Error";
  }

 ?>
