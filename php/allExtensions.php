<?php
  header("Content-Type: text/javascript");
  $toRet = array();

  $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
  $result = $mysqli -> query("SELECT * FROM `extensions`");
  if($result != null && $result->num_rows > 0){
    while($ext = $result -> fetch_assoc()){
      $extension = array();
      $extension['name'] = $ext['name'];
      $extension['description'] = $ext['description'];
      $extension['fullDescription'] = $ext['fullDescription'];
      $extension['developer'] = $ext['developer'];
      $extension['icon'] = $ext['icon'];
      $extension['price'] = $ext['price'];
      $extension['downloads'] = $ext['soldTimes'];
      $extension['pathToExtFolder'] = $ext['pathToExtFolder'];
      $extension['id'] = $ext['id'];
      array_push($toRet, $extension);
    }
  }
  echo json_encode($toRet);
?>
