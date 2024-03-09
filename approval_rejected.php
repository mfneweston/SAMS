<?php
include_once 'db.php';
include_once 'session.php';


$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$user_name = isset($_GET['user_name']) ? urldecode($_GET['user_name']) : '';
$submission_id = isset($_GET['submission_id']) ? $_GET['submission_id'] : '';


?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

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
        width: 190px;
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
        top: 44%; /* Center vertically */
        transform: translate(-50%, -50%);
        font-family: 'Poppins', sans-serif;
      }

      .box img {
        max-width: 100%;
        max-height: 180px;
      }

      .box {
        right: 0; /* Align to the right */
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
        top: 50%; /* Center vertically */
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
        border-top: 1px solid #000000; /* Define line color and style */
        margin-top: 5px; /* Adjust spacing around the line */
      }

      .info-section {
        min-height: 2.5%;
        justify-content: left;
        font-family: 'Poppins', sans-serif;
        font-size: 17px;
        margin-bottom: 25px;

      }
      .buttons-approve{
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        gap: 10px;
        position: absolute;
        display: top;
        right: 50%; /* Center horizontally */
        top: 81%; /* Center vertically */
        transform: translate(0%, -50%);
        font-family: 'Poppins', sans-serif;

    }

    .buttons-reject{
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        gap: 10px;
        position: absolute;
        display: top;
        left: 100%; /* Center horizontally */
        top: 20%; /* Center vertically */
        transform: translate(0%, -50%);
        font-family: 'Poppins', sans-serif;

    }

      .upload-button2 {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 100px;
        background: #0BDA51;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 15px;
        width: 50%;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s; /* Add a smooth transition effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-left: 240%; /* Adjusted margin to move the button slightly to the left */
    }

    .additional-text {
  text-align: center; /* Align the text center if needed */
  margin-top: 20px; /* Adjust the top margin as necessary */
  /* Add any other necessary styling */
}

    .upload-button2:hover {
      background-color: #0BDA51; /* Change the background color when hovering */
      color: #000000; /* Change text color when hovering */
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
  }

  .buttons-reject{
        margin-top: 15px;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        gap: 10px;
        position: absolute;
        display: top;
        left: 100%; /* Center horizontally */
        top: 20%; /* Center vertically */
        transform: translate(0%, -50%);
        font-family: 'Poppins', sans-serif;

    }

  .upload-button1 {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 100px;
        background: #FF4646;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 15px;
        width: 50%;
        text-align: center;
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s; /* Add a smooth transition effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-left: 240%; /* Adjusted margin to move the button slightly to the left */
    }

  .upload-button1:hover {
    background-color: #FF4646; /* Change the background color when hovering */
    color: #000000; /* Change text color when hovering */
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
  }
  .next {
            position: absolute;
            bottom: 30px;
            right: 30px;
            background-color: rgba(123, 147, 255, 0.8);
            color: #000000;
            border-color: rgba(123, 147, 255, 0.8);
            font-family: 'Poppins', sans-serif;
            padding: 8px 16px;
            border-radius: 10px;
        }


    </style>
  </head>

  <body>


    <?php
    try {
    // Fetch user details
    $user_stmt = $conn->prepare("SELECT fld_user_name, fld_user_faculty, fld_user_course, fld_user_image FROM tbl_user_details WHERE fld_user_id = :user_id");
    $user_stmt->bindParam(':user_id', $user_id);
    $user_stmt->execute();
    $user_details = $user_stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch details from tbl_submission_details and related tables
    $submission_stmt = $conn->prepare("SELECT *
                            FROM tbl_submission_details
                            WHERE fld_user_id = :user_id AND fld_submission_id = :submission_id");
    $submission_stmt->bindParam(':user_id', $user_id);
    $submission_stmt->bindParam(':submission_id', $submission_id);
    $submission_stmt->execute();
    $result = $submission_stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
         $readrow = $result[0]; // Fetch the first row
          $tbl_submission_details = $readrow; // Use $readrow as user details
          $tbl_user_details = $readrow; // Use $readrow as user details
        // You can access the fields like $tbl_submission_details['fld_absence_title'], $tbl_course_details['fld_course_name'], etc.
    } else {
         echo "No results found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<button onclick="location.href='review_accepted_rejected.php'" class="next">BACK</button>

        <div class="logo">
          <img src="pictures/ukm-logo.png" alt="Your Image Description">
        </div>

        <div class="box-left" style="margin-left: 40px">
          <h2 >RECORD DETAILS</h2>
          <div class="line"></div> <!-- Line between title and content -->

          <form method="POST" action="" enctype="multipart/form-data">

            <div class="info-section">
              <p><span style="font-weight: bold;">TYPE OF ABSENCE : </span><?php echo isset($tbl_submission_details['fld_absence_type']) ? $tbl_submission_details['fld_absence_type'] : ''; ?></p>
            </div>

            <div class="info-section">
            <p><span style="font-weight: bold;">TITLE : </span><?php echo isset($tbl_submission_details['fld_absence_title']) ? $tbl_submission_details['fld_absence_title'] : ''; ?></p>
           </div>

           <div class="info-section">
            <?php
            $course_code= isset($tbl_submission_details['fld_course_code']) ? $tbl_submission_details['fld_course_code'] : '';
            $course_name = isset($tbl_submission_details['fld_course_name']) ? $tbl_submission_details['fld_course_name'] : '';
            ?>
            <p><span style="font-weight: bold;">COURSE :</span> <?php echo $course_code; ?> <?php echo $course_name; ?></p>
            </div>


          <div class="info-section">
              <?php
              $absence_date = isset($tbl_submission_details['fld_absence_date']) ? $tbl_submission_details['fld_absence_date'] : '';
              $absence_time = isset($tbl_submission_details['fld_time']) ? $tbl_submission_details['fld_time'] : '';
              echo "<p><span style=\"font-weight: bold;\">DATE AND TIME: </span>{$absence_date} {$absence_time}</p>";
              ?>
          </div>

          <!-- get the duration from tbl_course_details via course code in tbl_submission_details  -->
          <div class = "info-section">
            <p><span style="font-weight: bold;">DURATION : </span><?php echo isset($tbl_submission_details['fld_course_duration']) ? $tbl_submission_details['fld_course_duration'] : ''; ?></p>
          </div>



         <div class="info-section">
          <p><span style="font-weight: bold;">DESCRIPTION : </span><?php echo isset($tbl_submission_details['fld_absence_desc']) ? $tbl_submission_details['fld_absence_desc'] : ''; ?></p>
        </div>

        <div class="info-section">
        <p><span style="font-weight: bold;">SUPPORTED DOCUMENT : </span>
          <?php
        if (!empty($tbl_submission_details['fld_file_upload'])) {
            $file_name = $tbl_submission_details['fld_file_upload'];
            $file_path = 'uploads/ProofDocument/' . $file_name;
            
            // Display a download link with a download icon
            echo '<a href="' . $file_path . '" download="' . $file_name . '"><i class="fas fa-download"></i>  ' . $file_name . '</a>';
        } else {
            echo 'No document uploaded';
        }
        ?>
        </p>
    </div>

    <div class="info-section">
          <p><span style="font-weight: bold;">DATE OF SUBMISSION : </span><?php echo isset($tbl_submission_details['fld_submission_date']) ? $tbl_submission_details['fld_submission_date'] : ''; ?></p>
    </div>

    <div class="info-section">
          <p><span style="font-weight: bold;">TIME OF SUBMISSION : </span><?php echo isset($tbl_submission_details['fld_submission_time']) ? $tbl_submission_details['fld_submission_time'] : ''; ?></p>
    </div>
      
    </div>



    <div class="box"> 
      <!-- Content inside the rectangle box goes here -->
      <p style="margin-bottom: 10px">Student's Details</p>
      <?php
      if (!empty($user_details['fld_user_image'])) {
        echo '<img src="pictures/' . $user_details['fld_user_image'] . '" alt="Your Image Description" style="width: 40%; height: 80%; border-radius: 5%; margin-top: 5px">';
      } else {
        echo '<img src="pictures/no_photo.jpg" alt="No Photo" style="width: 40%; height: 80%; border-radius: 5%; margin-top: 5px">';
      }
      ?>

      <div style="margin-top: 20px">
        <div>

        </div>
        <p style="font-family: 'Poppins', sans-serif; font-size: 90%"> <?php echo $user_id; ?> - <?php echo $user_details['fld_user_name']; ?></p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Faculty : <?php echo $user_details['fld_user_faculty']; ?></p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Program :  <?php echo $user_details['fld_user_course']; ?></p>
        <p style="font-family: 'Poppins', sans-serif; font-size: 90%; font-weight: bold">Submission : <span style="font-weight: bold; color: red">REJECTED SUBMISSION</span> </p>


      </div>
    </div>



 




    </div>

  </div>



  </form>

</div>

</body>

</html>