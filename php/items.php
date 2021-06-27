<?php

include("connection.php");
  session_start();
  $name = $_SESSION['cookiename'];
  $sql = "select * from Item where user = '$name'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
  $counter = 0;
  while($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $url = $row['url'];
    $img = $row['img'];
    $itemID = $row['id'];
    $itemPos = $row['pos'];

    if (getimagesize($img) == false) {
      $img = "img/Webtop.png";
    }

    echo <<<ITEM

    <div class="item">
    <div class="icon">
      <div class="delete" onclick="remove({$itemID})"></div>
      <div class="edit" onclick="edit({$itemID},'$name','$url','$img')"></div>
      <a target="_blank" href="$url"><img src="$img" alt=""></a>
    </div>
        <p class="itemText" onclick="swap({$counter},{$itemID},'$name','$url','$img')">$name</p>
    </div>

    ITEM;

    $counter++;
  }
}
 ?>
