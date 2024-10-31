<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    // start een sessie
    session_start(); 
    //stop de sessie
    session_destroy();
    //bericht die zegt dat je bent uitgelogd en tootn voor 2 seconden
    setcookie("bericht", "je bent uitgelogd", time()+2);
    //je wordt gelijk door gestuurd naar login.php
    header("location:login.php");
    ?>
</body>
</html>