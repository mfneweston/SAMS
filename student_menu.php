<?php
include_once 'db.php';
include_once 'session.php';
if ($role === "Lecturer") {
  header("location:lecturer_menu.php");
} elseif ($role === "Admin") {
  header("location:admin_menu.php");
} else {
  ("");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Menu</title>
  <link rel="stylesheet" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    a {
      text-decoration: none;
      display: inline-block;
      padding: 8px 16px;
    }

    a:hover {
      background-color: #ddd;
      color: black;
      border-radius: 30px
    }

    .previous {
      background-color: #f1f1f1;
      color: black;
      font-weight: bold;
      font-size: 30px;
      position: absolute;
      top: 0;
      left: 0;
      margin: 20px;
      /* Adjust the margin for the desired positioning */
      border-radius: 50%;
      padding: 8px 12px;
    }

    .next {
      background-color: #04AA6D;
      color: white;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: linear-gradient(to right, #0098B9, #ECF6F9);
      position: relative;
    }

    img {
      width: 250px;
      height: auto;
    }

    h3 {
      font-family: 'Poppins', sans-serif;
    }

    .logo {
      position: absolute;
      bottom: 0;
      left: 0;
    }

    .box {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 60%;
      max-width: 400px;
      text-align: center;
      display: top;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 400px;
      font-family: 'Poppins', sans-serif;
    }

    .buttons {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .button {
      padding: 10px 65px;
      background: #fff;
      color: #000000;
      border: none;
      cursor: pointer;
      border-radius: 15px;
      width: 100%;
      text-align: center;
      font-family: 'Poppins', sans-serif;
    }

    .box img {
      max-width: 100%;
      max-height: 180px;
    }

    .upload-button {
      padding: 15px 210px;
    }

    .upload-button2 {
      padding: 15px 175px;
    }

    .logout-button {
      background: #f1f1f1;
      color: black;
      padding: 8px 16px;
      border-radius: 30px;
      position: absolute;
      top: 20px;
      right: 20px;
    }
  </style>
</head>

<body>
  <a style="font-family: 'Poppins', sans-serif; font-size: 90%;" href="logout.php" class="logout-button">Logout</a>
  <!--a href="#" class="previous round">&#8249;</a>-->
  <div class="logo">
    <img src="pictures/ukm-logo.png" alt="Your Image Description">
  </div>

  <div class="box">
    <!-- Content inside the rectangle box goes here -->
    <p style="margin-bottom: 10px">Student's Profile</p>
    <?php
    if (!empty($readrow['fld_user_image'])) {
      echo '<img src="pictures/' . $readrow['fld_user_image'] . '" alt="Your Image Description" style="width: 40%; height: 80%; border-radius: 5%; margin-top: 5px">';
    } else {
      echo '<img src="pictures/no_photo.jpg" alt="No Photo" style="width: 40%; height: 80%; border-radius: 5%; margin-top: 5px">';
    }
    ?>

    <div style="margin-top: 20px">
      <div>

      </div>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%"><?php echo $readrow['fld_user_id'] ?> - <?php echo $readrow['fld_user_name'] ?></p>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Faculty : <?php echo $readrow['fld_user_faculty'] ?></p>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Program : <?php echo $readrow['fld_user_course'] ?></p>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Status : <button style="background-color: #04AA6D; color: white; border-radius: 5px; width: 30%" disabled> Active</button></p>
    </div>
  </div>

  <div class="buttons" style="margin-bottom: 30px">
    <a href="absence_period.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif;" class="button upload-button2">Fill Absence Information</button></a>

    <a href="upload_history.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif; " class="button upload-button">Upload History</button></a>
  </div>

  <a href="generate_report_student.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif; margin-top: -25px; " class="button upload-button">Absence Report</button></a>
  </div>

</body>

</html>