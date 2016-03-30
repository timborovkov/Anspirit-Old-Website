<?php
if(isset($_POST['id'])){
  //Got request
  $developer = $_POST['id'];
  $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
  if($result = $mysqli -> query("SELECT * FROM `extensions` WHERE `dev_id` = " . $developer)){
    //Done, got all extensions for developer
    //Put them in single array
    $extensions = array();
    while ($row = $result -> fetch_assoc()) {
      array_push($extensions, $row);
    }

    //Done, $extensions is now full of extensions
    //Send them back
    echo json_encode($extensions);
  }
}
 ?>
