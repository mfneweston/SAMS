<?php  
//include_once 'database.php';
include_once 'db.php';
include_once 'session.php';
//$pos = $readrow['FLD_POSITION'];
//login_success.php  

 	if(isset($_SESSION["userid"]))  
 	{  
     	echo '<script type="text/javascript">'; 
     	if($role==="Admin") {
		echo 'alert("Welcome '.$name.' to SAMS ! Your Privilege is: Admin");'; 
		echo 'window.location.href = "admin_menu.php";';
		}
		elseif ($role === "Lecturer"){
			echo 'alert("Welcome '.$name.' to SAMS ! Your Privilege is: Lecturer");'; 
			echo 'window.location.href = "lecturer_menu.php";';

		}
        else{
            echo 'alert("Welcome '.$name.' to SAMS ! Your Privilege is: Student");'; 
			echo 'window.location.href = "student_menu.php";';
        }


		echo '</script>';
 	}  
 	else  
 	{  
	   	echo '<script type="text/javascript">'; 
		echo 'alert("Please Login First!");'; 
		echo 'window.location.href = "login_page.php";';
		echo '</script>';
 	}  
 ?> 