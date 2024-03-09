<?php
include_once 'db.php';
include_once 'session.php';
//include_once 'nav_bar_4.php';
include_once 'sidebar_lecturer.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Student Absence</title>
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

        .search-box-wrapper {
            display: flex;
            justify-content: center;
            /* Center the search boxes horizontally */
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 20px;
        }

        /* Apply styles to the individual search boxes */
        .search-box select,
        .search-box button {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .box {
            background: #fff;
            /*light grey */
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

        .header-row th {
            color: white;
            /* Set the text color of the header row to white */
            background-color: #0080A0;
            text-align: center;
            padding: 12px;
        }

        td {
            border: 0.5px solid #d3d3d3;
            text-align: center;
            padding: 8px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            padding: 5px 10px;
            margin: 0 5px;
            text-decoration: none;
            color: #007187;
            border: 1px solid #007187;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .page-link.active {
            background-color: #007187;
            color: white;
        }

        .page-link:hover {
            background-color: #0080A0;
            border-radius: 50%; /* Change to oval shape on hover */
        }

        .pagination-button {
            color: #007187;
            border: 1px solid #007187;
            border-radius: 5px;
            cursor: pointer;
            padding: 5px 12px;
            margin: 10px 5px;
            transition: background-color 0.3s;
            background-color: #fff;
        }

        .pagination-button.active {
            background-color: #007187;
        }

        .pagination-button:hover {
            background-color: #0080A0;
            border-radius: 50%; /* Change to oval shape on hover */
        }

        .pagination-button.selected {
            background-color: #007187;
            color: white;
        }

        .pagination-button.selected:hover {
            background-color: #007187;
            border-radius: 5px; /* Maintain the border-radius on hover */
        }
    </style>

</head>

<body>

    <?php

    try {
        $sql = "SELECT * FROM tbl_submission_details WHERE fld_lecturer_name = :name AND fld_status = 'PENDING'";
        $stmt = $conn->prepare("SELECT DISTINCT fld_absence_date FROM tbl_submission_details");
        $stmt->execute();
        $days = $stmt->fetchAll(PDO::FETCH_ASSOC);



        $result = array();

// Assuming $conn is your PDO connection


        if (isset($_POST['search1']) && !empty($_POST['search1'])) {
            $dateRange = $_POST['search1'];
            switch ($dateRange) {
                case 'last1Month':
                $sql .= " AND fld_absence_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()";
                break;
                case 'last2Months':
                $sql .= " AND fld_absence_date BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW()";
                break;
                case 'last3Months':
                $sql .= " AND fld_absence_date BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW()";
                break;
            }
        }




        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $records_per_page = 5;

            // Get the total number of records
    $total_records = count($result);

            // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);

            // Determine the current page number
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

            // Calculate the starting point for fetching the records
    $start_from = ($page - 1) * $records_per_page;

            // Fetch records based on pagination
    $result_pagination = array_slice($result, $start_from, $records_per_page);




?>




<div>

    <!-- <button onclick="location.href='lecturer_menu.php'" class="next">BACK</button> -->

    <form method="post" action="">
        <div class="search-box-wrapper">

            <div class="search-box">
                <img src="pictures/clock.png" class="img-time">
                <div class="now-showing">Showing: </div>
                <select style="margin-left: 30px;" name="search1" id="search1">
                    <option value="last1Month" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'last1Month') echo 'selected'; ?>>Last 1 Month</option>
                    <option value="last2Months" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'last2Months') echo 'selected'; ?>>Last 2 Months</option>
                    <option value="last3Months" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'last3Months') echo 'selected'; ?>>Last 3 Months</option>
                </select>
                <button type="submit" style="margin-left: 10px;">SEARCH</button>
            </div> 

                <!-- <select style="margin-left: 30px;" name="search2" id="search2">
                    <option value="allcourses">Course</option>
                    <option value="course1">Course 1</option>
                    <option value="course2">Course 2</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>
            -->
                <!-- <select style="margin-left: 30px;" name="search2" id="search2">
                    <option value="All Types"<?php if (isset($_POST['search2']) && $_POST['search2'] == 'All Types') echo 'selected'; ?>>ALL MODES</option>
                    <option value="Lecture"<?php if (isset($_POST['search2']) && $_POST['search2'] == 'Lecture') echo 'selected'; ?>>LECTURE</option>
                    <option value="Laboratory"<?php if (isset($_POST['search2']) && $_POST['search2'] == 'Laboratory') echo 'selected'; ?>>LABORATORY</option>
                    <option value="Tutorial"<?php if (isset($_POST['search2']) && $_POST['search2'] == 'Tutorial') echo 'selected'; ?>>TUTORIAL</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button> -->
            </div>
        </form>


        <div class="box">

            <!-- Wrap the image and the "Records:" div in a container div -->
            <div class="record-container">
                <img src="pictures/checklist.png" class="img-record">
                <div class="record">STUDENT ABSENCE RECORDS: <span style="color: red; font-weight:bold;">PENDING DOCUMENTS</p>
                </div>
            </div>


            

            <?php if (!empty($result_pagination)) : ?>

                <table>
                    <thead>
                        <tr class="header-row">
                            <th>MATRIC. NO</th>
                            <th>COURSE NAME</th>
                            <th>COURSE</th>
                            <th>ABSENCE TYPE</th>
                            <th>ABSENCE TITLE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($result_pagination as $readrow) :?>
                            <tr>
                                <td><?php echo $readrow['fld_user_id']; ?></td>
                                <td><?php echo $readrow['fld_course_name']; ?></td>
                                <td><?php echo $readrow['fld_course_code']; ?></td>
                                <td><?php echo $readrow['fld_absence_type']; ?></td>
                                <td><?php echo $readrow['fld_absence_title']; ?></td>
                                <td>

                                    <button class="select-button" onclick="redirectToDetails('<?php echo $readrow['fld_user_id']; ?>', '<?php echo $readrow['fld_submission_id']; ?>')">DETAILS</button>

                                </td>
                            </tr>
                        <?php endforeach;

                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                   <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
                    <div class="pagination-button <?php if ($i == $page) echo 'selected'; ?>"><?php echo $i; ?></div>
                </a>
            <?php endfor; ?>
        </div>

    <?php else : ?>
        <p>No Records Found.</p>
    <?php endif; ?>

</div>
</div>

<script>
    function search() {
        document.forms[0].submit();
    }
</script>

<script>
    function redirectToDetails(user_id, submission_id) {
        // Redirect to admin_studentdetails.php with user_id and submission_id as parameters
        window.location.href = `approval_pending.php?user_id=${user_id}&submission_id=${submission_id}`;
    }
</script>
</body>

</html>