<?php

if($_POST){
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $pathToExt = $_POST['pathToExt'];
  $icon = $_POST['icon'];
  $devId = $_POST['devId'];
  $devPassword = $_POST['devPassword'];

try{

  $all_fields = array('name', 'price', 'description', 'pathToExt', 'icon', 'devId', 'devPassword');

  foreach($all_fields as $field){
          if(empty($_POST[$field])){
                  throw new Exception('Required field "'.ucfirst($field).'" missing input.');
          }
  }

  $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
  $query = "SELECT * FROM `developers` WHERE `devId`='". $devId ."'";
  if($result = $mysqli -> query($query)){
    if($row = $result -> fetch_assoc()){
      //Check access
      if($row['password'] == $devPassword){
        //Granted!
        $developer = $row['name'];
        $query = "INSERT INTO `extensions` (`name`, `description`, `developer`, `icon`, `pathToExt`, `price`, `soldTimes`, `dev_id`) VALUES ('".$name."', '".$description."', '".$developer."', '".$icon."', '".$pathToExt."', '0', '0', '".$devId."')";
        if ($mysqli -> query($query)) {
          //Done
          header("Location: http://anspirit.org/developers/my/manage");
        }else{
          //Failed execute query
          echo $query;
        }
      }else{
        //Login failed
      }
    }else{
      //No developer found
      echo "No developer found";
    }
  }
} catch(Exception $e){
    echo "error: ".$e;
  }
}
?>
