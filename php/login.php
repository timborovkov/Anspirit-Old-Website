<?php
  header('Access-Control-Allow-Origin: *');  
  header("Content-Type: text/javascript");

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }

  $pass = $_POST['password'];
  $email = $_POST['email'];
  $login = false;
  $id = 0;
  $version = null;
  $name = null;
  $lang = null;
  $country = null;

  $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
  $query = "SELECT * FROM `users` WHERE `email` = '" . $email . "'";
  $result = $mysqli -> query($query);
  if($result != null){
    while($row = $result -> fetch_assoc()){
      if($row['password'] == md5($pass)){
        $login = true;
        $id = $row['id'];
        $version = $row['version'];
        $name = $row['fullname'];
        $country = $row['country'];
        $lang = $row['lang'];
        $tokenCode = $row['tokenCode'];
        $hubs = $row['hubs'];
      }
    }
  }
  $mysqli -> query("INSERT INTO `tryToLogin`(`email`, `date`, `ip`) VALUES ('".$email."', NOW(), '".$ip."')");

  $data = array('login'=> $login, 'id'=> $id, 'hubs'=>$hubs, 'version'=> $version, 'lang'=> $lang, 'name'=>$name, 'country'=>$country, 'tokenCode'=>$tokenCode, 'email'=>$email);
  $data = json_encode($data);
  echo($data);

  $mysqli -> close();
?>
