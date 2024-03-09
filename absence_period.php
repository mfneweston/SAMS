<?php
include_once 'db.php';
include_once 'session.php';
//include_once 'nav_bar_4.php';
include_once 'sidebar_student.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence Period</title>
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
            max-height: 180px;
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
            margin-top: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            /* Increase the distance between the search boxes and the box */
            padding: 20px;
        }

        .search-box select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .box {
            background: #fff;
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



    // Fetch distinct days from tbl_course_details
    // Fetch distinct days from tbl_course_details
    try {
        $stmt = $conn->prepare("SELECT DISTINCT fld_day FROM tbl_course_details");
        $stmt->execute();
        $days = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Fetch distinct course modes from tbl_course_details
    try {
        $stmt = $conn->prepare("SELECT DISTINCT fld_course_mode FROM tbl_course_details");
        $stmt->execute();
        $courseModes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Initialize result variable
    $result = array();

    // Fetch course details based on user ID, day, and course mode
    try {
        $sql = "SELECT se.*, cd.*, ud.fld_user_name
        FROM tbl_student_enrollment se
        JOIN tbl_course_details cd ON se.fld_course_code = cd.fld_course_code
        JOIN tbl_user_details ud ON cd.fld_lecturer_id = ud.fld_user_id
        WHERE se.fld_user_id = :id";

        $params = [':id' => $id];

        if (isset($_POST['search1']) && isset($_POST['search2'])) {
            $selectedDay = $_POST['search1'];
            $selectedCourseMode = $_POST['search2'];

            if ($selectedDay != 'All Days') {
                $sql .= " AND cd.fld_day = :day";
                $params[':day'] = $selectedDay;
            }

            if ($selectedCourseMode != 'all') {
                $sql .= " AND cd.fld_course_mode = :course_mode";
                $params[':course_mode'] = $selectedCourseMode;
            }
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
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

        <form method="post" action="">
            <div class="search-box">
                <select style="margin-left: 30px;" name="search1" id="search1">
                    <option value="All Days" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'All Days') echo 'selected'; ?>>All Days</option>
                    <option value="Monday" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'Monday') echo 'selected'; ?>>Monday</option>
                    <option value="Tuesday" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                    <option value="Wednesday" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                    <option value="Thursday" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                    <option value="Friday" <?php if (isset($_POST['search1']) && $_POST['search1'] == 'Friday') echo 'selected'; ?>>Friday</option>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>

                <select style="margin-left: 30px;" name="search2" id="search2">
                    <option value="all" <?php if (isset($_POST['search2']) && $_POST['search2'] == 'all') echo 'selected'; ?>>All Modes</option>
                    <?php foreach ($courseModes as $courseMode) : ?>
                        <option value="<?php echo $courseMode['fld_course_mode']; ?>" <?php if (isset($_POST['search2']) && $_POST['search2'] == $courseMode['fld_course_mode']) echo 'selected'; ?>><?php echo $courseMode['fld_course_mode']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button style="margin: 20px;" type="submit">SEARCH</button>
            </div>
        </form>




        <div class="box">
            <?php if (!empty($result)) : ?>
                <table>
                    <thead>
                        <tr class="header-row">
                            <th>CODE</th>
                            <th>COURSE NAME</th>
                            <th>LECTURER NAME</th>
                            <th>MODE</th>
                            <th>TIME</th>
                            <th>DAY</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($result_pagination as $readrow) : ?>
                            <tr>
                                <td><?php echo $readrow['fld_course_code']; ?></td>
                                <td><?php echo $readrow['fld_course_name']; ?></td>
                                <td><?php echo $readrow['fld_user_name']; ?></td>
                                <td><?php echo $readrow['fld_course_mode']; ?></td>
                                <td><?php echo $readrow['fld_time']; ?></td>
                                <td><?php echo $readrow['fld_day']; ?></td>
                                <td>
                                    <!-- Pass both user_id and course_code to the absence_reason.php page -->
                                    <button class="select-button" onclick="window.location.href='absence_reason.php?user_id=<?php echo $id; ?>&course_code=<?php echo $readrow['fld_course_code']; ?>'">SELECT</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>


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
                <p>No results found.</p>
            <?php endif; ?>
        </div>

    </div>

    <script>
        function search() {
            // Submit the form when the search button is clicked
            document.forms[0].submit();
        }
    </script>

</body>

</html>