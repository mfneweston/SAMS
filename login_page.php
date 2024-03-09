<?php

include_once 'db.php';
session_start();
if (isset($_SESSION["userid"])) {

  if ($role === "Admin") {
    header("location:admin_menu.php");
  } 
  
  elseif ($role === "Lecturer") {
    header("location:lecturer_menu2.php");
  } 

  else {
    header("location:student_menu.php");
  } 
}

try {
  // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if (isset($_POST["login"])) {
    if (empty($_POST["userid"]) || empty($_POST["pass"])) {
      $message = '<label>All fields are required</label>';
    } else {
      $query = "SELECT * FROM tbl_user_details WHERE fld_user_id = :userid AND BINARY fld_user_password = :pass";
      $stmt = $conn->prepare($query);
      $stmt->execute(
        array(
          'userid'     =>     $_POST["userid"],
          'pass'     =>     $_POST["pass"]
        )
      );
      $count = $stmt->rowCount();
      if ($count > 0) {

        $_SESSION["userid"] = $_POST["userid"];



        header("location:login_success.php");
      } else {
        $message = '<label>Wrong Password or User ID</label>';
      }
    }
  }
} catch (PDOException $error) {
  $message = $error->getMessage();
}
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">



<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration or Sign Up form in HTML CSS | CodingLab </title>
  <link rel="stylesheet" href="style.css">


</head>

<body>


  <div class="wrapper">
    <form method="post">

      <h3 style="font-family: 'Poppins', sans-serif; margin-bottom: 20px; color: black; font-weight: normal; font-size: 16px">Student Absenteeism Management System </h3>


    <h2>Login</h2>

    

      <div class="input-box">
        <input type="text" name="userid" id="userid" placeholder="User ID" class="form-control" required>
      </div>
      <div class="input-box password-container">
                <input type="password" name="pass" id="pass" placeholder="Password" class="form-control" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">(><)</span>
            </div>

      <div class="input-box button">
        <input type="submit" name="login" class="btn mt-3" value="Login">
      </div>
      <div class="text">
        <h3>Forgot Password? <a href="forgot_password.php">Click here</a></h3>
      </div>


    </form>

    <div class="text-center fs-6">
              <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?> 
                </div>


  </div>

 


</body>

 <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("pass");
            const toggleButton = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.textContent = "(0.0)";
            } else {
                passwordInput.type = "password";
                toggleButton.textContent = "(><)";
            }
        }
    </script>

<img src="pictures/ukm-logo.png" alt="Your Image Description">

<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');


  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;


  }

  img {
    position: absolute;
    top: 20%;
    right: 15%;
    width: 500px;
    /* Adjust the width as needed */
    height: auto;
    /* Adjust the height as needed, 'auto' maintains aspect ratio */
  }

     .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4070f4;
            font-size: 14px;
            text-decoration: underline;
            user-select: none;
        }


  body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-left: 200px;
    background: linear-gradient(to right, #0098B9, #ECF6F9);
        min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    margin-left: 200px;
    background: linear-gradient(to right, #0098B9, #ECF6F9);
    background-image: url('pictures/BOOK.jpg'); /* Add this line with the correct path to your image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .wrapper {
    position: relative;
    max-width: 430px;
    width: 100%;
    background: #fff;
    padding: 34px;
    border-radius: 6px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  }

  .wrapper h2 {
    position: relative;
    font-size: 22px;
    font-weight: 600;
    color: #333;
  }

  .wrapper h2::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 28px;
    border-radius: 12px;
    background: #4070f4;
  }

  .wrapper form {
    margin-top: 30px;
  }

  .wrapper form .input-box {
    height: 52px;
    margin: 18px 0;
  }

  form .input-box input {
    height: 100%;
    width: 100%;
    outline: none;
    padding: 0 15px;
    font-size: 17px;
    font-weight: 400;
    color: #333;
    border: 1.5px solid #C7BEBE;
    border-bottom-width: 2.5px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .input-box input:focus,
  .input-box input:valid {
    border-color: #4070f4;
  }

  form .policy {
    display: flex;
    align-items: center;
  }

  form h3 {
    color: #707070;
    font-size: 14px;
    font-weight: 500;
    margin-left: 10px;
  }

  .input-box.button input {
    color: #fff;
    letter-spacing: 1px;
    border: none;
    background: #4070f4;
    cursor: pointer;
  }

  .input-box.button input:hover {
    background: #0e4bf1;
  }

  form .text h3 {
    color: #333;
    width: 100%;
    text-align: center;
  }

  form .text h3 a {
    color: #4070f4;
    text-decoration: none;
  }

  form .text h3 a:hover {
    text-decoration: underline;
  }
</style>


</html>