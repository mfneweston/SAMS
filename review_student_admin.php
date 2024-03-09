<?php
include_once 'db.php';
include_once 'session.php';
//include_once 'nav_bar_4.php';
include_once 'sidebar_admin.php';

// Number of records per page
$recordsPerPage = 10;

// Current page, default to 1 if not set
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $recordsPerPage;

try {
    $stmt = $conn->prepare("SELECT DISTINCT fld_absence_type FROM tbl_submission_details");
    $stmt->execute();
    $type = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total records and pages for pagination
    if (isset($_POST['search1']) && $_POST['search1'] !== 'ALL') {
        $selectedType = $_POST['search1'];
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_submission_details WHERE fld_absence_type = :type");
        $stmt->bindParam(':type', $selectedType, PDO::PARAM_STR);
    } else {
        $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_submission_details");
    }

    $stmt->execute();
    $row = $stmt->fetch();
    $totalRecords = $row['total'];
    $totalPages = ceil($totalRecords / $recordsPerPage);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$result = array();

$selectedDate = date('m');

// try {

//     $query = "SELECT sd.fld_absence_type, sd.fld_user_id, sd.fld_absence_date
//     FROM tbl_submission_details sd
//     JOIN tbl_user_details ud ON sd.fld_user_id = ud.fld_user_name
//     WHERE sd.fld_user_id = :id
//     AND MONTH(sd.fld_absence_date) = :selectedDate";

//     $params = [
//         ':id' => $id,
//         ':selectedDate' => $selectedDate,
//     ];

//     if (isset($_POST['search']) && $_POST['search1'] !== 'ALL') { //untuk filter specify reason
//         $selectedType = $_POST['search1'];
//         $query .= " AND sd.fld_absence_type = :type";
//         $params[':type'] = $selectedType;
//     }

//     $stmt = $conn->prepare($query);
//     $stmt->execute($params);
//     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Student Absence Activity</title>
    <link rel="stylesheet" href="style.css">
    <!-- Add your existing style imports here -->
    <style>
        /* Add your existing styles here */
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

        /* ... (rest of your existing styles) ... */

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
            margin-top: 95px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .button {
            padding: 10px 20px;
            /* Set the fixed width here */
            background: #fff;
            color: #000000;
            border: none;
            cursor: pointer;
            border-radius: 15px;
            width: 200px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            display: block;
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
            margin-top: 80px;
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
            margin-bottom: 150px;
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
        }

        .page-link.active {
            background-color: #007187;
            color: white;
        }
    </style>
</head>

<body>
    <?//php include_once 'nav_bar_4.php'; ?>

    <div>

        <form method="post" name="search" action="">
            <div class="search-box" style="padding-bottom: 20px;">
                <div class="now-showing">Specify Reason: </div>
                <?php
                $selectedType = isset($_POST['search1']) ? $_POST['search1'] : 'ALL';
                ?>
                <select style="margin-left: 30px;" name="search1" id="search1">
                    <option value="ALL" <?= ($selectedType == 'ALL') ? 'selected' : '' ?>>ALL REASONS</option>
                    <option value="MEDICAL" <?= ($selectedType == 'MEDICAL') ? 'selected' : '' ?>>MEDICAL</option>
                    <option value="EVENT" <?= ($selectedType == 'EVENT') ? 'selected' : '' ?>>EVENT</option>
                    <option value="PERSONAL" <?= ($selectedType == 'PERSONAL') ? 'selected' : '' ?>>PERSONAL</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>
            </div>
        </form>

        <!-- <div class="buttons">
            <a style="font-size: 15px" href="admin_menu.php" class="button">Home</a>
            <button style="font-size: 15px; background-color: orange;" class="button">Overview</button>
            <a style="font-size: 15px" href="generate_report.php" class="button">Generate Report</a>
        </div> -->

        <div class="box">
            <div class="record-container">
                <img src="pictures/checklist.png" class="img-record">
                <div class="record">STUDENT ABSENCE RECORDS: <span style="color: red; font-weight:bold;"></span></div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>MATRIC. NO</th>
                        <th>NAME</th>
                        <th>ABSENCE TYPE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {

                        // Fetch data with pagination
                        // $stmt = $conn->prepare("SELECT tbl_submission_details.fld_user_id, tbl_submission_details.fld_submission_id, tbl_user_details.fld_user_name, tbl_submission_details.fld_absence_type 
                        //     FROM tbl_submission_details
                        //     INNER JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
                        //     LIMIT :offset, :recordsPerPage");
                        if (isset($_POST['search1']) && $_POST['search1'] !== 'ALL') { //untuk filter specify reason
                            $selectedType = $_POST['search1'];
                            $query = "SELECT tbl_submission_details.fld_user_id, tbl_submission_details.fld_submission_id, tbl_user_details.fld_user_name, tbl_submission_details.fld_absence_type 
                            FROM tbl_submission_details
                            INNER JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
                            WHERE tbl_submission_details.fld_absence_type = :type
           LIMIT :offset, :recordsPerPage
        ";
         $stmt = $conn->prepare($query);
                            $stmt->bindParam(':type', $selectedType, PDO::PARAM_STR);
                            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                            $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    } else {
                            // $selectedType = 'ALL';
        $query = "SELECT tbl_submission_details.fld_user_id, tbl_submission_details.fld_submission_id, tbl_user_details.fld_user_name, tbl_submission_details.fld_absence_type 
        FROM tbl_submission_details
        INNER JOIN tbl_user_details ON tbl_submission_details.fld_user_id = tbl_user_details.fld_user_id
        --   WHERE tbl_submission_details.fld_absence_type = :type
        LIMIT :offset, :recordsPerPage";
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
                            //   $stmt->bindParam(':type', $selectedType, PDO::PARAM_STR);
    

    }


    $stmt->execute();
    $result = $stmt->fetchAll();


                        // Display the table
                        $productCount = 0;  // Initialize $productCount
                        foreach ($result as $readrow) {
                            if ($productCount % 2 == 0) {
                                echo '<div class="row-container">';
                            }

                            $fontColor = '';
                            $fontWeight = '';

                            switch ($readrow['fld_absence_type']) {
                                case 'MEDICAL':
                                $fontColor = 'green';
                                $fontWeight = 'bold';
                                break;
                                case 'EVENT':
                                $fontColor = 'red';
                                $fontWeight = 'bold';
                                break;
                                case 'PERSONAL':
                                $fontColor = 'blue';
                                $fontWeight = 'bold';
                                break;
                            }

                            // Display table rows
                            echo "<tr>";
                            echo "<td>{$readrow['fld_user_id']}</td>";
                            echo "<td>{$readrow['fld_user_name']}</td>";
                            echo "<td style='color: $fontColor; font-weight: $fontWeight;'>{$readrow['fld_absence_type']}</td>";
                            echo "<td><button class='select-button' onclick='redirectToDetails(\"{$readrow['fld_user_id']}\", \"{$readrow['fld_submission_id']}\")'>DETAILS</button></td>";
                            echo "</tr>";

                            $productCount++;

                            if ($productCount % 2 == 0) {
                                echo '</div>';
                            }
                        }


                        // Pagination links
                        if (!isset($_POST['search1']) || ($_POST['search1'] !== 'ALL')) {
                            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_submission_details");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                        }

                        if (isset($_POST['search1']) && $_POST['search1'] === 'ALL') {
                            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM tbl_submission_details");
                            $stmt->execute();
                            $row = $stmt->fetch();
                            $totalRecords = $row['total'];
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                        }

                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </tbody>
            </table>
            <div class='pagination'>
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = ($current_page == $i) ? 'active' : '';
                    echo "<a class='page-link $activeClass' href='?page=$i'>$i</a>";
                }
                ?>
            </div>

        </div>
    </div>

    <script>
        function search() {
            document.forms[0].submit();
        }
    </script>

    <script>
        function redirectToDetails(user_id, submission_id) {
            window.location.href = 'admin_studentdetails.php?user_id=' + user_id + '&submission_id=' + submission_id;
        }
    </script>

</body>

</html>