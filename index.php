
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STUDENT ABSENTEEISM MANAGEMENT SYSTEM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      background: url('pictures/ukmmm.jpg') center center / cover no-repeat fixed;
      margin: 0;
      padding: 0;
      height: 100vh;
    }

    .container {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: auto; /* Added overflow: hidden to prevent unnecessary scrollbar */
    }
    .bg-1 {
      background-color: #ffff; 
      color: #000000
  }
   .bg-2 {
      background-color: #dff9fb;
      color: #000000
    }
    .bg-3 {
        background-color: #dff9fb; /* White */
        color: #555555;
    }
    .container-fluid.bg-1,
    .container-fluid.bg-2,
    .container-fluid.bg-3 {
      padding-top: 30px; /* Adjusted padding for smaller sections */
      padding-bottom: 30px; /* Adjusted padding for smaller sections */
    }

    .card {
      margin: 0 auto;
      border-radius: 10px;
      background-color: #CFF0F9;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 500px;
      width: 1000px;
      margin-top: 1px;
    }

    .card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      margin-top: 10%;
    }

    .center-text {
      text-align: center;
      font-family: 'Poppins', sans-serif;
      margin-top: 25%;
    }

    .img {
      height: 50px;
      margin-left: 10px;
    }

    /* Added new styles for the scrollable page and fixed navbar */
    .scrollable-page {
      height: 100vh;
      overflow-y: auto;
      padding-top: 56px; /* Adjusted padding to account for the fixed navbar height */
    }

    .navbar.fixed-top {
      padding-top:-100px;
    padding-bottom: -100px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 14px;
    letter-spacing: 3px;
    }

    .bg-4 {
    background-color: #2f2f2f;
    color: #ffffff;
}

 .container-fluid.bg-1 h3 {
      font-family: 'Your Desired Font', cursive;
    }

 footer.container-fluid.bg4 {
      padding-top: 15px; /* Adjusted padding for a smaller footer */
      padding-bottom: 15px; /* Adjusted padding for a smaller footer */
      background-color: #ffff;
      color: #000000
    }
    .container-fluid.bg-2 h3 {
      font-family: 'Times New Roman', serif; /* Changed font-family to Times New Roman */
      font-size: 20px; /* Adjusted font size */
      padding-bottom: 25px;
    }


  </style>

</head>

<body>

  <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #FFFFFF;">

    <div class="container-fluid">
      <img class="img" src="pictures/vertical_logo.jpg" alt="Your Image Description">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">

        <ul class="navbar-nav">
          <li class="nav-item nav-link active">
            <a class="nav-link active" aria-current="page" href="index.php"><b>Home</b></a>
          </li>
          <!-- <li class="nav-item nav-link ">
            <a class="nav-link" href="about1.php"><b>About</b></a>
          </li> -->
          <li class="nav-item nav-link ">
            <a class="btn btn-primary" href="login_page.php">Log in</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



   <div class="container scrollable-page">
    <div class="row justify-content">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body text-center">
            <div class="row">
              <div class="col-md-6">
                <img src="pictures/ukm-logo.png" alt="UKM LOGO" class="image">
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <div class="center-text">
                  <h2><b>STUDENT ABSENTEEISM</b></h2>
                  <h2><b>MANAGEMENT SYSTEM</b></h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<div class="container-fluid bg-1 text-center" id="hello">
  <h3>ABOUT US</h3>
  
  <!-- <h3>This is Cyphezzy who developed Student Absenteeism Management System</h3> -->
</div>

<div class="container-fluid bg-2 text-center" id="who">
  <h3>A Student Absenteeism Management System is a comprehensive tool designed to streamline and enhance the management of student attendance within educational institutions. This system typically features an efficient database for recording daily attendance, allowing teachers and administrators to easily monitor and track student presence. Notably, it often incorporates alert mechanisms to promptly notify parents or guardians in cases of unexpected absences. With reporting and analytics capabilities, the system enables administrators to analyze attendance patterns, identify trends, and implement proactive measures to address chronic absenteeism. Integration with other school management systems ensures seamless data flow, while a user-friendly interface facilitates easy navigation for teachers, administrators, and parents alike. By automating processes and providing parental access to attendance records, these systems contribute to improved school management, increased parental involvement, and ultimately, better student performance.</h3>
  <img src="/pictures/IMG_5292.jpg" class="img-responsive" alt="Image" width="40%">

  <div class="row">
    <div class="col-sm-4">
      
      
    </div>
  </div>
    </div>
  
<footer class="container-fluid bg4 text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Copyright © Cyphezzy 2024</p>
</footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>