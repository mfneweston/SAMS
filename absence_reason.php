<?php

include_once 'session.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Reason</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #0098B9, #ECF6F9);
        }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        img {
            width: 250px;
            height: auto;
        }

        .logo {
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .img-user {
            position: absolute;
            top: 10px;
            left: 20px;
            display: flex;
            align-items: center;

        }

        .img-user span {
            padding-left: 10px;

        }

        .logout-button {
            background-color: #04AA6D;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .home-button {
            background: #f1f1f1;
            color: black;

            padding: 8px 16px;
            border-radius: 30px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .box {
            background: #DEDBDB;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 800px;
            text-align: center;
            display: top;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 200px;
            font-family: 'Poppins', sans-serif;
        }

        .btn {
            width: 120px;
            height: 40px;
            background: linear-gradient(0deg, #D9D9D9, #3168F4);
            margin-right: 20px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            color: #000000;
            font-size: 15px;
            
        }
    </style>
</head>

<body>

    <?php
    try {
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
        echo "Error: " . $e->getMessage();
    }
    ?>


    <div>
        <div class="img-user">

            <?php
            if (!empty($readrow['fld_user_image'])) {
                echo '<img src="pictures/' . $readrow['fld_user_image'] . '" alt="Your Image Description"  style="width: 50px;height:60px;">';
            } else {
                echo '<img src="pictures/no_photo.jpg" alt="No Photo"  style="width: 50px;height:60px;"">';
            }
            ?>

            <span><?php echo $readrow['fld_user_id']; ?></span>-
            <span><?php echo $readrow['fld_user_name']; ?></span>
        </div>


            <a style="font-family: 'Poppins', sans-serif; font-size: 90%; " href="absence_period.php" class="logout-button">Back</a>


    </div>





    <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div>





    <div class="box">

        <?php
        // Check if $result is not empty before using foreach
        if (!empty($result)) {
            foreach ($result as $readrow) { 
        ?>
                <div>
                    <button class="btn btn-primary" onclick="window.location.href='medical.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">MEDICAL</button>
                    <button class="btn btn-primary" onclick="window.location.href='event.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">EVENTS</button>
                    <button class="btn btn-primary" onclick="window.location.href='personal.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">PERSONAL</button>
                </div>
        <?php
            }
        } else {
            // Handle the case where $result is empty
            echo "No enrolled courses found for the user.";
        }
        ?>


        <div>
            <h5 style="margin-top: 50px; font-weight:bold;">PLEASE SELECT YOUR ABSENCE REASON</h5>

            <script>
                // Retrieve the selected period from localStorage
                var selectedAbsencePeriod = localStorage.getItem("selectedAbsencePeriod");

                // Set the value in a hidden input field
                document.getElementById("selectedPeriod").value = selectedAbsencePeriod;
            </script>


        </div>

    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>