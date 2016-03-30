<?php
    header("Content-Type: text/javascript");
    $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
    $done = false;
    $user = $_GET['user'];
    $ext = $_GET['ext'];

    while (!$done) {
      $result = $mysqli->query("SELECT * FROM `payments` WHERE `done` = 1 AND `from` = '$user' AND `buyWhat` = '$ext'");
        if($result->num_rows > 0){
          $done = true;
        }
    }

    //update money history and delete payment
    $mysqli -> query("INSERT INTO `money`(`sum`, `to`, `from`, `type`, `description`, `date`) VALUES (0, $ext, $user, 'buyExt', 'Buy extension from extension market. Extension ID $ext', NOW())");
    $mysqli -> query("DELETE FROM `payments` WHERE `done` = 1 AND `from` = '$user' AND `buyWhat` = '$ext'");
    //update user
    $result = $mysqli -> query("SELECT * FROM `userExtensions` WHERE `userId` = " . $user);
    $row = $result->fetch_assoc();
    $extensions = $row['extensions'];
    $extensions = unserialize($extensions);
    array_push($extensions, $ext);
    $extensions = serialize($extensions);
    $mysqli -> query("UPDATE `userExtensions` SET `extensions`= '$extensions' WHERE `userID` = $user");

    echo json_encode(array('done'=>true));
?>
