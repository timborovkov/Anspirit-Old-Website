<?php
   if (isset($_POST['submit'])) {
     $name = $_POST['username'];
     $pass = $_POST['password'];
     //Process login
     $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
     $query = "SELECT * FROM `developers` WHERE `userName`='". $name ."'";
     if($result = $mysqli -> query($query)){
       //Query executed
       if ($row = $result -> fetch_assoc()) {
         //User found
         if ($pass == $row['password']) {
           //Done, everything is correct
           echo "<h1 style='color: green;'>Done</h1>";
           //set all cookies with developer data
           setcookie('password', $pass);
           setcookie('username', $name);
           setcookie('id', $row['devId']);
           //redirect to control panel
           $newURL = "./manage/";
           header('Location: '.$newURL);
         }else{
           //Wrong password
           echo "<h1 style='color: red;'>Wrong username or password</h1>";
         }
       }else{
         //Wrong username
         echo "<h1 style='color: red;'>Wrong username or password</h1>";
       }
     }else{
       echo "<h1 style='color: red;'>Error on server</h1>";
     }
   }
?>
<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<meta charset="UTF-8">
<meta name="description" content="IOT is our future. Everyday people create more and more smart devices. These devices are irreplaceable part of our lives. But how we use them? Every smart device means new app on your smartphone, desktop, smartwatch edc. Anspirit and qproject will connect all of them with each other using one simple ecosystem based on Rest API. Every device can control each other and get information from them.">
<meta property="og:description" content="IOT is our future. Everyday people create more and more smart devices. These devices are irreplaceable part of our lives. But how we use them? Every smart device means new app on your smartphone, desktop, smartwatch edc. Anspirit and qproject will connect all of them with each other using one simple ecosystem based on Rest API. Every device can control each other and get information from them.">
<link rel="shortcut icon" type="image/x-icon" href="../../images/anspirit.ico">
<link rel="apple-touch-icon" href="../../images/anspirit.ico">
<title>Anspirit - Developer login</title>
<style>
body {
    background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;
    background-size: cover;
    font-family: Montserrat;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #ff656c;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #ff656c;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #ff656c;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #e15960;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #ff7b81;
}
footer{
  position: absolute;
  bottom: 100px;
  left: 100px;
}
</style>
</head>

<body>
<div class="login-block">
    <h1>Login</h1>
    <form action="" method="post">
      <input type="text" value="" placeholder="Username" id="username" name="username"/>
      <input type="password" value="" placeholder="Password" id="password" name="password"/>
      <button type="submit" name="submit">Login</button>
    </form>
</div>
<footer>
  <a href="http://anspirit.org"><img src="../../images/anspirit.ico" width="100px"/></a>
</footer>
</body>

</html>
