<?php
include_once 'db.php';
include_once 'session.php';


$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$course_code = isset($_GET['course_code']) ? $_GET['course_code'] : '';


// Define default values for title and description
$title = isset($_GET['title']) ? $_GET['title'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';

?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    const uploadedFiles = [];

    <?php
    // Check if the PHP variable $_SESSION['uploaded_files'] is set
    if (isset($_SESSION['uploaded_files']) && is_array($_SESSION['uploaded_files'])) {
        // Transfer the PHP array to JavaScript
        echo 'uploadedFiles = ' . json_encode($_SESSION['uploaded_files']) . ';';
    }
    ?>

    function dragOverHandler(event) {
        event.preventDefault();
        // Add your styling for drag over if needed
    }

    function dropHandler(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        // Process dropped files here
        // Example: you can loop through files and perform actions
        for (const file of files) {
            console.log(file.name); // This will log the name of each dropped file
            // Add your file handling logic here
        }
    }


    // Function to handle file input change
    function fileInputChangeHandler(event) {
        const files = event.target.files;
        const fileList = document.getElementById("fileList");

        // Clear the previous file list
        fileList.innerHTML = "";

        // Process selected files and update the file list
        for (const file of files) {
            console.log(file.name); // This will log the name of each selected file

            // Create a list item for each file and append it to the file list
            const listItem = document.createElement("li");
            listItem.textContent = file.name;
            fileList.appendChild(listItem);

            // Add your additional file handling logic here
        }

        // Display the uploaded file names from the JavaScript variable
        for (const uploadedFile of uploadedFiles) {
            const listItem = document.createElement("li");
            listItem.textContent = uploadedFile;
            fileList.appendChild(listItem);
        }
    }

    // Function to handle form submission using AJAX
    function submitFormAjax() {
        if (validateForm()) {
            var titleElement = document.getElementById('title');
            var selectedOption = titleElement.options[titleElement.selectedIndex];
            var title = selectedOption.value;
            var title_id = selectedOption.getAttribute('data-absence-id');
            var description = document.getElementById('description').value;
            var inputDate = document.getElementById('inputDate').value;

            var formData = new FormData();
            formData.append('user_id', '<?php echo $user_id; ?>');
            formData.append('course_code', '<?php echo $course_code; ?>');
            formData.append('title', title);
            formData.append('title_id', title_id);
            formData.append('description', description);
            formData.append('inputDate', inputDate);

            // Append uploaded files
            var fileList = document.getElementById('fileList').getElementsByTagName('li');
            for (var i = 0; i < fileList.length; i++) {
                formData.append('uploadedFiles[]', fileList[i].textContent);
            }

            // Use AJAX to send form data
            $.ajax({
                url: 'medical_crud.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Data sent successfully');
                    console.log(response); // Log the response from the server

                    // Display the response on the page (replace or append as needed)
                    alert(response); // You can use any other method to display the response
                },
                error: function(error) {
                    console.error('Error sending data:', error);
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Display the uploaded file names from the JavaScript variable
        const fileList = document.getElementById("fileList");
        for (const uploadedFile of uploadedFiles) {
            const listItem = document.createElement("li");
            listItem.textContent = uploadedFile;
            fileList.appendChild(listItem);
        }

        // Add event listener to the form for form validation
        const submissionForm = document.getElementById("submissionForm");
        submissionForm.addEventListener('submit', function(event) {
            if (!validateForm()) {
                // Prevent the form submission if validation fails
                event.preventDefault();
                submitFormAjax();
            }
        });
    });

    function validateForm() {
        var title = document.getElementById('title').value;
        var description = document.getElementById('description').value;
        var inputDate = document.getElementById('inputDate').value;
        var fileList = document.getElementById('fileList').getElementsByTagName('li');

        // Add your validation logic here
        if (title === '' || description === '' || inputDate === '' || fileList.length === 0) {
            alert('Please fill in all required fields and upload at least one file.');
            return false;
        }

        // Additional validation logic can be added here

        return true;
    }

    function redirectToSubmission() {
        if (validateForm()) {
            // Continue with the redirection
            var titleElement = document.getElementById('title');
            var selectedOption = titleElement.options[titleElement.selectedIndex];
            var title = selectedOption.value; // This will be the absence_title
            var title_id = selectedOption.getAttribute('data-absence-id'); // This will be the absence_id
            var description = document.getElementById('description').value;

            // Ensure uploadedFiles is defined and not empty
            var uploadedFiles = typeof uploadedFiles !== 'undefined' ? uploadedFiles : [];

            // Get the fileList from the DOM
            var fileList = document.getElementById('fileList').getElementsByTagName('li');
            var fileNames = [];

            // Extract file names from the list items
            for (var i = 0; i < fileList.length; i++) {
                fileNames.push(fileList[i].textContent);
            }

            // Retrieve the selected date
            var inputDate = document.getElementById('inputDate').value;

            // Redirect to submission.php with parameters
            window.location.href = 'submission.php?user_id=<?php echo $user_id; ?>&course_code=<?php echo $course_code; ?>&title=' + encodeURIComponent(title) + '&title_id=' + encodeURIComponent(title_id) + '&description=' + encodeURIComponent(description) + '&file_list=' + encodeURIComponent(JSON.stringify(fileNames)) + '&inputDate=' + encodeURIComponent(inputDate);
        }
    }

    // Function to handle the form submission using AJAX
    function submitFormWithAjax() {
        if (validateForm()) {
            var formData = new FormData(document.getElementById("submissionForm"));

            $.ajax({
                url: 'medical_crud.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Data sent successfully');
                    alert(response);

                },
                error: function(error) {
                    console.error('Error sending data:', error);
                }
            });
        }
    }

    // Add an event listener to the form submission button
    $(document).ready(function() {
        $("#submitBtn").click(function(e) {
            e.preventDefault();
            submitFormWithAjax();
        });
    });
