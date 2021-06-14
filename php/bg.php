<?php

include("connection.php");
  session_start();
  $name = $_SESSION['cookiename'];
  $sql = "select * from Settings where name = '$name'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $bg = $row['background'];

    if (getimagesize($bg) == false) {
      $bg = "img/bg.jpg";
    }

    echo <<<BG
     <script type="text/javascript">
       loadBackground('{$bg}');
     </script>
    BG;
  }
}
 ?>
