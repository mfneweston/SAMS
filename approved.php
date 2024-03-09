<?php

include_once 'db.php';
include_once 'session.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';
$date = isset($_GET['date']) ? $_GET['date'] : '';
$dateFormatted = date("d-m-Y", strtotime($date));
$uploadedFiles = isset($_GET['uploaded_files']) ? json_decode($_GET['uploaded_files']) : [];


// Add your logic to save the title, description, and file information to the database
// You can use $description and $_SESSION['uploaded_files'] here

$submissionDate = date("d-m-Y"); // Date format: YYYY-MM-DD
// Set the timezone to your desired timezone
date_default_timezone_set('Asia/Kuala_Lumpur'); // Replace 'Asia/Kuala_Lumpur' with your timezone
$submissionTime = date("h:i:s"); // Time format: hh:mm AM/PM

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$submission_id = isset($_GET['submission_id']) ? $_GET['submission_id'] : '';


if (isset($_GET['course_name'])) {
    $courseName = urldecode($_GET['course_name']);
    // Now $courseName contains the course name passed from upload_history.php
    // Use $courseName as needed in your code
} else {
    // Handle the case when the course name is not provided
}


?>

<!-- JavaScript code should be enclosed in script tags -->
<script>
    <?php
    session_start();

    if (isset($_SESSION['uploaded_files'])) {
        echo 'var uploadedFiles = ' . json_encode($_SESSION['uploaded_files']) . ';';
    } else {
        echo 'var uploadedFiles = [];'; // Initialize as an empty array if not set
    }
    ?>
</script>


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
</head>

<body>

    <?php
    try {
        // Fetch course details and user details
        $stmt = $conn->prepare("SELECT * FROM tbl_submission_details
        WHERE fld_user_id = :user_id AND fld_submission_id=:submission_id");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':submission_id', $submission_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // echo $submission_id;

        if ($result) {
            $tbl_course_details = $result[0]; // Assuming you only want the first row
            $tbl_submission_details = $result[0];
            $tbl_user_details = $result[0]; // Assuming you only want the first row
        } else {
            // Handle the case when no results are found

        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Assuming $uploadedFiles is an array of file names
    $fileUpload = implode(',', $uploadedFiles);
    ?>

    <!--a href="#" class="previous round">&#8249;</a>-->
    <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div>

    <div class="box-left " style="height: 75%;">
        <h2>SUBMISSION HISTORY</h2>
        <div class="line"></div> <!-- Line between title and content -->


        <form method="POST" action="" enctype="multipart/form-data">

            <div class="info-section">
                <p><span style="font-weight: bold;">CODE :</span> <?php echo isset($tbl_submission_details['fld_course_code']) ? $tbl_submission_details['fld_course_code'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">COURSE :</span> <?php echo isset($tbl_submission_details['fld_course_name']) ? $tbl_submission_details['fld_course_name'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">LECTURER : </span><?php echo isset($tbl_submission_details['fld_lecturer_name']) ? $tbl_submission_details['fld_lecturer_name'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">DATE OF ABSENCE : </span><?php echo isset($tbl_submission_details['fld_absence_date']) ? $tbl_submission_details['fld_absence_date'] : '';  ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">TIME : </span><?php echo isset($tbl_submission_details['fld_time']) ? $tbl_submission_details['fld_time'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">DURATION : </span><?php echo isset($tbl_course_details['fld_course_duration']) ? $tbl_course_details['fld_course_duration'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">TITLE : </span><?php echo isset($tbl_submission_details['fld_absence_title']) ? $tbl_submission_details['fld_absence_title'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">DESCRIPTION : </span><?php echo isset($tbl_submission_details['fld_absence_desc']) ? $tbl_submission_details['fld_absence_desc'] : ''; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">UPLOADED FILES : </span><span>a187291_proof.pdf</span>

                    <!-- <script>
                    Use JavaScript to dynamically generate the list of uploaded files
                    for (const file of uploadedFiles) {
                        document.write('<li>' + file + '</li>');
                    }
                </script> -->

                </p>

                <div class="line"></div> <!-- Line between title and content -->
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">DATE OF SUBMISSION :</span> <?php echo $submissionDate; ?></p>
            </div>

            <div class="info-section">
                <p><span style="font-weight: bold;">TIME OF SUBMISSION :</span> <?php echo $submissionTime; ?></p>
            </div>

    </div>



    <div class="box" style="margin-top: 15px; height:60%">
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
            <p style="font-family: 'Poppins', sans-serif; font-size: 90%">Status : <button style="background-color: #04AA6D; color: white; border-radius: 5px; width: 30%"> Active</button> </p>

            <?php
            $status = isset($tbl_submission_details['fld_status']) ? $tbl_submission_details['fld_status'] : '';

            if (!empty($status)) {
                if ($status == 'ACCEPTED' || $status == 'REJECTED') {
                    $text = 'COMPLETED';
                    $color = 'green';
                } elseif ($status == 'PENDING') {
                    $text = 'SUBMITTED FOR REVIEW';
                    $color = 'teal';
                } else {
                    // Handle o ther statuses if needed
                    $text = 'black'; // Change to the default color or customize as needed
                }
            
                echo '<p style="font-family: \'Poppins\', sans-serif; font-size: 90%; font-weight: bold">Review Status : <span style="font-weight: bold; color: ' . $color . '">' . $text . '</span></p>';
            } else {
                // Handle the case when status is empty
                echo '<p style="font-family: \'Poppins\', sans-serif; font-size: 90%; font-weight: bold">Review Status: <span style="font-weight: bold; color: gray">No Status</span></p>';
            }
            ?>

            <?php
            $status = isset($tbl_submission_details['fld_status']) ? $tbl_submission_details['fld_status'] : '';

            if (!empty($status)) {
                if ($status == 'ACCEPTED') {
                    $color = 'green';
                } elseif ($status == 'REJECTED') {
                    $color = 'red';
                } else {
                    // Handle other statuses if needed
                    $color = 'orange'; // Change to the default color or customize as needed
                }

                echo '<p style="font-family: \'Poppins\', sans-serif; font-size: 90%; font-weight: bold">Submission Status : <span style="font-weight: bold; color: ' . $color . '">' . $status . '</span></p>';
            } else {
                // Handle the case when status is empty
                echo '<p style="font-family: \'Poppins\', sans-serif; font-size: 90%; font-weight: bold">Submission Status: <span style="font-weight: bold; color: gray">No Status</span></p>';
            }
            ?>

            </p>
        </div>
    </div>



</body>

</html>