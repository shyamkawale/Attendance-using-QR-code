<?php

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>QR-Code</title>
  </head>
  <body>
    <div class="header">
      <h3>OK! here is your QR-code</h3>
    </div>
    <link rel="stylesheet" type="text/css" href="style.css">
    <form class="" action="index1.html" method="post">
      <br>
      <center>
      <h5>PLEASE Scan it to mark your attendence:</h5>
      <br>
      <img src="https://api.qrserver.com/v1/create-qr-code/?data=after_scanning.php &amp;size=420x420" alt="" title="" />
      <h3><a href="home.php">GO BACK</a> </h3>
      </center>
    </form>
  </body>
</html>
