<?php
include_once 'db.php';
include_once 'session.php';
//include_once 'nav_bar_4.php';
include_once 'sidebar_admin.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <link rel="stylesheet" href="style.css">
    <!-- Include Chart.js library -->
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

        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            justify-content: center;
            width: 1060px;
            margin-bottom: 30px;
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
            margin-top: 20px;
        }

        .box-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            margin-top: 20px;
            width: 980px;

        }

        .top-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
            overflow-x: auto;
        }

        .bottom-cards {
            display: flex;
            gap: 20px;
            width: 100%;
            max-width: 800px;
            /* Adjust max-width to your preference */
            margin-top: 20px;
        }

        .graph-container {
            display: flex;
            justify-content: center;
            /* Center the chart horizontally */
            align-items: center;
            /* Center the chart vertically */
            width: 100%;
            max-width: 100%;
            height: 350px;
        }
    </style>
</head>

<body>

    <!-- <div class="img-user">

        <? /*php
        if (!empty($readrow['fld_user_image'])) {
            echo '<img src="pictures/' . $readrow['fld_user_image'] . '" alt="Your Image Description"  style="width: 50px;height:60px;">';
        } else {
            echo '<img src="pictures/no_photo.jpg" alt="No Photo"  style="width: 50px;height:60px;"">';
        } 
        */ ?>

        <span><? //php echo $readrow['fld_user_id']; 
                ?></span>-
        <span><? //php echo $readrow['fld_user_name']; 
                ?></span>
    </div> -->


    <div>


        <?php

        // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search1']) && isset($_POST['searchYear']) && isset($_POST['searchCourse'])) {
        //     $selectedMonth = $_POST['search1'];
        //     $selectedYear = $_POST['searchYear'];
        //     $selectedCourse = $_POST['searchCourse'];
        // } else {
        //     // Default to 'All' if no specific month is selected
        //     $selectedMonth = 'All';
        //     // Default to the current year
        //     $selectedYear = 'All';
        //     $selectedCourse = 'All';
        // }

        // var_dump($_POST);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search1']) && isset($_POST['searchYear'])) {
            $selectedMonth = $_POST['search1'];
            $selectedYear = $_POST['searchYear'];
            // $selectedCourse = $_POST['searchCourse'];
        } else {
            // Default to 'All' if no specific month is selected
            $selectedMonth = 'All';
            // Default to the current year
            $selectedYear = 'All';
            // $selectedCourse = 'All';
        }

        //         try {
        //             // Fetch data for the bar chart (course codes and total students)
        //             $stmt = $conn->prepare("
        //             SELECT tbl_submission_details.fld_user_id, fld_course_code, fld_course_name, COUNT(*) AS total_students
        //             FROM tbl_submission_details
        //             JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
        //             WHERE fld_status='ACCEPTED' 
        //               AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
        //               AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
        //               AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
        //             GROUP BY fld_course_code, fld_course_name
        //             ORDER BY total_students DESC;
        // ");


        //             $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_INT);
        //             $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        //             $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
        //             $stmt->execute();
        //             $barChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        try {
            // Fetch data for the bar chart (course codes and total students)
            $stmt = $conn->prepare("
    SELECT tbl_submission_details.fld_user_id, fld_course_code, fld_course_name, COUNT(*) AS total_students
    FROM tbl_submission_details
    JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
    WHERE fld_status='ACCEPTED' 
      AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
      AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
    GROUP BY fld_course_code, fld_course_name
    ORDER BY total_students DESC;
");


            $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_INT);
            $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            // $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            $stmt->execute();
            $barChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);





            // Fetch data for the line chart (absence month and total students absent for all years)
            $stmt = $conn->prepare("
            SELECT YEAR(fld_absence_date) AS absence_year,
                MONTH(fld_absence_date) AS absence_month,
                COUNT(fld_user_id) AS total_absent_students
            FROM tbl_submission_details
            WHERE fld_status='ACCEPTED'
                AND YEAR(fld_absence_date) >= 2023
            GROUP BY absence_year, absence_month
            ORDER BY absence_year, absence_month
        ");
            $stmt->execute();
            $lineChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);



            // Fetch data from your table in PHP for absence_type

            //     $stmt = $conn->prepare("
            //     SELECT COUNT(*) as total, fld_absence_type FROM tbl_submission_details JOIN tbl_user_details
            //     ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            //     WHERE fld_status='ACCEPTED' 
            //     AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
            //     AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            //     AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
            //     GROUP BY fld_absence_type
            // ");

            //     $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            //     $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            //     $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            //     $stmt->execute();
            //     $pieChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("
            SELECT COUNT(*) as total, fld_absence_type FROM tbl_submission_details JOIN tbl_user_details
            ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            WHERE fld_status='ACCEPTED' 
            AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            GROUP BY fld_absence_type
        ");

            $stmt->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            $stmt->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            // $stmt->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            $stmt->execute();
            $pieChartData = $stmt->fetchAll(PDO::FETCH_ASSOC);



            ////MOST ABSENCE TYPE FOR INSIGHTTT

            //     $stmtMostAbsenceType = $conn->prepare("
            //     SELECT COUNT(*) as absence_type_count, fld_absence_type FROM tbl_submission_details JOIN tbl_user_details
            //     ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            //     WHERE fld_status='ACCEPTED' 
            //     AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
            //     AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            //     AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
            //     GROUP BY fld_absence_type
            //     ORDER BY absence_type_count DESC
            //     LIMIT 1
            // ");

            //     $stmtMostAbsenceType->bindParam(':name', $name, PDO::PARAM_STR);
            //     $stmtMostAbsenceType->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            //     $stmtMostAbsenceType->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            //     $stmtMostAbsenceType->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            //     $stmtMostAbsenceType->execute();

            $stmtMostAbsenceType = $conn->prepare("
            SELECT COUNT(*) as absence_type_count, fld_absence_type FROM tbl_submission_details JOIN tbl_user_details
            ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            WHERE fld_status='ACCEPTED' 
            AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            GROUP BY fld_absence_type
            ORDER BY absence_type_count DESC
            LIMIT 1
        ");

            $stmtMostAbsenceType->bindParam(':name', $name, PDO::PARAM_STR);
            $stmtMostAbsenceType->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            $stmtMostAbsenceType->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            $stmtMostAbsenceType->execute();

            $result = $stmtMostAbsenceType->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $mostAbsenceType = $result['fld_absence_type'];
                $mostAbsenceTypeCount = $result['absence_type_count'];
            } else {
                $mostAbsenceType = "N/A";
                $mostAbsenceTypeCount = 0;
            }

            ////LECTURER WITH MOST STUDENT ABSENCE



        //     $stmtMostLecturer = $conn->prepare("
        //     SELECT COUNT(*) as absence_count, fld_lecturer_name FROM tbl_submission_details JOIN tbl_user_details
        //     ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
        //     WHERE fld_status='ACCEPTED' 
        //     AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
        //     AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
        //     AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
        //     GROUP BY fld_lecturer_name
        //     ORDER BY absence_count DESC
        //     LIMIT 1

        // ");

        $stmtMostLecturer = $conn->prepare("
            SELECT COUNT(*) as absence_count, fld_lecturer_name FROM tbl_submission_details JOIN tbl_user_details
            ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
            WHERE fld_status='ACCEPTED' 
            AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
            AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
            GROUP BY fld_lecturer_name
            ORDER BY absence_count DESC
            LIMIT 1

        ");



            $stmtMostLecturer->bindParam(':name', $name, PDO::PARAM_STR);
            $stmtMostLecturer->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            $stmtMostLecturer->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            // $stmtMostLecturer->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            $stmtMostLecturer->execute();

            $result = $stmtMostLecturer->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $mostLecturer = $result['fld_lecturer_name'];
                $mostLecturerCount = $result['absence_count'];
            } else {
                $mostLecturer = "N/A";
                $mostLecturerCount = 0;
            }


        //     ////SUBJECT WITH MOST STUDENT ABSENCE
        //     $stmtSubjectMostAbsence = $conn->prepare("
        //     SELECT tbl_submission_details.fld_user_id, fld_course_code, fld_course_name, COUNT(*) AS absence_course_count
        //     FROM tbl_submission_details
        //     JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
        //     WHERE fld_status='ACCEPTED' 
        //       AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
        //       AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
        //       AND (:selectedCourse = 'All' OR fld_user_course = :selectedCourse)
        //     GROUP BY fld_course_code, fld_course_name
        //     ORDER BY absence_course_count DESC;
        //     LIMIT 1;
        // ");

        ////SUBJECT WITH MOST STUDENT ABSENCE
        $stmtSubjectMostAbsence = $conn->prepare("
        SELECT tbl_submission_details.fld_user_id, fld_course_code, fld_course_name, COUNT(*) AS absence_course_count
        FROM tbl_submission_details
        JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
        WHERE fld_status='ACCEPTED' 
          AND (:selectedMonth = 'All' OR MONTH(fld_absence_date) = :selectedMonth)
          AND (:selectedYear = 'All' OR YEAR(fld_absence_date) = :selectedYear)
        GROUP BY fld_course_code, fld_course_name
        ORDER BY absence_course_count DESC;
        LIMIT 1;
    ");

            $stmtSubjectMostAbsence->bindParam(':name', $name, PDO::PARAM_STR);
            $stmtSubjectMostAbsence->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_STR);
            $stmtSubjectMostAbsence->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
            // $stmtSubjectMostAbsence->bindParam(':selectedCourse', $selectedCourse, PDO::PARAM_STR);
            $stmtSubjectMostAbsence->execute();

            $result = $stmtSubjectMostAbsence->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $mostSubjectAbsence = $result['fld_course_name'];
                $mostSubjectAbsenceCount = $result['absence_course_count'];
            } else {
                $mostSubjectAbsence = "N/A";
                $mostSubjectAbsenceCount = 0;
            }




            // Prepare arrays for chart labels and data
            $barChartLabels = [];
            $barChartDataValues = [];
            $lineChartLabels = [];
            $lineChartDataValues = [];
            $pieChartLabels = [];
            $pieChartValues = [];

            // Loop through the fetched data and populate chart arrays
            foreach ($barChartData as $row) {
                $barChartLabels[] = $row['fld_course_code'];
                $barChartLabelsName[] = $row['fld_course_name'];
                $barChartDataValues[] = $row['total_students'];
                //$absenceMonth = $course['absence_month'];
            }

            // Convert chart data to JSON format
            $barChartDataset = [
                'labels' => $barChartLabels,
                'values' => $barChartDataValues
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
            // Loop through the fetched data and populate chart arrays
            foreach ($pieChartData as $row) {
                $pieChartLabels[] = $row['fld_absence_type'];
                $pieChartValues[] = $row['total'];
            }
            $pieChartDataset = [
                'labels' => $pieChartLabels,
                'values' => $pieChartValues
            ];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <form method="post" enctype="multipart/form-data" style="margin-top: 100px;">
            <h1>GENERATE REPORT</h1>
            <div class="search-box">
                <!-- <img src="pictures/clock.png" class="img-time"> -->
                <div class="now-showing" style="color: black;">Month: <?php 'All'; ?></div>

                <select style="margin-left: 30px;" name="search1" id="search1">
                    <option value="All" <?php echo ($selectedMonth === 'All') ? 'selected' : ''; ?>>All Months</option>
                    <option value="01" <?php echo ($selectedMonth === '01') ? 'selected' : ''; ?>>January</option>
                    <option value="02" <?php echo ($selectedMonth === '02') ? 'selected' : ''; ?>>February</option>
                    <option value="03" <?php echo ($selectedMonth === '03') ? 'selected' : ''; ?>>March</option>
                    <option value="04" <?php echo ($selectedMonth === '04') ? 'selected' : ''; ?>>April</option>
                    <option value="05" <?php echo ($selectedMonth === '05') ? 'selected' : ''; ?>>May</option>
                    <option value="06" <?php echo ($selectedMonth === '06') ? 'selected' : ''; ?>>June</option>
                    <option value="07" <?php echo ($selectedMonth === '07') ? 'selected' : ''; ?>>July</option>
                    <option value="08" <?php echo ($selectedMonth === '08') ? 'selected' : ''; ?>>August</option>
                    <option value="09" <?php echo ($selectedMonth === '09') ? 'selected' : ''; ?>>September</option>
                    <option value="10" <?php echo ($selectedMonth === '10') ? 'selected' : ''; ?>>October</option>
                    <option value="11" <?php echo ($selectedMonth === '11') ? 'selected' : ''; ?>>November</option>
                    <option value="12" <?php echo ($selectedMonth === '12') ? 'selected' : ''; ?>>December</option>
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

                <!-- <div class="now-showing" style="color: black;">Programme: <?php 'All'; ?></div>
                <select style="margin-left: 30px;" name="searchCourse" id="searchCourse">
                    <option value="All" <?php echo ($selectedCourse === 'All') ? 'selected' : ''; ?>>All Programmes</option>
                    <?/*php
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
                    */ ?>
                </select> -->
                <button style="margin: 20px;" type="submit">SEARCH</button>
            </div>
        </form>

        <div class="box-container">

            <div class="box" id="">


                <div>
                    <p style="font-weight: bold">REPORTING INSIGHT</p>
                </div>
                <!-- Add a container for the document status counts -->
                <div style="display: flex; justify-content: space-between; margin-top: 30px;">

                    <!-- First documentStatusCounts div -->
                    <div id="documentStatusCounts" style="text-align: center;">
                        <div style="margin-bottom: 10px;">
                            <img src="pictures/user.png" alt="Your Image Description" style="width: 70px; height: auto;">
                        </div>
                        <p>Lecturer With <br>Most Student Absence:</p><br>
                        <span id="mostAbsenceType" style="color: black; font-weight: bold"><?php
                                                                                            echo "$mostLecturer :<br> <span style='color: red;'>  $mostLecturerCount";
                                                                                            ?></span>





                        </p>

                    </div>

                    <!-- Second documentStatusCounts div -->
                    <div id="totalStudentAbsence" style="text-align: center;">
                        <div style="margin-bottom: 10px;">
                            <img src="pictures/absence.png" alt="Your Image Description" style="width: 60px; height: auto;">
                        </div>
                        <p>Course With <br>Most Student Absence:</p><br>
                        <span id="mostCourseType" style="color: black; font-weight: bold"><?php
                                                                                            echo "$mostSubjectAbsence :<br> <span style='color: red;'>$mostSubjectAbsenceCount";
                                                                                            ?></span>





                        </p>


                    </div>

                    <div id="mostAbsenceType" style="text-align: center;">
                        <div style="margin-bottom: px;">
                            <img src="pictures/chart.png" alt="Your Image Description" style="width: 40px; height: auto;">
                        </div>
                        <p style="margin-top: 55px;">Most Absence Type<br> </p><br>
                        <span id="mostAbsenceType" style="color: black; font-weight: bold"><?php
                                                                                            echo " $mostAbsenceType :<br> <span style='color: red;'> $mostAbsenceTypeCount"; ?></span>

                    </div>

                </div>


            </div>

        </div>

        <div class="box-container">
            <div class="box" id="first-box" style="margin-top: 30px">
                <h2 style="font-size: 20px;">ABSENCE TREND (BY MONTH)</h2>
                <div class="graph-container">
                    <canvas id="lineChart" width="800" height="300"></canvas>
                </div>

            </div>

            <div class="container">
                <div class="box">
                    <h2 style="font-size: 20px;">TOTAL STUDENT ABSENCE BY PROGRAMME</h2>
                    <div class="graph-container">
                        <canvas id="barChart" width="800" height="300"></canvas>
                    </div>
                </div>

                <div class="box">
                    <h2 style="font-size: 20px;">TYPE OF ABSENCE</h2>
                    <div class="graph-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // function generateRandomColors(numColors) {
        //     var colors = [];
        //     for (var i = 0; i < numColors; i++) {
        //         var randomColor = 'rgba(' +
        //             Math.floor(Math.random() * 256) + ',' +
        //             Math.floor(Math.random() * 256) + ',' +
        //             Math.floor(Math.random() * 256) + ',' +
        //             '0.5)'; // Adjust alpha value as needed

        //         colors.push(randomColor);
        //     }
        //     return colors;
        // }

        document.addEventListener("DOMContentLoaded", function() {
            var ctxBar = document.getElementById("barChart").getContext("2d");

            // Fetch data for the bar chart (course codes and total students)
            var barChartLabels = <?php echo json_encode($barChartLabels); ?>;
            var barChartLabelsName = <?php echo json_encode($barChartLabelsName); ?>;
            var barChartDataValues = <?php echo json_encode($barChartDataValues); ?>;

            // Combine course codes and names for labels
            var combinedLabels = [];
            for (var i = 0; i < barChartLabels.length; i++) {
                combinedLabels.push(barChartLabels[i] + '\n' + barChartLabelsName[i]);
            }

            var barChart = new Chart(ctxBar, {
                type: "bar",
                data: {
                    labels: combinedLabels,
                    datasets: [{
                        label: 'Total Students',
                        data: barChartDataValues,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });



        document.addEventListener("DOMContentLoaded", function() {
            var ctxLine = document.getElementById("lineChart").getContext("2d");

            // Assuming you have PHP variables $lineChartLabels and $lineChartDataValues
            var lineChartLabels = <?php echo json_encode($lineChartLabels); ?>;
            var lineChartDataValues = <?php echo json_encode($lineChartDataValues); ?>;

            // Convert labels to JavaScript Date objects for proper sorting
            var dateLabels = lineChartLabels.map(function(label) {
                return new Date(label);
            });

            // Find the minimum date to set as the starting point for the x-axis
            var minDate = new Date(Math.min.apply(null, dateLabels));
            minDate.setMonth(minDate.getMonth() - 1); // Adjust to start from the previous month

            var lineChartDataset = {
                labels: dateLabels.map(label => label.toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                })),
                datasets: [{
                    label: 'Total Absence of Students',
                    data: lineChartDataValues,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            };

            var lineChart = new Chart(ctxLine, {
                type: "line",
                data: lineChartDataset,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'category',
                            position: 'bottom',
                            scaleLabel: {
                                display: true,
                                labelString: 'Month and Year'
                            },
                            time: {
                                unit: 'month',
                                displayFormats: {
                                    month: 'MMM YYYY'
                                },
                                min: minDate.getTime(), // Convert minDate to milliseconds
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    // Format the ticks starting from the minimum date
                                    var date = new Date('2023-09-01');
                                    date.setMonth(date.getMonth() + index);
                                    return date.toLocaleString('default', {
                                        month: 'long',
                                        year: 'numeric'
                                    });
                                },
                                maxRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: 10
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: Math.max(...lineChartDataValues) + 2,
                            scaleLabel: {
                                display: true,
                                labelString: 'Total Absent Students'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function(tooltipItems) {
                                    // Format the tooltip title to match the x-axis ticks
                                    var date = new Date('2023-09-01');
                                    date.setMonth(date.getMonth() + tooltipItems[0].dataIndex);
                                    return date.toLocaleString('default', {
                                        month: 'long',
                                        year: 'numeric'
                                    });
                                }
                            }
                        }
                    }
                }
            });
        });



        document.addEventListener("DOMContentLoaded", function() {
            var ctxPie = document.getElementById("pieChart").getContext("2d");

            // PHP data for the pie chart
            var chartData = <?php echo json_encode($pieChartDataset); ?>;

            console.log('Pie Chart Data:', chartData); // Debug statement

            var pieChartDataset = {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.values,
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "turquoise"],
                    hoverBackgroundColor: ["#fff", "#fff", "#fff"]
                }]
            };

            var pieChart = new Chart(ctxPie, {
                type: "pie",
                data: pieChartDataset,
                options: {
                    responsive: true,
                    // ...other options for pie chart
                }
            });

            // Add click event listener to the pie chart
            ctxPie.canvas.addEventListener('click', function(evt) {
                var activeElements = pieChart.getElementsAtEventForMode(evt, 'nearest', {
                    intersect: true
                }, false, false);

                if (activeElements && activeElements.length > 0) {
                    var clickedIndex = activeElements[0].index;
                    var label = chartData.labels[clickedIndex];

                    console.log('Clicked Label:', label); // For debugging

                    // Redirect based on the clicked label
                    if (label === 'MEDICAL') {
                        window.location.href = 'medical_data.php';
                    } else if (label === 'EVENT') {
                        window.location.href = 'event_data.php';
                    } else if (label === 'PERSONAL') {
                        window.location.href = 'personal_data.php';
                    }
                    // Add more conditions for other labels if needed
                }
            });
        });
    </script>

</body>

</html>