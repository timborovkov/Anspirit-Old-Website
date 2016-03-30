<?php
header("Content-Type: text/javascript");

$returnArray = null;
$id = $_GET['id'];
$mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
$query = "SELECT * FROM `users` WHERE `id`='".$id."'";
  if($result = $mysqli -> query($query)){
    $row = $result -> fetch_assoc();
    $returnArray = array('id'=>$id, 'name'=>$row['fullname'], 'email'=>$row['email'], 'age'=>$row['age'], 'version'=>$row['version'], 'lang'=>$row['lang']);
  }else{
    $returnArray = array('error'=>'error');
  }

echo json_encode($returnArray);

?>
