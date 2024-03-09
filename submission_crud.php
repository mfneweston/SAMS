<?php

include_once 'database.php';

// Initialize $file_upload
$file_upload = '';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the directory if it doesn't exist
$uploadDirectory = 'uploads/ProofDocument/';
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}
// Check if form is submitted
if (isset($_POST['create'])) {

    try {

        // Fetch the last submission ID from the database
        $stmt = $conn->prepare("SELECT MAX(fld_submission_id) as max_id FROM tbl_submission_details");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastSubmissionId = $result['max_id'];

        // Extract the numeric part and increment
        $numericPart = (int)substr($lastSubmissionId, 1); // Extract the numeric part and convert to integer
        $newNumericPart = $numericPart + 1;

        // Create the new submission ID
        $submission_id = 'S' . str_pad($newNumericPart, 2, '0', STR_PAD_LEFT); // Ensure it's two digits with leading zeros if necessary

        // Handle file uploads
        $uploadedFiles = isset($_POST['file_upload']) ? $_POST['file_upload'] : [];
        $file_upload = implode(',', $uploadedFiles);

        // Retrieve the absence_type based on title_id prefix
        $absenceType = getAbsenceType($_POST['title_id']);

        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO tbl_submission_details
        (fld_submission_id, fld_user_id, fld_submission_date, fld_submission_time, fld_course_code, fld_course_name, fld_lecturer_name, fld_course_duration, fld_time,fld_absence_date, fld_absence_type, fld_absence_title, fld_absence_desc, fld_file_upload, fld_status)
        VALUES(:submission_id, :user_id, :submission_date, :submission_time, :course_code, :course_name, :lecturer_name, :course_duration, :course_time,:absence_date, :absence_type, :title, :description, :file_upload, :status)");

        $stmt->bindParam(':submission_id', $submission_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':submission_date', $submission_date, PDO::PARAM_STR);
        $stmt->bindParam(':submission_time', $submission_time, PDO::PARAM_STR);
        $stmt->bindParam(':course_code', $course_code, PDO::PARAM_STR);
        $stmt->bindParam(':course_name', $course_name, PDO::PARAM_STR);
        $stmt->bindParam(':lecturer_name', $lecturer_name, PDO::PARAM_STR);
        $stmt->bindParam(':course_duration', $course_duration, PDO::PARAM_STR);
        $stmt->bindParam(':course_time', $course_time, PDO::PARAM_STR);
        $stmt->bindParam(':absence_date', $absence_date, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':absence_type', $absenceType, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':file_upload', $file_upload, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        // Assign values after binding
        $user_id = $_POST['user_id'];
        $submission_date = $_POST['submission_date'];
        $submission_time = $_POST['submission_time'];
        $course_code =  $_POST['course_code'];
        $course_name = $_POST['course_name'];
        $lecturer_name = $_POST['lecturer_name'];
        $course_duration = $_POST['course_duration'];
        $course_time = $_POST['course_time'];
        $absence_date = $_POST['absence_date'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = isset($_POST['status']) ? $_POST['status'] : 'PENDING';

        $stmt->execute();

        echo '<script>alert("Submission record created successfully.");</script>';
        echo '<script>window.location.href = "student_menu.php";</script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

// Function to determine absence_type based on title_id prefix
function getAbsenceType($titleId)
{
    $prefix = strtoupper(substr($titleId, 0, 2)); // Extract the first two characters (prefix) and convert to uppercase

    if ($prefix == 'MA') {
        return 'MEDICAL';
    } elseif ($prefix == 'PA') {
        return 'PERSONAL';
    } elseif ($prefix == 'AA') {
        return 'EVENT';
    } else {
        return ''; // Handle other cases as needed
    }
}
?>
