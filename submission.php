<?php
include_once 'submission_crud.php';
include_once 'session.php';
include_once 'db.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : '';
$title_id = isset($_GET['title_id']) ? $_GET['title_id'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';
$file_list = isset($_GET['file_list']) ? json_decode($_GET['file_list'], true) : [];  // Updated parameter name
$date = isset($_GET['inputDate']) ? $_GET['inputDate'] : '';
$dateFormatted = date("d-m-Y", strtotime($date));



// Create the directory if it doesn't exist
$uploadDirectory = 'uploads/ProofDocument/';
if (!is_dir($uploadDirectory)) {
  mkdir($uploadDirectory, 0777, true);
}

// Initialize $uploadedFiles outside the conditional block
$uploadedFiles = [];

// Check if form is submitted
if (isset($_POST['create'])) {
  try {
    if (!empty($_FILES['files']['name'][0])) {
      foreach ($_FILES['files']['name'] as $key => $name) {
        if ($_FILES['files']['error'][$key] === UPLOAD_ERR_OK) {
          $tempName = $_FILES['files']['tmp_name'][$key];
          $fileName = 'uploads/ProofDocument/' . $name;

          if (move_uploaded_file($tempName, $fileName)) {
            $uploadedFiles[] = $name;
          } else {
            echo "Failed to move file: " . $name . ". ";
          }
        } else {
          echo "Error uploading file: " . $name . ". Error Code: " . $_FILES['files']['error'][$key];
        }
      }
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  } finally {
    $conn = null;
  }
}


date_default_timezone_set('Asia/Kuala_Lumpur');
$submissionDate = date("Y-m-d"); // Date format: YYYY-MM-DD
$submissionTime = date("h:i:s"); // Time format: hh:mm AM/PM

// Create DateTime objects from the submission date and time
$submissionDateTime = new DateTime("$submissionDate $submissionTime");

// Format the submission date to the desired format (d-m-Y)
$submissionDateFormatted = $submissionDateTime->format('d-m-Y');

// Format the submission time to the desired format (24-hour)
$submissionTimeFormatted = $submissionDateTime->format('H:i');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submission Details</title>
  <link rel="stylesheet" href="style.css">
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: linear-gradient(to right, #0098B9, #ECF6F9);
      ;
      position: relative;
    }

    img {
      width: 160px;
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
      height: 400px;
      text-align: center;
      position: absolute;
      display: top;
      flex-direction: column;
      align-items: center;
      top: 44%;
      /* Center vertically */
      transform: translate(-50%, -50%);
      font-family: 'Poppins', sans-serif;
    }

    .box img {
      max-width: 100%;
      max-height: 180px;
    }

    .box {
      right: 0;
      /* Align to the right */
    }

    .box-left {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      width: 60%;
      max-width: 550px;
      height: 550px;
      text-align: left;
      position: absolute;
      top: 50%;
      /* Center vertically */
      transform: translate(-50%, -50%);
      font-family: 'Poppins', sans-serif;
    }

    .box-left h2 {
      font-size: 24px;
      margin-bottom: 1px;
      text-align: center;

      color: #0098B9;
    }

    .box-left .line {
      border-top: 1px solid #000000;
      /* Define line color and style */
      margin-top: 5px;
      /* Adjust spacing around the line */
    }

    .info-section {
      min-height: 2.5%;
      justify-content: left;
      font-family: 'Poppins', sans-serif;
      font-size: 17px;

    }

    .buttons {
      margin-top: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      position: absolute;
      display: top;
      right: 0;
      top: 81%;
      /* Center vertically */
      transform: translate(-50%, -50%);
      font-family: 'Poppins', sans-serif;
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

    .upload-button2 {
      padding: 15px 188px;
      background: #fff;
      color: #000000;
      border: none;
      cursor: pointer;
      border-radius: 15px;
      width: 100%;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      transition: background-color 0.3s;
      /* Add a smooth transition effect */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .upload-button3 {
      padding: 15px 188px;
      background: #fff;
      color: #000000;
      border: none;
      cursor: pointer;
      border-radius: 15px;
      width: 100%;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      transition: background-color 0.3s;
      /* Add a smooth transition effect */
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }


    .upload-button2:hover {
      background-color: #0098B9;
      /* Change the background color when hovering */
      color: #fff;
      /* Change text color when hovering */
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .upload-button3:hover {
      background-color: red;
      /* Change the background color when hovering */
      color: #fff;
      /* Change text color when hovering */
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }
  </style>
  <script>
    var uploadedFiles = <?php echo json_encode($uploadedFiles, JSON_UNESCAPED_UNICODE); ?>;
  </script>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Display the uploaded files
      var fileList = document.getElementById("fileList");

      // Clear any existing content
      fileList.innerHTML = "";

      // Use JavaScript to dynamically generate the list of uploaded files
      uploadedFiles.forEach(function(file) {
        var listItem = document.createElement("li");
        listItem.textContent = file;
        fileList.appendChild(listItem);
      });
    });

    function editSubmissionBtn() {
      window.history.back();
    }


    document.getElementById("editSubmissionBtn").addEventListener("click", function(event) {
      event.preventDefault(); // Prevent the form from submitting
      history.back(); // Navigate back in the browser history
    });
  </script>

</head>

<body>

  <?php
  try {
    // Fetch course details and user details
    $stmt = $conn->prepare("SELECT cd.*, ud_lecturer.fld_user_name as lecturer_name, ud_student.fld_user_name as student_name
        FROM tbl_student_enrollment se
        JOIN tbl_user_details ud_student ON se.fld_user_id = ud_student.fld_user_id
        JOIN tbl_course_details cd ON se.fld_course_code = cd.fld_course_code
        LEFT JOIN tbl_user_details ud_lecturer ON cd.fld_lecturer_id = ud_lecturer.fld_user_id
        WHERE se.fld_user_id = :user_id AND se.fld_course_code = :course_code");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':course_code', $course_code);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
      $tbl_course_details = $result[0]; // Assuming you only want the first row
      $tbl_user_details = $result[0]; // Assuming you only want the first row
    } else {
      // Handle the case when no results are found

    }
  } catch (PDOException $e) {
    echo "Error : " . $e->getMessage();
  }

  ?>


  <!--a href="#" class="previous round">&#8249;</a>-->
  <div class="logo">
    <img src="pictures/ukm-logo.png" alt="Your Image Description">
  </div>

  <div class="box-left">
    <h2>SUBMISSION DETAILS</h2>
    <div class="line"></div> <!-- Line between title and content -->


    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

      <div class="info-section">
        <p><span style="font-weight: bold;">CODE :</span> <?php echo isset($tbl_course_details['fld_course_code']) ? $tbl_course_details['fld_course_code'] : ''; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">COURSE :</span> <?php echo isset($tbl_course_details['fld_course_name']) ? $tbl_course_details['fld_course_name'] : ''; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">LECTURER : </span><?php echo isset($tbl_course_details['lecturer_name']) ? $tbl_course_details['lecturer_name'] : ''; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">DATE OF ABSENCE : </span><?php echo $dateFormatted ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">TIME : </span><?php echo isset($tbl_course_details['fld_time']) ? $tbl_course_details['fld_time'] : ''; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">DURATION : </span><?php echo isset($tbl_course_details['fld_course_duration']) ? $tbl_course_details['fld_course_duration'] : ''; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">TITLE : </span><?php echo $title; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">DESCRIPTION : </span><?php echo $description; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">UPLOADED FILES : </span> <?php if (!empty($file_list)) : ?>
            <?php foreach ($file_list as $fileName) : ?>
              <span style="margin-left: 5px;"><?php echo $fileName; ?></span>
              <input type="hidden" name="file_upload[]" value="<?php echo $fileName; ?>">
            <?php endforeach; ?>
          <?php else : ?>
            <span>No files uploaded.</span>
          <?php endif; ?>
        </p>
      </div>


      <div class="info-section">
        <p><span style="font-weight: bold;">DATE OF SUBMISSION :</span> <?php echo $submissionDateFormatted; ?></p>
      </div>

      <div class="info-section">
        <p><span style="font-weight: bold;">TIME OF SUBMISSION :</span> <?php echo $submissionTimeFormatted; ?></p>
      </div>

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

  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  <input type="hidden" name="submission_date" value="<?php echo $submissionDate; ?>">
  <input type="hidden" name="submission_time" value="<?php echo $submissionTime; ?>">
  <input type="hidden" name="course_code" value="<?php echo $tbl_course_details['fld_course_code']; ?>">
  <input type="hidden" name="course_name" value="<?php echo $tbl_course_details['fld_course_name']; ?>">
  <input type="hidden" name="lecturer_name" value="<?php echo $tbl_course_details['lecturer_name']; ?>">
  <input type="hidden" name="course_duration" value="<?php echo $tbl_course_details['fld_course_duration']; ?>">
  <input type="hidden" name="course_time" value="<?php echo $tbl_course_details['fld_time']; ?>">
  <input type="hidden" name="absence_date" value="<?php echo $date; ?>">
  <input type="hidden" name="title" value="<?php echo $title; ?>">
  <input type="hidden" name="title_id" value="<?php echo $title_id; ?>">
  <input type="hidden" name="description" value="<?php echo $description; ?>">
  <!-- <input type="hidden" name="file_upload[]" value="<? //php echo $fileName; 
                                                        ?>"> -->
  <!-- <input type="file" name="file_input[]" multiple> -->


  <div class="buttons" style="margin-top:30px; margin-right:-70px ">
    <!-- <form method="POST" action="">
      <button id="editSubmissionBtn" style="font-weight: bold; font-size: 15px; font-family: 'Poppins', sans-serif;" class="upload-button3">EDIT SUBMISSION</button>
    </form> -->
    <!-- <button id="editSubmissionBtn" style="font-weight: bold; font-size: 15px; font-family: 'Poppins', sans-serif;" class="upload-button3" onclick="editSubmissionBtn()">EDIT SUBMISSION</button> -->
    <button name="create" type="submit" style="font-weight:bold;font-size: 15px; font-family: 'Poppins', sans-serif; margin-right: 40px" class="button upload-button2">PROCEED</button>
  </div>
  </form>

  </div>

</body>


</html>