</script>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Uploads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


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
            padding: 20px;
            box-sizing: border-box;
            position: relative;
            margin-bottom: 30px
        }

        .logo {
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .next {
            position: absolute;
            bottom: 30px;
            right: 30px;
            background-color: rgba(123, 147, 255, 0.8);
            color: #ffffff;
            border-color: rgba(123, 147, 255, 0.8);
            font-family: 'Poppins', sans-serif;
            padding: 8px 16px;
            border-radius: 10px;

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

        .buttons {
            display: flex;
            justify-content: center;
            gap: 40px;
            top: 90px;
            width: 100%;
            padding: 0 20px;
            z-index: 10;
            /* Ensure the buttons are clickable */
        }

        .btn {
            width: 100px;
            height: 40px;
            background: rgba(123, 147, 255, 0.8);
            z-index: 10;
            /* Ensure the buttons are clickable */
        }

        .boxes {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;


        }

        .box {
            flex: 1 1 calc(50% - 20px);
            max-width: 500px;
            background: white;
            background-image: url(/pictures/background_reason.jpg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            font-family: 'Poppins', sans-serif;
            height: 370px;
        }


        textarea {
            width: 100%;
            max-width: calc(100% - 0px);
            /* Adjust as needed */
            margin: 5px 0;
            /* Adjust margins as needed */
            box-sizing: border-box;
            max-height: calc(100% - 40px);
            border-radius: 5px;
            border: 1px solid #ccc;
            /* Border style */
            resize: none;
            font-family: 'Poppins', sans-serif;

        }

        img {
            width: 210px;
            height: auto;
        }

        .additional-box {
            background: white;
            background-image: url(/pictures/background_reason.jpg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 820px;

            text-align: center;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 30px;
            margin-top: 40px;
            margin: auto;
            justify-content: center;
            height: 130px;
        }

        /* Style for the drag-and-drop area */
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

        .custom-btn {
            background-color: #001f3f;
            /* Dark blue color */
            /* Add any additional styling as needed */
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

        .file-input-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            /* Button background color */
            color: #fff;
            /* Text color */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .file-input-btn:hover {
            background-color: #0056b3;
            /* Change color on hover */
        }

        .info-section {
            width: 40%;
            /* Adjust the width as needed */
            font-family: 'Poppins', sans-serif;
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


        // Fetch activity names based on user ID from tbl_student_activity
        $stmt = $conn->prepare("SELECT fld_absence_id, fld_absence_title FROM tbl_absence_title WHERE fld_absence_id LIKE 'MA%'");
        $stmt->execute();
        $medical_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $medical_options = '';
        foreach ($medical_results as $medical) {
            $absence_id = $medical['fld_absence_id'];
            $medical_name = $medical['fld_absence_title'];
            $medical_options .= "<option value=\"$medical_name\" data-absence-id=\"$absence_id\">$medical_name</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>




    <div class="buttons">
        <?php
        // Check if $result is not empty before using foreach
        if (!empty($result)) {
            foreach ($result as $readrow) {
        ?>
                <div class="buttons" style="margin-top: 15px;">
                    <button class="btn btn-primary custom-btn" onclick="window.location.href='medical.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">MEDICAL</button>
                    <button class="btn btn-primary" onclick="window.location.href='event.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">EVENTS</button>
                    <button class="btn btn-primary" onclick="window.location.href='personal.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">PERSONAL</button>
                </div>
        <?php
            }
        } else {
            // Handle the case where $result is empty
            echo "No enrolled courses found for the user.";
        }

        if (isset($readrow) && !empty($readrow)) {
            // Check if the key exists in the array before accessing it
            $absence_title = isset($readrow['fld_absence_title']) ? $readrow['fld_absence_title'] : '';
        }
        ?>
    </div>



    <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div>

    <div>
        <button class="next" name="submit" onclick="redirectToSubmission()">Next ></button>

    </div>

    <a style="font-family: 'Poppins', sans-serif; font-size: 90%; " href="absence_period.php" class="logout-button">Back</a>

    <div class="form-group">
        <div class="additional-box" style="margin-top: 50px; max-height: 300px; display: flex; justify-content: center;">
            <div class="info-section">
                <p style="font-weight: bold;">COURSE :</p>
                <p><?php echo isset($tbl_course_details['fld_course_name']) ? $tbl_course_details['fld_course_name'] : ''; ?></p>

            </div>
            <div class="info-section">
                <p style="font-weight: bold;">LECTURER :</p>
                <p><?php echo isset($tbl_course_details['lecturer_name']) ? $tbl_course_details['lecturer_name'] : ''; ?></p>
            </div>
            <div class="info-section">
                <p style="font-weight: bold;">TIME :</p>
                <p><?php echo isset($tbl_course_details['fld_time']) ? $tbl_course_details['fld_time'] : ''; ?></p>
            </div>
            <div class="info-section">
                <p style="font-weight: bold;">DURATION :</p>
                <p><?php echo isset($tbl_course_details['fld_course_duration']) ? $tbl_course_details['fld_course_duration'] : ''; ?></p>
            </div>
        </div>

        <form method="post" action="medical_crud.php" enctype="multipart/form-data" id="submissionForm">
            <div class="boxes">
                <div class="box">

                    <div style="text-align: left; ">
                        <label for="inputDate">DATE OF ABSENCE:</label>
                        <input class="form-control" type="date" id="inputDate" name="inputDate" style="background-color: white; color: black" required>
                    </div>

                    <label for="title" style="display: block; text-align: left; margin-top: 10px;">TITLE:</label>
                    <select style="margin-top: 10px; background-color: white;" name="title" class="form-control" id="title" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_absence_title']; ?>" required>
                        <option value=""> Select Medical Reason</option>
                        <?php echo $medical_options; ?>
                    </select>

                    <div class="textarea" style="margin-top: 20px; overflow: hidden; font-size: 15;">
                        <label for="Description" style="display: block; text-align: left;">DESCRIPTION:</label>
                        <textarea id="description" name="Description" rows="5" cols="40" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_absence_desc']; ?>" style="margin-left: 0;" required></textarea>
                    </div>
                </div>
                <div class="box">
                    <div class="drop-area" id="dropArea" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
                        <p>CHOOSE YOUR FILES HERE:</p>
                        <p>(VERIFIED BY DOCTOR)</p>
                        <label for="fileInput" class="file-input-btn">
                            Choose Files
                        </label>
                        <input id="fileInput" type="file" name="fileInput" multiple onchange="fileInputChangeHandler(event);" required>
                    </div>

                    <div style="display: inline-block; align-items:center;">
                        <ul id="fileList"></ul>
                    </div>

                    <div style="margin-top: 20px;">
                        <input id="submitBtn" style="background-color:#001f3f; color:#fff;" type="button" value="Upload File">
                    </div>


                    <!-- Display the uploaded file names -->
                    <!-- <div style="display: none; align-items:center;">
                        <p>Uploaded Files:</p>
                        <ul id="fileList"></ul>
                    </div> -->
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>