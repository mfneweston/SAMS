<?php
include_once 'db.php';
include_once 'session.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$submission_id = isset($_GET['submission_id']) ? $_GET['submission_id'] : '';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #0098B9, #ECF6F9);
            margin: 0;
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

        .container {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
            margin-bottom: 3px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .info-section {
            width: 25%;
            text-align: center;
            margin-top: 10px;
        }

        /*.logo {
            position: absolute;
            bottom: 0;
            left: 0;
        }*/

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

        .logout-button {
            font-family: 'Poppins', sans-serif;
            font-size: 90%;
            font-weight: bold;
            /* Added font-weight property */
            background: #f1f1f1;
            color: black;
            padding: 8px 16px;
            border-radius: 30px;
            border: 3px solid #000000;
            /* Added border property */
            position: absolute;
            top: 30px;
            right: 30px;
        }


        .buttons-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .edit-button,
        .remove-button {
            display: inline-block;
            font-size: 90%;
            font-weight: bold;
            /* Added font-weight property */
            padding: 10px 8px;
            background-color: rgba(123, 147, 255, 0.8);
            color: #000000;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 0 10px;
        }

        .edit-button:hover,
        .remove-button:hover {
            background-color: #ffff;
        }

        .boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
            width: 100%;
        }

        .box {
            flex: 1 1 calc(50% - 20px);
            background: #D3D3D3;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        textarea {
            width: 100%;
            max-width: calc(100% - 40px);
            margin: 5px 0;
            box-sizing: border-box;
            max-height: calc(100% - 40px);
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'Poppins', sans-serif;
        }

        .additional-box {
            background: #D3D3D3;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 640px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            margin-left: auto;
            margin-right: auto;
            justify-content: center;
            height: 200px;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .drop-area {
            width: 80%;
            margin: auto;
            border: 2px dashed rgba(123, 147, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            margin-top: 20px;
            cursor: pointer;
        }

        .file-input-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .file-input-btn:hover {
            background-color: #0056b3;
        }

        .info-section {
            width: 15%;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            max-width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            padding: 20px;
            box-sizing: border-box;
            max-height: 100%;
        }

        th,
        td {
            border: 3px solid #000;
            padding: 12px;
            text-align: center;
            width: 33.33%;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>

<body>

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

    <?php
    try {
        $stmt = $conn->prepare("SELECT *
                            FROM tbl_submission_details
                            WHERE fld_user_id = :user_id AND fld_submission_id = :submission_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':submission_id', $submission_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);



        if ($result) {
            $readrow = $result[0]; // Fetch the first row
            $tbl_submission_details = $readrow; // Use $readrow as user details
            $tbl_user_details = $readrow; // Use $readrow as user details
        } else {
            echo "No results found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>


    <!--  <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div> -->



    <div class="buttons">
        <button onclick="location.href='upload_history.php'" class="next">Back</button>
    </div>



    <a href="logout.php" class="logout-button">Logout</a>

    <div class="additional-box">
        <div style="left: 0px">
            <p>TITLE:
                <span><?php echo isset($tbl_submission_details['fld_absence_title']) ? $tbl_submission_details['fld_absence_title'] : ''; ?></span>
            </p>
        </div>

        <div class="textarea" style="margin-top: 15px; overflow: hidden; font-size: 10;">
            <p>DESCRIPTION:
                <span><?php echo isset($tbl_submission_details['fld_absence_desc']) ? $tbl_submission_details['fld_absence_desc'] : ''; ?></span>
            </p>
        </div>
    </div>


    <div class="container">
        <div class="info-section">
            <p>COURSE :</p>
            <p><?php echo isset($tbl_submission_details['fld_course_name']) ? $tbl_submission_details['fld_course_name'] : ''; ?></p>
        </div>

        <div class="info-section">
            <p>LECTURER :</p>
            <p><?php echo isset($tbl_submission_details['fld_lecturer_name']) ? $tbl_submission_details['fld_lecturer_name'] : ''; ?></p>
        </div>

        <div class="info-section">
            <p>TIME :</p>
            <p><?php echo isset($tbl_submission_details['fld_time']) ? $tbl_submission_details['fld_time'] : ''; ?></p>
        </div>

        <div class="info-section">
            <p>DURATION :</p>
            <p><?php echo isset($tbl_submission_details['fld_course_duration']) ? $tbl_submission_details['fld_course_duration'] : ''; ?></p>
        </div>
    </div>

    <div class="buttons-container">
        <a href="#" class="edit-button">EDIT SUBMISSION</a>
        <a href="#" class="remove-button">REMOVE SUBMISSION</a>
    </div>

    <div class="boxes">
        <div class="box">
            <div class="table-container" style="margin-top: -5px; width: 100%; max-width: 800px;">
                <table style="width: 100%; max-width: 100%;">
                    <tr>
                        <td style="background-color: white;">Submission Status</td>
                        <td style="background-color: white;">Submitted for review</td>
                    </tr>
                    <tr>
                        <td style="background-color: darkgrey;">Approval Status</td>
                        <td style="background-color: darkgrey;">Pending</td>
                    </tr>
                    <tr>
                        <td style="background-color: white;">Uploaded Document</td>
                        <td style="background-color: white;">A187291.pdf</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        function dragOverHandler(event) {
            event.preventDefault();
        }

        function dropHandler(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            for (const file of files) {
                console.log(file.name);
            }
        }

        function fileInputChangeHandler(event) {
            const files = event.target.files;
            for (const file of files) {
                console.log(file.name);
            }
        }
    </script>
</body>

</html>