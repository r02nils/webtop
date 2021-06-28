<?php include("php/isLogedIn.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/desktop.css">
    <meta name='viewport'
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0,
     user-scalable=0' >
    <title>Webtop</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon"
      type="image/png"
      href="img/Webtop.png">
  </head>
  <body>
    <script src="js/bg.js"></script>
      <?php include("html/displayItems.html"); ?>
      <?php include("php/bg.php"); ?>
    <div class="bar">
      <div class="barItem">
        <button id="myBtn" class="addBtn"><img src="img/add.png" alt="" height="50px" width="50px"></button>
      </div>
      <div class="barItem" onclick="settings()">
        <p>Settings</p>
      </div>
      <div class="barItem" onclick="openNav()">
        <p3><?php session_start(); echo $_SESSION['cookiename'];?><p3>
      </div>
      <div class="barItem">
        <p3 id="location"><p3>
      </div>
      <div class="barItem">
        <p3 id="t"></p3>
      </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
    <div class="modal-content">
      <form class="add" target="frame" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
          <tr>
            <td><label for="name">Name</label></td>
            <td><input id="name" type="text" name="name" value=""></td>
          </tr>
          <tr>
            <td><label for="url">URL</label></td>
            <td><input id="url" type="text" name="url" value=""></td>
          </tr>
          <tr>
            <td><label for="img">Img *</label></td>
            <td><input id="img" type="text" name="img" value=""></td>
          </tr>
          <tr>
            <td><input id="btn" type="submit" name="btn" value="submit"></td>
          </tr>
        </table>
      </form>
      <div class="close"></div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div id="myDelModal" class="delmodal">
  <div class="delmodal-content">
    <form class="deladd" target="frame" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <table>
        <tr>
          <td>Remove Link?</td>
          <td><label for="id" hidden>id</label></td>
          <td><input id="id" type="text" name="id" value="" hidden></td>
        </tr>
        <tr>
          <td><input id="delbtn" type="submit" name="delbtn" value="remove"></td>
        </tr>
      </table>
    </form>
    <div class="close"></div>
  </div>
</div>

<!-- Edit Modal -->
<div id="myEdModal" class="edmodal">
<div class="edmodal-content">
  <form class="edadd" target="frame" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
      <tr>
        <td><label for="edid" hidden>id</label></td>
        <td><input id="edid" type="text" name="edid" value="" hidden></td>
      </tr>
      <tr>
        <td><label for="edName">Name</label></td>
        <td><input id="edName" type="text" name="edName" value=""></td>
      </tr>
      <tr>
        <td><label for="edUrl">Url</label></td>
        <td><input id="edUrl" type="text" name="edUrl" value=""></td>
      </tr>
      <tr>
        <td><label for="edImg">Img</label></td>
        <td><input id="edImg" type="text" name="edImg" value=""></td>
      </tr>
      <tr>
        <td><input id="edbtn" type="submit" name="edbtn" value="change"></td>
      </tr>
    </table>
  </form>
  <div class="close"></div>
</div>
</div>

<!-- Settings Modal -->
<div id="mySeModal" class="semodal">
<div class="semodal-content">
  <form class="seadd" target="frame" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table>
      <tr>
        <td><label for="seImg">Background-Image</label></td>
        <td><input id="seImg" type="text" name="seImg" value=""></td>
      </tr>
      <tr>
        <td><input id="sebtn" type="submit" name="sebtn" value="change"></td>
      </tr>
      <a href="php/changeName.php">change name</a><br>
      <a href="php/changePassword.php">change password</a><br>
      <a href="php/signoff.php">sign off</a><br>
    </table>
  </form>
  <div class="close"></div>
</div>
</div>

<form class="swapForm" target="frame" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" hidden>
  <input id="swicon1" type="text" name="swicon1" value="">
  <input id="swicon2" type="text" name="swicon2" value="">
  <input id="swname1" type="text" name="swname1" value="">
  <input id="swname2" type="text" name="swname2" value="">
  <input id="swurl1" type="text" name="swurl1" value="">
  <input id="swurl2" type="text" name="swurl2" value="">
  <input id="swimg1" type="text" name="swimg1" value="">
  <input id="swimg2" type="text" name="swimg2" value="">
  <input id="swbtn" type="submit" name="swbtn" value="">
</form>

</div>

  <script src="js/script.js"></script>
    <?php

    if(isset($_POST['btn'])){

      include("php/connection.php");

      $nameItem = $_POST['name'];
      $urlItem = $_POST['url'];
      $imgItem = $_POST['img'];

      if($imgItem == ""){
        $imgItem = "-";
      }

      session_start();
      $name = $_SESSION['cookiename'];
      $nameItem = htmlspecialchars($nameItem);
      $urlItem = htmlspecialchars($urlItem);
      $imgItem = htmlspecialchars($imgItem);

      if($nameItem != "" and $urlItem != "" and $imgItem != ""){
        include('php/regex.php');

      if((preg_match($regex, $nameItem) == 1) and (preg_match($regex, $urlItem) == 1)){
        echo "Error";
      }
      else{
        $sql = "INSERT INTO Item (user, name, url, img)
        VALUES ('$name', '$nameItem', '$urlItem', '$imgItem')";

        if ($conn->query($sql) === TRUE) {
        } else {
          echo "Error";
        }
      }
    }
  }


  if(isset($_POST['delbtn'])){

    include("php/connection.php");

    $id = $_POST['id'];

    session_start();
    $name = $_SESSION['cookiename'];

    $sql = "delete from Item where id = '$id'";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    }

    if(isset($_POST['edbtn'])){

      include("php/connection.php");

      $nameItem = $_POST['edName'];
      $urlItem = $_POST['edUrl'];
      $imgItem = $_POST['edImg'];
      $idItem = $_POST['edid'];

      if($imgItem == ""){
        $imgItem = "-";
      }

      session_start();
      $name = $_SESSION['cookiename'];
      $nameItem = htmlspecialchars($nameItem);
      $urlItem = htmlspecialchars($urlItem);
      $imgItem = htmlspecialchars($imgItem);

      if($nameItem != "" and $urlItem != "" and $imgItem != ""){
        include('php/regex.php');

      if((preg_match($regex, $nameItem) == 1) and (preg_match($regex, $urlItem) == 1)){
        echo "Error";
      }
      else{
        $sql = "update Item set name = '$nameItem', url = '$urlItem', img = '$imgItem' where id = '$idItem'";

        if ($conn->query($sql) === TRUE) {
        } else {
          echo "Error";
        }
      }
    }
  }

  if(isset($_POST['sebtn'])){

    include("php/connection.php");

    $imgItem = $_POST['seImg'];

    session_start();
    $name = $_SESSION['cookiename'];
    $imgItem = htmlspecialchars($imgItem);

    if($imgItem != ""){
      include('php/regex.php');

    if((preg_match($regex, $imgItem) == 1)){
      echo "Error";
    }
    else{
      $sql = "select * from Settings where name = '$name'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $sql = "update Settings set background = '$imgItem' where name = '$name'";

        if ($conn->query($sql) === TRUE) {
        } else {
          echo "Error";
        }
      }
      else{

      $sql = "INSERT INTO Settings (name, background)
      VALUES ('$name', '$imgItem')";

      if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error";
      }
    }
    }
  }
}

if(isset($_POST['swbtn'])){

  include("php/connection.php");

  $pos1 = $_POST['swicon1'];
  $pos2 = $_POST['swicon2'];
  $name1 = $_POST['swname1'];
  $name2 = $_POST['swname2'];
  $url1 = $_POST['swurl1'];
  $url2 = $_POST['swurl2'];
  $img1 = $_POST['swimg1'];
  $img2 = $_POST['swimg2'];

  session_start();
  $name = $_SESSION['cookiename'];

  $sql = "update Item set name = '$name1', url = '$url1', img = '$img1' where id = '$pos2'";

  if ($conn->query($sql) === TRUE) {
  } else {
    echo "Error";
  }

  $sql = "update Item set name = '$name2', url = '$url2', img = '$img2' where id = '$pos1'";

  if ($conn->query($sql) === TRUE) {
  } else {
    echo "Error";
  }
}
     ?>
  </body>
</html>
