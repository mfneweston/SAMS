
<?php
include_once 'db.php';
include_once 'session.php';
include_once 'sidebar_student.php';
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
               width: 100%; /* Set width to occupy 33.33% of the container minus margin */

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

        @keyframes flashing-red {
            0%, 50%, 100% {
                background-color: darkred;
            }
        }

        @keyframes flashing-yellow {
            0%, 50%, 100% {
                background-color: orange;
            }
        }

        @keyframes flashing-blue {
            0%, 50%, 100% {
                background-color: green;
            }
        }

        .flashing-red {
            animation: flashing-red 1s infinite;
        }

        .flashing-yellow {
            animation: flashing-yellow 1s infinite;
        }

        .flashing-blue {
            animation: flashing-blue 1s infinite;
        }
    </style>

</head>


<body>

    <?php

    // Fetch the current user's ID from the session (assuming the session variable holding the user ID is $id)
    //$currentUserID = $_SESSION[$id];
    // SQL query to retrieve courses held by the current user (lecturer) based on their ID
    $stmtCourses = $conn->prepare("SELECT DISTINCT fld_course_code FROM tbl_submission_details WHERE fld_user_id = :user_id");
    $stmtCourses->bindParam(':user_id', $id);
    $stmtCourses->execute();
    $userCourses = $stmtCourses->fetchAll(PDO::FETCH_ASSOC);


// Prepare arrays for chart labels (course names) and data (absence counts)
    $labels = [];
    $values = [];

// Keep track of processed course codes
    $processedCourseCodes = [];

// Loop through the distinct courses held by the lecturer
    foreach ($userCourses as $course) {
        $courseCode = $course['fld_course_code'];

    // Check if the course code has already been processed
        if (!in_array($courseCode, $processedCourseCodes)) {

        // Fetch the total absences for each course from tbl_submission_details
            $stmtAbsences = $conn->prepare("SELECT COUNT(fld_submission_id) as total_absences FROM tbl_submission_details WHERE fld_course_code = :course_code AND fld_user_id = :user_id");
            $stmtAbsences->bindParam(':course_code', $courseCode);
            $stmtAbsences->bindParam(':user_id', $id);
            $stmtAbsences->execute();
            $absenceData = $stmtAbsences->fetch(PDO::FETCH_ASSOC);

        // Populate chart arrays with course name as label and total absences as value
            $labels[] = $courseCode;
            $values[] = $absenceData['total_absences'];

        // Mark the course code as processed
            $processedCourseCodes[] = $courseCode;
        }
    }

// Convert chart data to JSON format for the bar chart
    $bar_chart_data = [
        'labels' => $labels,
        'values' => $values
    ];



    try {
    // Fetch data for the most absent classes
        $stmtMostAbsent = $conn->prepare("SELECT fld_course_code, COUNT(fld_submission_id) as total_absences FROM tbl_submission_details WHERE fld_user_id = :id GROUP BY fld_course_code ORDER BY total_absences DESC LIMIT 5");
        $stmtMostAbsent->bindParam(':id', $id, PDO::PARAM_STR);
        $stmtMostAbsent->execute();
        $mostAbsentData = $stmtMostAbsent->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


    try {

                // Fetch data from your table in PHP
                //pie chart

        $stmt = $conn->prepare("SELECT COUNT(*) as total, fld_absence_type FROM tbl_submission_details WHERE fld_user_id = :id GROUP BY fld_absence_type");

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Prepare arrays for chart labels and data
        $labels = [];
        $values = [];

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

                        //echo json_encode($chart_data); // Add this line for debugging


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }



    ?>


    <!-- <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div> -->



    <button class="logout-button btn btn-secondary" style="background-color: white; color: black;" onclick="window.location.href='absence_period.php'">Back</button>



    <form method="post" action="submission.php" enctype="multipart/form-data" style="margin-top: 100px;">

        <div class="box-container">
            <div class="box" id="first-box" >
                <p>Absence Frequency in Classes</p>
                <canvas id="barChart1" width="800" height="400"></canvas>
            </div>
            <div class="box-container-two" style="margin-bottom: -10px">
                <div class="box" id="second-box">
                    <!--<p>WARNING!</p>
                        <canvas id="table" width="400" height="400"></canvas>-->
                    </div>
                    <div class="box" id="third-box">
                        <p>Most Types of Absence </p>
                        <canvas id="pieChart" width="400" height="400"></canvas>
                    </div>
                </div>
                <div class="box" id="first-box" >
                <p>INFO!:</p>
                <p></p>
                <p>High Absence: More absences in this subject may prevent you from entering Exam Hall for Final Examination</p>
                <p></p>
                <p>Moderate Absence: Couple more absence before you exceed the absence limit for this subject (70% of Attendace)</p>
                <p></p>
                <p>Low Absence: Only few absences giver for this subject </p>
                <p></p>
                <p></p>
                <p>Note: All of the warning given depends on your lecturer</p>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>

// JavaScript for rendering the bar chart
    document.addEventListener("DOMContentLoaded", function () {
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
                        beginAtZero: true
                    }
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
    // PHP data for the most absent classes
        var mostAbsentData = <?php echo json_encode($mostAbsentData); ?>;

    // Create a table element
        var table = document.createElement("table");
    table.setAttribute("class", "table"); // Add Bootstrap table class if needed

    // Create table header row
    var headerRow = table.insertRow();
    var headerCell1 = headerRow.insertCell(0);
    var headerCell2 = headerRow.insertCell(1);
    var headerCell3 = headerRow.insertCell(2);
    headerCell1.textContent = "Class Code";
    headerCell2.textContent = "Number of Absences";
    headerCell3.textContent = "Warning";

    // Populate the table with data
    // Populate the table with data
mostAbsentData.forEach(function (row) {
    var newRow = table.insertRow();
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    var cell3 = newRow.insertCell(2);

    cell1.textContent = row.fld_course_code;
    cell2.textContent = row.total_absences;

    var warningText = (row.total_absences >= 4) ? "High Absences" :
                      (row.total_absences >= 3) ? "Moderate Absences" :
                      (row.total_absences >= 1) ? "Low Absences" : "Normal";

    // Apply styles to the warning text
    cell3.innerHTML = `<span style="color: white;">${warningText}</span>`;

    // Add flashing effect based on the warning level
    if (row.total_absences >= 4) {
        cell3.classList.add("flashing-red");
    } else if (row.total_absences >= 3) {
        cell3.classList.add("flashing-yellow");
    } else if (row.total_absences >= 1) {
        cell3.classList.add("flashing-blue");
    }

});




    // Append the table to the second box
    var secondBox = document.getElementById("second-box");
    secondBox.appendChild(table);
});



    document.addEventListener("DOMContentLoaded", function () {
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
                            // ...other options for pie chart
            }
        });

        ctxPie.canvas.addEventListener('click', function (evt) {
            var activeElements = pieChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true });

            if (activeElements && activeElements.length > 0) {
                var clickedIndex = activeElements[0].index;
                var label = chartData.labels[clickedIndex];

                        console.log('Clicked Label:', label); // For debugging

                        if (label === 'MEDICAL') {
                            window.location.href = 'medical_data.php';
                        }
                        if (label === 'EVENT') {
                            window.location.href = 'event_data.php';
                        }
                        if (label === 'PERSONAL') {
                            window.location.href = 'personal_data.php';
                        }
                        // Add more conditions for other labels if needed
                    }
                });
    });
</script>

</body>

</html>