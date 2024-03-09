<?php
include_once 'db.php';
include_once 'session.php';
include_once 'nav_bar_4.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document History</title>
    <link rel="stylesheet" href="style.css">
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
            align-items: flex-start; /* Align items to the start of the flex container */
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
            background: #fff; /*light grey */
            padding: 40px;
            /* Increase padding for a larger box */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            /* Increase box width */
            max-width: 1800px;
            /* Adjust maximum width as needed */
            text-align: center;
            display: top;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
            /* Remove fixed height to accommodate content */
            overflow-x: auto;
            /* Enable horizontal scrolling for the table if necessary */
            margin-top: 20px;
            /* Increase distance from search boxes */
        }

        .box table {
            width: 100%;
            border: 20px solid black;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px ;
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


    // Initialize result variable
    /*$result = array();

    // Fetch course details based on user ID, day, and course mode
    try {
        $sql = "SELECT sd.fld_submission_date AS submission_date,
        sd.fld_course_name AS course_name,
        sd.fld_lecturer_name AS lecturer_name,
        sd.fld_submission_time AS submission_time
        FROM tbl_submission_details sd
        WHERE sd.fld_user_id = :id";

        $params = [':id' => $id];

        if (isset($_POST['search1']) && isset($_POST['search2'])) {
            $selectedTime = $_POST['search1'];
            $selectedCourseMode = $_POST['search2'];

            // Assuming you want to filter by submission time
            if ($selectedTime != 'All Days') {
                $sql .= " AND sd.fld_submission_time = :submission_time";
                $params[':submission_time'] = $selectedTime;
            }

            // Assuming you want to filter by course mode
            if ($selectedCourseMode != 'all') {
                $sql .= " AND sd.fld_course_mode = :course_mode";
                $params[':course_mode'] = $selectedCourseMode;
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } */

    ?>
    <div>

        <button onclick="location.href='#'" class="next">BACK</button>

        <form method="post" action="">
            <div class="search-box">
                <img src="pictures/clock.png" class="img-time">
                <div class="now-showing">Showing: </div>


                <select style="margin-left: 30px;" name="search1" id="search1">
                    <option value="last1Month">Last 1 Month</option>
                    <option value="last3Months">Last 3 Months</option>
                    <option value="last6Months">Last 6 Months</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>

                <select style="margin-left: 30px;" name="search2" id="search2">
                    <option value="allcourses">Course</option>
                    <option value="course1">Course 1</option>
                    <option value="course2">Course 2</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>

                <select style="margin-left: 30px;" name="search3" id="search3">
                    <option value="all">All Modes</option>
                    <option value="lecture">Lecture</option>
                    <option value="laboratory">Laboratory</option>
                    <option value="tutorial">Tutorial</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>
            </div>
        </form>


        <div class="box">

            <!-- Wrap the image and the "Records:" div in a container div -->
            <div class="record-container">
                <img src="pictures/checklist.png" class="img-record">
                <div class="record">Records: </div>
            </div>


            <?//php if (!empty($result)) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>MATRIC. NO</th>
                            <th>NAME</th>
                            <th>MODE</th>
                            <th>COURSE</th>
                            <th>REASON</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?//php foreach ($result as $row) : ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    <button class="select-button" onclick="window.location.href='#'">DETAILS</button>
                                </td>
                            </tr>
                        <?//php endforeach; ?>
                    </tbody>
                </table>
            <?//php else : ?>
                <!-- <p>No results found.</p> -->
            <?//php endif; ?>
        </div>
    </div>
    <script>
        function search() {
            document.forms[0].submit();
        }
    </script>

</body>

</html>