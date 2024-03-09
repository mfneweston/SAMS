
<?php
include_once 'db.php';
include_once 'session.php';
//include_once 'nav_bar_4.php';
include_once 'sidebar_lecturer.php';

//echo $name;

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
    </style>

</head>


<body>

    <!-- <div class="img-user">

        </*?php
        if (!empty($readrow['fld_user_image'])) {
            echo '<img src="pictures/' . $readrow['fld_user_image'] . '" alt="Your Image Description"  style="width: 50px;height:60px;">';
        } else {
            echo '<img src="pictures/no_photo.jpg" alt="No Photo"  style="width: 50px;height:60px;"">';
        }*/
        ?>

        <span><?//php echo $readrow['fld_user_id']; ?></span>-
        <span><?//php echo $readrow['fld_user_name']; ?></span>
    </div> -->


    <?php
    try {
    // Fetch data from your table in PHP
        $stmt = $conn->prepare("SELECT fld_absence_title, COUNT(*) as frequency FROM tbl_submission_details WHERE fld_lecturer_name = :name AND fld_absence_type = 'MEDICAL' AND fld_status = 'ACCEPTED' GROUP BY fld_absence_title");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare arrays for chart labels and data
        $labels = [];
        $frequencies = [];

    // Loop through the fetched data and populate chart arrays
        foreach ($data as $row) {
            $labels[] = $row['fld_absence_title'];
            $frequencies[] = $row['frequency'];
        }

    // Convert chart data to JSON format
        $chart_data = [
            'labels' => $labels,
            'frequencies' => $frequencies
        ];

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    //echo json_encode($chart_data);
    ?>


    <div class="logo">
        <img src="pictures/ukm-logo.png" alt="Your Image Description">
    </div>



    <!-- <button class="logout-button btn btn-secondary" style="background-color: white; color: black;" onclick="window.location.href='absence_period.php'">Back</button> -->


    <form method="post" action="submission.php" enctype="multipart/form-data">

        <div class="box-container">
            <div class="box" id="first-box" style="margin-top: 100px">
                <!-- Content for the first box -->
                <!-- ... -->
                <p>Student Attendance</p>
                <canvas id="barChart" width="800" height="400"></canvas>

            </div>
        </div>
    </div>
</div>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


<script>
    var barChart1Data = <?php echo json_encode($chart_data); ?>;

    var ctxBar = document.getElementById("barChart").getContext("2d");
    var barChart1 = new Chart(ctxBar, {
        type: "bar",
        data: {
            labels: barChart1Data.labels,
            datasets: [{
                label: "Absences",
                data: barChart1Data.frequencies,
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



</script>
</body>

</html>