<?php
include('functions.php');
// $this->user_id = $_SESSION['user_id']=$user->id;

// session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>After_Scanning</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    <h1>After Scanning part</h1>
    </div>
    <form action="after_scanning.php" method="post">
    <h2>Select Subject and your Roll no: </h2>
    <br>
    <select name="Color">
    <option value="maths">maths</option>
    <option value="science">science</option>
    </select>
    <select name="Rollno">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    </select>
    <input type="submit" name="submit" value="MARK ATTENDANCE" />
    </form>
    <?php


    if(isset($_POST['submit'])){
    $selected_sub = $_POST['Color'];
    $selected_roll= $_POST['Rollno'];

    echo "your rollno is: ";
    echo $selected_roll;
    echo "<br>";
    if($selected_sub=="maths"){
      $query = "UPDATE attendance SET maths_attend=maths_attend+1 WHERE id=$selected_roll";
      mysqli_query($db,$query);
    }
    else {
      //$value = "SELECT `id` FROM `attendance` WHERE '$column_name' = science_attend";
      $query = "UPDATE attendance SET science_attend=science_attend+1 WHERE id=$selected_roll";
      mysqli_query($db,$query);
    }
    echo "<br>";
    echo "You have selected :" .$selected_sub;  // Displaying Selected Value
    }

    ?>
  </body>
</html>
