<?php
if($_POST){
    //Got request to update extension with id $_POST['extensionId'];
    //Set data to variables
    $devId = $_POST['devId'];
    $devPassword = $_POST['devPassword'];
    $id = $_POST['extensionId'];
    $name = $_POST['name'];
    $icon = $_POST['icon'];
    $description = $_POST['description'];
    $pathToExt = $_POST['files'];
    $price = $_POST['price'];
try{
    $all_fields = array('name', 'price', 'description', 'files', 'icon', 'devId', 'devPassword', 'extensionId');

    foreach($all_fields as $field){
            if(empty($_POST[$field])){
                    throw new Exception('Required field "'.ucfirst($field).'" missing input.');
            }
    }

    //Validate user access to edit extension
    $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
    $query = "SELECT * FROM `developers` WHERE `devId`='". $devId ."'";
    if($result = $mysqli -> query($query)){
      if($row = $result -> fetch_assoc()){
        if($row['password'] == $devPassword){
          //access granted
          //Check if extension to edit is owned by user
          $query = "SELECT * FROM `extensions` WHERE `dev_id`='". $devId ."'";
          if($result = $mysqli -> query($query)){
            $access = false;
            while($row = $result -> fetch_assoc()){
              //Check if this is needed extension
              if($row['id'] == $id){
                //needed
                //Give access, because this is extension owned by developer
                $access = true;
              }else{
                //not needed now
                //skip
              }
            }
            if($access){
              //Developer has access to edit extension
              //Update fields in database
              $query = "UPDATE `extensions` SET `name`='".$name."',`icon`='".$icon."',`description`='".$description."', `pathToExt`='".$pathToExt."', `price`=".$price." WHERE `id`=".$id;
              if ($mysqli -> query($query)) {
                //Done, everything is now updated
                echo "Done";
              }else{
                //Failed to execute query
                echo "Failed to execute";
              }
            }else{
              //No access
              echo "No access";
            }
          }
        }else{
          //Wrong login data
          echo "Wrong login data";
        }
      }else{
        //No developer found
        echo "No developer found";
      }
    }
  }atch(Exception $e){
      echo "error: ". $e;
    }
}
?>
