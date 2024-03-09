<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Graph</title>

    <link rel="stylesheet" href="style.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #0098B9, #ECF6F9);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 800px;
            /* Adjust max-width to your preference */
            text-align: center;
            margin-top: 20px;
            overflow-x: auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .top-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 20px;
            overflow-x: auto;
            width: 50%;
            margin-left: 22%;
        }

        .bottom-cards {
            display: flex;
            gap: 20px;
            width: 100%;
            max-width: 800px;
            /* Adjust max-width to your preference */
            margin-top: 20px;
        }

        .box {
            background: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            flex: 1;
            overflow-x: auto;
        }

        .graph-container {
            width: 100%;
            max-width: 100%;
            /* Set maximum width to 100% */
            height: 200px;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="top-box">
            <h2>Graph 1</h2>
            <div class="graph-container">
                <canvas id="graph1"></canvas>
            </div>
        </div>

        <div class="bottom-cards">
            <div class="box">
                <h2>Graph 2</h2>
                <div class="graph-container">
                    <canvas id="graph2"></canvas>
                </div>
            </div>

            <div class="box">
                <h2>Graph 3</h2>
                <div class="graph-container">
                    <canvas id="graph3"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Example data for graphs
        var dataGraph1 = {
            labels: ["Label 1", "Label 2", "Label 3"],
            datasets: [{
                label: "Dataset 1",
                data: [30, 50, 20],
                backgroundColor: ["red", "green", "blue"]
            }]
        };

        var dataGraph2 = {
            labels: ["Label A", "Label B", "Label C"],
            datasets: [{
                label: "Dataset 2",
                data: [10, 40, 60],
                backgroundColor: ["orange", "purple", "pink"]
            }]
        };

        var dataGraph3 = {
            labels: ["Label X", "Label Y", "Label Z"],
            datasets: [{
                label: "Dataset 3",
                data: [5, 70, 25],
                backgroundColor: ["yellow", "brown", "cyan"]
            }]
        };

        // Initialize graphs using Chart.js
        var ctxGraph1 = document.getElementById('graph1').getContext('2d');
        var myGraph1 = new Chart(ctxGraph1, {
            type: 'bar',
            data: dataGraph1
        });

        var ctxGraph2 = document.getElementById('graph2').getContext('2d');
        var myGraph2 = new Chart(ctxGraph2, {
            type: 'pie',
            data: dataGraph2
        });

        var ctxGraph3 = document.getElementById('graph3').getContext('2d');
        var myGraph3 = new Chart(ctxGraph3, {
            type: 'line',
            data: dataGraph3
        });
    </script>
</body>

</html>