<?php
include_once 'db.php';
include_once 'session.php';
if ($role==="Student"){
 header("location:student_menu.php");
}
elseif ($role === "Admin") {
  header("location:admin_menu.php");
} 
else  {("");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Absenteeism Management System</title>
  <link rel="stylesheet" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family:Poppins:400,500,600,700&display=swap');

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

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: linear-gradient(to right, #0098B9, #ECF6F9);;
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
      background: #FFFFFF;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 80%;
      max-width: 500px;
      text-align: center;
      display: top;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 400px;
    }

    .buttons {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3px;
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

    .logout-button {
      background: #f1f1f1;
      color: black;

      padding: 9px 18px;
      border-radius: 30px;
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .upload-button {
      padding: 15px 205px;
    }
    .upload-button2 {
      padding: 15px 210px;
    }

    .box img {
      max-width: 40%; /* Make sure the image fits within the box */
      max-height:200px;
    }
  </style>
</head>
<body>


  <a style="font-family: 'Poppins', sans-serif; font-size: 90%;" href="logout.php" class="logout-button">Logout</a>

  <div class="logo">

    <img src="pictures/ukm-logo.png" alt="Your Image Description">

  </div>

  <?php
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_SESSION['userid'];
    $stmt = $conn->prepare("SELECT * FROM tbl_user_details WHERE fld_user_id = '$id'");

    $stmt->execute();

    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>

  <div class="box">
    <!-- Content inside the rectangle box goes here -->
    <p>Lecturer's Profile</p>

    <?php if ($readrow['fld_user_image'] == "" ) {
      echo "Your Image Description";
    }
    else { ?>

      <img src="pictures/<?php echo $readrow['fld_user_image'] ?>" class="img-responsive" >

    <?php } ?>

    <div style="margin-top: 20px">
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%; margin-bottom: 20px;"><?php echo $readrow['fld_user_id'] ?> - <?php echo $readrow['fld_user_name'] ?></p>

      <p style="font-family: 'Poppins', sans-serif; font-size: 90%; margin-bottom: 5px;">Faculty : <?php echo $readrow['fld_user_faculty'] ?></p>
      <p></p>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%; margin-bottom: 5px;">Email:  <?php echo $readrow['fld_user_email'] ?></p>
      <p></p>
      <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Status : <button style="background-color: #04AA6D; color: white; border-radius: 5px; width: 30%" disabled> Active</button></p>
      <p></p>
    </div>
  </div>

</div>

    <!-- <div class="buttons">
      <button style="font-size: 15px" class="button">Review Student Absence</button>
      <button style="font-size: 15px" class="button">Review Document History</button>
    </div> -->

   
      
      <div class="buttons" style="margin-bottom: 5px">
        <a href="review_student_absence_activity.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif;" class="button upload-button2">Review Student Absence</button></a>
        <a href="review_accepted_rejected.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif; " class="button upload-button">Absence Document History</button></a></div>
        <a href="generate_report_lecturer.php"><button style="font-size: 15px; font-family: 'Poppins', sans-serif; " class="button upload-button2">Students Absence Report</button></a></div>
    </div>
    </div>
    

  </body>
  </html>
