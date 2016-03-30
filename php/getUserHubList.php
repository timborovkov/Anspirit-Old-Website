<?php
header("Content-Type: text/javascript");

$returnArray = null;
$id = $_POST['id'];
$password = $_POST['password'];

$mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
$query = "SELECT * FROM `users` WHERE `id`='".$id."'";
if($result = $mysqli -> query($query)){
    $row = $result -> fetch_assoc();
    if($row['password'] == md5($password)){
        //$returnArray = array('id'=>$id, 'email'=>$row['email'], 'hubList'=>$row['hubs']);
        $query = "SELECT * FROM `hub_list` WHERE `ownerId`='".$id."'";
        if($result = $mysqli->query($query)){
          $hubs = array('hubList'=>array());
          while($row = $result->fetch_assoc()){
            array_push($hubs['hubList'], $row);
          }
          //Hubs are now in $hubs
          $returnArray = $hubs;
        }else{
          $returnArray = array('error'=>'failed to contact database 2');
        }
    }else{
        //No access granted
        $returnArray = array('error'=>'no access');
    }
}else{
    $returnArray = array('error'=>'failed to contact database 1');
}

echo json_encode($returnArray);

?>
