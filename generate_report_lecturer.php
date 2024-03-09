<?php
include_once 'db.php';
include_once 'session.php';
include_once 'sidebar_lecturer.php';


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Student Absence</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        a {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
        }

        a:hover {
            background-color: #ddd;
            color: black;
            border-radius: 30px
        }

        .previous {
            background-color: #f1f1f1;
            color: black;
            font-weight: bold;
            font-size: 30px;
            position: absolute;
            top: 0;
            left: 0;
            margin: 20px;
            /* Adjust the margin for the desired positioning */
            border-radius: 50%;
            padding: 8px 12px;
        }

        .next {
            background-color: #04AA6D;
            color: white;
        }

        .select {
            display: flex;
            justify-content: center;
            gap: 40px;
            top: 90px;
            width: 100%;
            padding: 0 20px;
            z-index: 10;
            /* Ensure the buttons are clickable */
        }

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
            width: 250px;
            height: auto;
        }

        .img-time {
            width: 25px;
            height: auto;
            margin-right: 2px;
        }

        /* Apply flex properties to the container div */
        .record-container {
            display: flex;
            align-items: flex-start;
            /* Align items to the start of the flex container */
        }

        .img-record {
            width: 25px;
            height: auto;
            margin-top: 5px;
            margin-right: 2px;
            color: #000000;
        }

        .record {
            margin-right: -22px;
            margin-top: 10px;
            color: black;
        }



        .now-showing {
            margin-right: -22px;
            color: #fff;
        }

        /*.record {
                margin-right: -22px;
                color: #000000;
                }*/

        h3 {
            font-family: 'Poppins', sans-serif;
        }

        .logo {
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .buttons {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
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

        .box img {
            max-width: 100%;
        }

        .upload-button {
            padding: 15px 210px;
        }

        .upload-button2 {
            padding: 15px 175px;
        }

        .logout-button {
            background: #f1f1f1;
            color: black;

            padding: 8px 16px;
            border-radius: 30px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .home-button {
            background: #f1f1f1;
            color: black;

            padding: 8px 16px;
            border-radius: 30px;
            position: absolute;
            top: 20px;
            right: 150px;
        }


        .search-box input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 10px 20px;
            background-color: #04AA6D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            /* Increase the distance between the search boxes and the box */
            padding: 20px;
        }

        .search-box select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
            /* Add margin-right to create space between select and button */
        }

        .box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            /* Set width to occupy 33.33% of the container minus margin */

            text-align: center;
            display: top;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
            overflow-x: auto;
            margin-top: 20px;
        }

        .box-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            margin-top: 20px;
            width: 1000px;
        }

        .box-container-two {
            display: flex;
            flex-direction: row;
            gap: 20px;
            justify-content: center;
            width: 1000px;
            margin-bottom: 30px;
        }



        .box table {
            width: 100%;
            border: 20px solid black;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        .box tbody tr:hover {
            background-color: rgba(4, 170, 109, 0.1);
        }

        .select-button {
            padding: 10px 20px;
            background-color: #007187;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .select-button:hover {
            background-color: #0080A0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #0080A0;
            color: black;
            text-align: center;
            padding: 12px;
        }

        td {
            border: 0.5px solid #d3d3d3;
            text-align: center;
            padding: 8px;
        }
    </style>

</head>


<body>





    <?php



    // Fetch the current user's ID from the session (assuming the session variable holding the user ID is $id)
    //$currentUserID = $_SESSION[$id];
    // SQL query to retrieve courses held by the current user (lecturer) based on their ID

    // Check if the form is submitted and the selected month is set
    // Check if the form is submitted and the selected month is set
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search1']) && isset($_POST['searchYear']) && isset($_POST['searchCourse'])) {
        $selectedMonth = $_POST['search1'];
        $selectedYear = $_POST['searchYear'];
        $selectedCourse = $_POST['searchCourse'];
    } else {
        // Default to 'All' if no specific month is selected
        $selectedMonth = 'All';
        // Default to the current year
        $selectedYear = 'All';
        $selectedCourse = 'All';
    }




    try {
        $stmtCourses = $conn->prepare(
            "
                SELECT 
                    COUNT(*) AS total_absences, 
                    cd.fld_course_code, 
                    MAX(cd.fld_course_name) AS fld_course_name,
                    MONTHNAME(sd.fld_absence_date) AS absence_month
                FROM 
                    tbl_course_details cd
                JOIN 
                    tbl_submission_details sd ON cd.fld_course_code = sd.fld_course_code
                JOIN 
                    tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
                WHERE 
                    sd.fld_lecturer_name = :name
                    AND sd.fld_status = 'ACCEPTED'
                    AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
                    AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
                    AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
                    
                GROUP BY 
                    cd.fld_course_code, absence_month
                ORDER BY 
                    absence_month;"
        );


        $stmtCourses->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtCourses->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtCourses->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtCourses->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);

        $stmtCourses->execute();

        $coursesWithAbsences = $stmtCourses->fetchAll(PDO::FETCH_ASSOC);

        $courseTotals = []; // Associative array to store total absences for each course

        foreach ($coursesWithAbsences as $course) {
            $courseCode = $course['fld_course_code'];
            $courseName = $course['fld_course_name'];
            $absenceMonth = $course['absence_month'];
            $totalAbsences = $course['total_absences'];

            // Create a unique key for each course
            $courseKey = "$courseCode - $courseName";

            // If the course is already in the associative array, update the total absences
            if (isset($courseTotals[$courseKey])) {
                $courseTotals[$courseKey] += $totalAbsences;
            } else {
                // If the course is not in the array, add it with the current total absences
                $courseTotals[$courseKey] = $totalAbsences;
            }
        }

        // Extract values and labels from the associative array
        $values = array_values($courseTotals);
        $labels = array_keys($courseTotals);

        $bar_chart_data = [
            'values' => $values,
            'labels' => $labels
        ];

        // echo json_encode($bar_chart_data);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


    /*    echo "<pre>";
        echo "Bar Chart Data:<br>";
        var_dump($bar_chart_data); // Output the contents of the $bar_chart_data array
        echo "</pre>";*/

    try {
        // Fetch data for the barchart (student IDs and total absences)
        $stmt = $conn->prepare("
                SELECT CONCAT(u.fld_user_id, ' ', u.fld_user_name) AS student_details, COUNT(*) AS total_absences
                FROM tbl_submission_details sd
                JOIN tbl_user_details u ON sd.fld_user_id = u.fld_user_id
                
                WHERE sd.fld_lecturer_name = :name 
                AND sd.fld_status = 'ACCEPTED'
                AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
                AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
                AND (:selectedCourse = 'All' OR u.fld_user_course = :selectedCourse)
                GROUP BY student_details
                ORDER BY total_absences DESC
                LIMIT 5
                ");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);

        $stmt->execute();
        $barChart2Data = $stmt->fetchAll(PDO::FETCH_ASSOC);



        // Prepare arrays for chart labels and data
        $barChart2Labels = [];
        $barChart2DataValues = [];

        // Loop through the fetched data and populate chart arrays
        foreach ($barChart2Data as $row) {
            $barChart2Labels[] = $row['student_details'];
            $barChart2DataValues[] = $row['total_absences'];
        }

        // Convert chart data to JSON format
        $barChart2Dataset = [
            'labels' => $barChart2Labels,
            'values' => $barChart2DataValues
        ];
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }









    try {

        // Fetch data from your table in PHP
        //pie chart

        $stmt = $conn->prepare("SELECT COUNT(*) as total, fld_absence_type 
            FROM tbl_submission_details 
            JOIN tbl_user_details 
            ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            WHERE fld_lecturer_name = :name 
            AND fld_status = 'ACCEPTED' 
            AND (:selectedMonth = 'All' OR MONTHNAME(fld_absence_date) = :selectedMonth) 
            AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
            GROUP BY fld_absence_type");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);





        // Fetch data for the line chart (absence month and total students absent for all years)
        $stmt = $conn->prepare("
        SELECT 
        YEAR(fld_absence_date) AS absence_year,
        MONTH(fld_absence_date) AS absence_month,
        COUNT(fld_user_id) AS total_absent_students
    FROM tbl_submission_details 
    WHERE fld_status = 'ACCEPTED'
        AND fld_lecturer_name = :name
    GROUP BY absence_year, absence_month
    ORDER BY absence_year, MONTH(fld_absence_date);
            ");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        $stmt->execute();
        $lineChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Prepare arrays for chart labels and data
        $labels = [];
        $values = [];
        $lineChartLabels = [];
        $lineChartDataValues = [];

        // Loop through the fetched data and populate chart arrays
        foreach ($data as $row) {
            $labels[] = $row['fld_absence_type'];
            $values[] = $row['total'];
        }

        // Convert chart data to JSON format
        $chart_data = [
            'labels' => $labels,
            'values' => $values
        ];

        // Loop through the fetched data and populate chart arrays for line chart
        foreach ($lineChartData as $row) {
            $lineChartLabels[] = $row['absence_month'];
            $lineChartDataValues[] = $row['total_absent_students'];
        }
        $lineChartDataset = [
            'labels' => $lineChartLabels,
            'values' => $lineChartDataValues
        ];

        //echo json_encode($chart_data); // Add this line for debugging


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    //documents COunt

    try {
        // Modify your SQL query to include conditions for the selected filters
        $stmtPendingDocuments = $conn->prepare("
            SELECT COUNT(*) as pending_count
            FROM tbl_submission_details sd
            JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
            WHERE sd.fld_lecturer_name = :name
            AND sd.fld_status = 'PENDING'
            AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
            AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
            ");

        $stmtPendingDocuments->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtPendingDocuments->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtPendingDocuments->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtPendingDocuments->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        $stmtPendingDocuments->execute();

        $pendingDocumentsCount = $stmtPendingDocuments->fetch(PDO::FETCH_ASSOC)['pending_count'];

        //ACCEPTED

        $stmtAcceptedDocuments = $conn->prepare("
            SELECT COUNT(*) as accepted_count
            FROM tbl_submission_details sd
            JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
            WHERE sd.fld_lecturer_name = :name
            AND sd.fld_status = 'ACCEPTED'
            AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
            AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
            ");

        $stmtAcceptedDocuments->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtAcceptedDocuments->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtAcceptedDocuments->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtAcceptedDocuments->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        $stmtAcceptedDocuments->execute();

        $acceptedDocumentsCount = $stmtAcceptedDocuments->fetch(PDO::FETCH_ASSOC)['accepted_count'];

        //REJECTED

        $stmtRejectedDocuments = $conn->prepare("
            SELECT COUNT(*) as rejected_count
            FROM tbl_submission_details sd
            JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
            WHERE sd.fld_lecturer_name = :name
            AND sd.fld_status = 'REJECTED'
            AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
            AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
            ");

        $stmtRejectedDocuments->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtRejectedDocuments->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtRejectedDocuments->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtRejectedDocuments->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        $stmtRejectedDocuments->execute();

        $rejectedDocumentsCount = $stmtRejectedDocuments->fetch(PDO::FETCH_ASSOC)['rejected_count'];

        //total student absence

        $stmtAcceptedDocuments = $conn->prepare("
            SELECT COUNT(*) as accepted_count
            FROM tbl_submission_details sd
            JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
            WHERE sd.fld_lecturer_name = :name
            AND sd.fld_status = 'ACCEPTED'
            AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
            AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
            ");

        $stmtAcceptedDocuments->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtAcceptedDocuments->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtAcceptedDocuments->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtAcceptedDocuments->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        $stmtAcceptedDocuments->execute();

        $acceptedDocumentsCount = $stmtAcceptedDocuments->fetch(PDO::FETCH_ASSOC)['accepted_count'];


        //MOST ABSENCE TYPE
        $stmtMostAbsenceType = $conn->prepare("
        SELECT fld_absence_type, COUNT(*) as absence_type_count
        FROM tbl_submission_details sd
        JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_id
        WHERE sd.fld_lecturer_name = :name
        AND sd.fld_status = 'ACCEPTED'
        AND (:selectedMonth = 'All' OR MONTHNAME(sd.fld_absence_date) = :selectedMonth)
        AND (:selectedYear = 'All' OR YEAR(sd.fld_absence_date) = :selectedYear)
        AND (:selectedCourse = 'All' OR ud.fld_user_course = :selectedCourse)
        GROUP BY sd.fld_absence_type
        ORDER BY absence_type_count DESC
        LIMIT 1
    ");

        $stmtMostAbsenceType->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtMostAbsenceType->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
        $stmtMostAbsenceType->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $stmtMostAbsenceType->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        $stmtMostAbsenceType->execute();

        $result = $stmtMostAbsenceType->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $mostAbsenceType = $result['fld_absence_type'];
            $mostAbsenceTypeCount = $result['absence_type_count'];
        } else {
            $mostAbsenceType = "N/A";
            $mostAbsenceTypeCount = 0;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


    // Display the count in your HTML


    ?>


    <!-- <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div> -->







    <form method="post" enctype="multipart/form-data" style="margin-top: 100px;">
        <h1>GENERATE REPORT</h1>

        <div class="search-box">
            <!-- <img src="pictures/clock.png" class="img-time"> -->
            <div class="now-showing" style="color: black;">Month: <?php 'All'; ?></div>

            <select style="margin-left: 30px;" name="search1" id="search1">
                <option value="All" <?php echo ($selectedMonth === 'All') ? 'selected' : ''; ?>>All Months</option>
                <option value="January" <?php echo ($selectedMonth === 'January') ? 'selected' : ''; ?>>January</option>
                <option value="February" <?php echo ($selectedMonth === 'February') ? 'selected' : ''; ?>>February</option>
                <option value="March" <?php echo ($selectedMonth === 'March') ? 'selected' : ''; ?>>March</option>
                <option value="April" <?php echo ($selectedMonth === 'April') ? 'selected' : ''; ?>>April</option>
                <option value="May" <?php echo ($selectedMonth === 'May') ? 'selected' : ''; ?>>May</option>
                <option value="June" <?php echo ($selectedMonth === 'June') ? 'selected' : ''; ?>>June</option>
                <option value="July" <?php echo ($selectedMonth === 'July') ? 'selected' : ''; ?>>July</option>
                <option value="August" <?php echo ($selectedMonth === 'August') ? 'selected' : ''; ?>>August</option>
                <option value="September" <?php echo ($selectedMonth === 'September') ? 'selected' : ''; ?>>September</option>
                <option value="October" <?php echo ($selectedMonth === 'October') ? 'selected' : ''; ?>>October</option>
                <option value="November" <?php echo ($selectedMonth === 'November') ? 'selected' : ''; ?>>November</option>
                <option value="December" <?php echo ($selectedMonth === 'December') ? 'selected' : ''; ?>>December</option>
            </select>


            <div class="now-showing" style="color: black;">Year: <?php 'All'; ?></div>

            <select style="margin-left: 30px;" name="searchYear" id="searchYear">
                <option value="All" <?php echo ($selectedYear === 'All') ? 'selected' : ''; ?>>All Years</option>
                <?php
                // Assume $selectedYear holds the selected year, adjust as needed
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
                    echo "<option value='$year' " . ($selectedYear == $year ? 'selected' : '') . ">$year</option>";
                }
                ?>
            </select>


            <div class="now-showing" style="color: black;">Programme: <?php 'All'; ?></div>

            <select style="margin-left: 30px;" name="searchCourse" id="searchCourse">
                <option value="All" <?php echo ($selectedCourse === 'All') ? 'selected' : ''; ?>>All Courses</option>
                <?php
                try {
                    $stmtCoursesList = $conn->prepare("SELECT DISTINCT fld_user_course FROM tbl_user_details WHERE fld_user_course
                        NOT LIKE '-';");
                    $stmtCoursesList->execute();
                    $courseList = $stmtCoursesList->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($courseList as $course) {
                        $courseName = $course['fld_user_course'];
                        echo "<option value='$courseName' " . ($selectedCourse == $courseName ? 'selected' : '') . ">$courseName</option>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </select>
            <button style="margin: 20px;" type="submit">SEARCH</button>



        </div>
        <div class="box-container">

            <div class="box" id="">


                <div>
                    <p style="font-weight: bold">Reporting Insights</p>
                </div>
                <!-- Add a container for the document status counts -->
                <div style="display: flex; justify-content: space-between; margin-top: 30px;">

                    <!-- First documentStatusCounts div -->
                    <div id="documentStatusCounts" style="text-align: center;">
                        <div style="margin-bottom: 10px;">
                            <img src="pictures/documents.png" alt="Your Image Description" style="width: 70px; height: auto;">
                        </div>
                        <p>Pending Documents:

                            <span id="pendingCount" style="color: orange; font-weight: bold">
                                <?php echo $pendingDocumentsCount; ?>
                            </span>

                        </p>
                        <p>Accepted Documents:
                            <span id="acceptedCount" style="color: green; font-weight: bold">
                                <?php echo $acceptedDocumentsCount; ?>
                            </span>
                        </p>
                        <p>Rejected Documents:
                            <span id="rejectedCount" style="color: red; font-weight: bold">
                                <?php echo $rejectedDocumentsCount; ?>
                            </span>
                        </p>
                    </div>

                    <!-- Second documentStatusCounts div -->
                    <div id="totalStudentAbsence" style="text-align: center;">
                        <div style="margin-bottom: 10px;">
                            <img src="pictures/absence.png" alt="Your Image Description" style="width: 60px; height: auto;">
                        </div>
                        <p style="margin-top: 35px;">Total Student Absence: </p><br>
                        <span id="totalAbsenceCount" style="color: black; font-weight: bold; margin-top:0px"> <?php echo $acceptedDocumentsCount; ?></span>

                    </div>

                    <div id="mostAbsenceType" style="text-align: center;">
                        <div style="margin-bottom: px;">
                            <img src="pictures/chart.png" alt="Your Image Description" style="width: 40px; height: auto;">
                        </div>
                        <p style="margin-top: 55px;">Most Absence Type<br> </p><br>
                        <span id="mostAbsenceType" style="color: black; font-weight: bold"><?php 
                        echo " $mostAbsenceType : $mostAbsenceTypeCount"; ?></span>
                    </div>

                </div>


            </div>

        </div>
        <div class="box" id="first-box">
            <div>
                <p style="font-weight: bold">Absence Frequency in Classes</p>
            </div>
            <canvas id="barChart1" width="800" height="200"></canvas>
        </div>

        <div class="box" id="first-box">
            <div>
                <p style="font-weight: bold">Absence Trend (By Month)</p>
            </div>
            <canvas id="lineChart" width="800" height="200"></canvas>
        </div>


        <div class="box-container-two">
            <div class="box" id="second-box">
                <p style="font-weight: bold">Most Absences by Student</p>
                <canvas id="barChart2" width="400" height="400"></canvas>
            </div>
            <div class="box" id="third-box">
                <p style="font-weight: bold">Most Types of Absence </p>
                <canvas id="pieChart" width="400" height="400"></canvas>
                <p style="margin-top: 20px; color: green">Click On A Chart Section </p>
            </div>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // PHP data for the bar chart
                var barChart1Data = <?php echo json_encode($bar_chart_data); ?>;

                var ctxBar = document.getElementById("barChart1").getContext("2d");


                var barChart1 = new Chart(ctxBar, {
                    type: "bar",
                    data: {
                        labels: barChart1Data.labels,
                        datasets: [{
                            label: "Absences",
                            data: barChart1Data.values,
                            backgroundColor: "#36A2EB",
                            borderColor: "#36A2EB",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                type: 'linear', // Specify the axis type
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // Set the step size to 1 for round numbers
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                });

                // Add event listener for the filter button
                var filterButton = document.getElementById("filterButton");
                filterButton.addEventListener("click", function() {
                    // Handle filter logic here
                    // You can prompt the user for input and update the chart accordingly
                    alert("Filter button clicked! You can implement your filter logic here.");
                });
            });


            document.addEventListener("DOMContentLoaded", function() {
                //BARCHART2

                var ctxBar = document.getElementById("barChart2").getContext("2d");
                var barChart2 = new Chart(ctxBar, {
                    type: "bar",
                    data: {
                        labels: <?php echo json_encode($barChart2Dataset['labels']); ?>,
                        datasets: [{
                            label: 'Most Student Absences',
                            data: <?php echo json_encode($barChart2Dataset['values']); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                type: 'linear', // Specify the axis type
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // Set the step size to 1 for round numbers
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                });


            });


            document.addEventListener("DOMContentLoaded", function() {
                // PHP data for the pie chart
                var chartData = <?php echo json_encode($chart_data); ?>;

                var ctxPie = document.getElementById("pieChart").getContext("2d");
                var pieChart = new Chart(ctxPie, {
                    type: "pie",
                    data: {
                        labels: chartData.labels,
                        datasets: [{
                            data: chartData.values,
                            backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "turquoise"],
                            hoverBackgroundColor: ["#fff", "#fff", "#fff"]
                        }]
                    },
                    options: {
                        responsive: true,

                    }


                });

                ctxPie.canvas.addEventListener('click', function(evt) {
                    var activeElements = pieChart.getElementsAtEventForMode(evt, 'nearest', {
                        intersect: true
                    });

                    if (activeElements && activeElements.length > 0) {
                        var clickedIndex = activeElements[0].index;
                        var label = chartData.labels[clickedIndex];

                        console.log('Clicked Label:', label); // For debugging

                        if (label === 'MEDICAL') {
                            window.location.href = 'medical_data_lecturer.php';
                        }
                        if (label === 'EVENT') {
                            window.location.href = 'event_data_lecturer.php';
                        }
                        if (label === 'PERSONAL') {
                            window.location.href = 'personal_data_lecturer.php';
                        }
                        // Add more conditions for other labels if needed
                    }
                });
            });

            document.addEventListener("DOMContentLoaded", function() {
                var ctxLine = document.getElementById("lineChart").getContext("2d");

                // Fetch data for the line chart (absence month and total students absent)
                var lineChartLabels = <?php echo json_encode($lineChartLabels); ?>;
                var lineChartDataValues = <?php echo json_encode($lineChartDataValues); ?>;

                // Combine month and year as a single value for sorting
                var combinedData = lineChartLabels.map(function(label, index) {
                    return {
                        label: label,
                        value: lineChartDataValues[index],
                    };
                });

                // Sort the combined data based on month and year
                combinedData.sort(function(a, b) {
                    return new Date(a.label) - new Date(b.label);
                });

                // Separate the sorted data back into labels and values
                var sortedLineChartLabels = combinedData.map(function(item) {
                    return item.label;
                });

                var sortedLineChartDataValues = combinedData.map(function(item) {
                    return item.value;
                });

                var lineChart = new Chart(ctxLine, {
                    type: "line",
                    data: {
                        labels: sortedLineChartLabels,
                        datasets: [{
                            label: 'Total Absence of Students',
                            data: sortedLineChartDataValues,
                            fill: false,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                type: 'linear',
                                position: 'bottom',
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Month'
                                },
                            },
                            y: {
                                type: 'linear', // Specify the axis type
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1, // Set the step size to 1 for round numbers
                                    beginAtZero: true
                                }
                            }
                        }
                    }
                });

            });
        </script>

</body>

</html>