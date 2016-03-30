<?php
header("Content-Type: text/javascript");

$returnArray = null;
$id = $_POST['id'];
$email = $_POST['email'];
$password= $_POST['password'];
$mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
$query = "SELECT * FROM `users` WHERE `id`='".$id."' AND `email`='".$email."' AND `password`='".$password."'";
  if($result = $mysqli -> query($query)){
    $row = $result -> fetch_assoc();
    if($row != null){
      $returnArray = array('id'=>$id, 'name'=>$row['fullname'], 'email'=>$row['email'], 'age'=>$row['age'], 'version'=>$row['version'], 'lang'=>$row['lang'], 'secret'=>$row['tokenCode']);
    }else{
      $returnArray = array('error' => 'wrong auth');
    }
  }else{
    $returnArray = array('error'=>'error');
  }

echo json_encode($returnArray);

?>
