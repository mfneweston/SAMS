<?php
include_once 'database.php';

session_start();

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_SESSION['userid'];

if ($id == '') {
    header("location: login_page.php");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_user_details WHERE fld_user_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);

    $id = $readrow['fld_user_id'];
    $name = $readrow['fld_user_name'];
    $faculty = $readrow['fld_user_faculty'];
    $email = $readrow['fld_user_email'];
    $pass = $readrow['fld_user_password'];
    $role = $readrow['fld_user_role'];
    $course = $readrow['fld_user_course'];
    $intake = $readrow['fld_intake'];
    $image = $readrow['fld_user_image'];
}
?>
