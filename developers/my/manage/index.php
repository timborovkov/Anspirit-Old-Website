<?php
    //Setup database connection
    $mysqli = new mysqli("eu-cdbr-azure-north-d.cloudapp.net", "b2a32c755154bf", "c0b4e78d", "anspiritMain");
    //Check access
   if (isset($_COOKIE['username'])) {
     $name = $_COOKIE['username'];
     $pass = $_COOKIE['password'];
     $granted = false;
     //Process login
     $query = "SELECT * FROM `developers` WHERE `userName`='". $name ."'";
     if($result = $mysqli -> query($query)){
       //Query executed
       if ($row = $result -> fetch_assoc()) {
         //User found
         if ($pass == $row['password']) {
           //Done, everything is correct
           //Access granted
           $granted = true;
         }
       }
     }
   }
   if (!$granted) {
     //No access for current user here!
     $newURL = 'http://anspirit.org/developers';
     header('Location: '.$newURL);
   }else{
     //Access granted
   }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Anspirit - Manage Developer</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <meta name="description" content="IOT is our future. Everyday people create more and more smart devices. These devices are irreplaceable part of our lives. But how we use them? Every smart device means new app on your smartphone, desktop, smartwatch edc. Anspirit and qproject will connect all of them with each other using one simple ecosystem based on Rest API. Every device can control each other and get information from them.">
    <link rel="shortcut icon" type="image/x-icon" href="../../../images/anspirit.ico">
    <link rel="apple-touch-icon" href="../../../images/anspirit.ico">
    <title>Anspirit - Developer login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <style media="screen">
    .main{
        background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;
        background-size: cover;
        font-family: Montserrat;
    }
    .content{
      position: absolute;
      width: 700px;
      left: 300px;
      height: 800px;
      overflow: scroll;
    }
    .tablecontent{
      background-color: rgba(0, 0, 0, 0.10);
    }
    .menu{
      background-color: rgba(0, 0, 0, 0.20);
      position: absolute;
      top: 0px;
      width: 250px;
      height: 100%;
      overflow-y: scroll;
      margin: 0px 0px;
    }
    .menuBtn{
      margin-left: -10px;
      margin-top: 12px;
      width: 100%;
      font-size: 18px;
      color: #fff;
      background-color: rgba(46, 46, 46, 0.7);
      padding-top: 15px;
      padding-bottom: 15px;
      text-align: center;
      cursor: pointer;
    }
    .menuBtn:hover{
      background-color: #2e2e2e;
    }
    .menuLabel{
      font-size: 18px;
      color: #fff;
    }
    footer{
      position: absolute;
      bottom: 10px;
      left: 10px;
    }
    h1 { color: #dadada; font-family: 'Helvetica Neue', sans-serif; font-size: 20px; font-weight: bold; line-height: 1; text-align: center; }
    </style>
    <script type="text/javascript">
      $("document").ready(function(){
        $(".content").load("./my.html", function(){
          //Content loaded
          $(".myExt").click(function(){
            $(".content").load("./my.html");
          });
          $(".newExt").click(function(){
            $(".content").load("./new.html");
          });
          $(".settings").click(function(){
            alert("Not yet available!")
          });
        });
      });
    </script>
  </head>
  <body class="main">
    <div class="menu">
      <h1>Developer Panel.</h1>
      <div class="developerBalance menuLabel">Balance: $ 0.00</div>
      <div class="myExt menuBtn">My Extensions</div>
      <div class="newExt menuBtn">New Extension</div>
      <div class="settings menuBtn">Settings</div>
    </div>
    <div class="content">

    </div>
    <footer>
      <a href="http://anspirit.org"><img src="../../../images/anspirit.png" width="100px"/></a>
    </footer>
  </body>
</html>
