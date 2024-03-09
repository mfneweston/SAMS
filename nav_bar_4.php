<style>
  .navbar {
    background-color: #FFFFFF;
    width: 100%;
    position: fixed;
    /* Fix the navbar at the top */
    top: 0;
    /* Position it at the top */
    z-index: 1000;
    /* Ensure it's above other content */
  }

  /* Add this style for the logo link */
  .navbar a {
    background-color: transparent;
  }

  /* Remove hover effect for the logo link */
  .navbar a:hover {
    background-color: transparent;
  }

  /* Add this style for the logo to make it non-clickable and without hover effect */
  .navbar a img {
    pointer-events: none;
    cursor: default;
  }

  .navbar .btn-primary:hover {
    background-color: #fff;
    /* Change to the desired light color */
    color: #04AA6D;
    /* Change to the desired text color */
  }


  .navbar .container-fluid {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    /* Adjust padding as needed */
  }

  .navbar .navbar-toggler {
    border: none;
    outline: none;
    cursor: pointer;
  }

  .navbar .navbar-toggler-icon {
    background-color: #000;
    /* Change color as needed */
    width: 30px;
    height: 3px;
    display: block;
    margin-top: 5px;
    border-radius: 1px;
  }

  .navbar .navbar-nav {
    list-style: none;
    display: flex;
    align-items: center;
  }

  .navbar .nav-item {
    margin: 0 10px;
    /* Adjust margin as needed */
  }

  .navbar .nav-link {
    color: #000;
    /* Change color as needed */
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    /* Adjust font size as needed */
  }

  .navbar .nav-link:hover {
    color: #04AA6D;
    /* Change color on hover as needed */
  }

  .navbar .btn-primary {
    background-color: #04AA6D;
    /* Change button color as needed */
    color: #fff;
    /* Change text color as needed */
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
  }

  .user-info {
    display: flex;
    align-items: center;
    margin-right: 10px;
    /* Adjust margin as needed */
  }

  .user-info img {
    width: 30px;
    /* Adjust image width as needed */
    height: 30px;
    /* Adjust image height as needed */
    border-radius: 50%;
    margin-right: 5px;
    /* Adjust margin as needed */
  }

  .user-info .user-name {
    color: #000;
    /* Change text color as needed */
    font-weight: bold;
    font-size: 16px;
    /* Adjust font size as needed */
    margin-right: 10px;
  }
</style>

<nav class="navbar">
  <div class="container-fluid">
    <a href="index.php">
      <img class="img" src="pictures/vertical_logo.jpg" alt="Logo">
    </a>
    <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
      <ul class="navbar-nav">
        <li class="nav-item nav-link">
          <div class="user-info">
            <span class="user-name"><?php echo $name; ?></span>

            <?php
            if (!empty($readrow['fld_user_image'])) {
              echo '<img src="pictures/' . $readrow['fld_user_image'] . '" alt="Your Image Description"  style="width: 50px;height:60px;">';
            } else {
              echo '<img src="pictures/no_photo.jpg" alt="No Photo"  style="width: 50px;height:60px;"">';
            }
            ?>
          </div>
        </li>
        <li class="nav-item nav-link ">
          <a class="btn btn-primary" href="student_menu.php" style="margin-inline: 10px;">MENU</a>
          <a class="btn btn-primary" href="logout.php">LOGOUT</a>
        </li>
      </ul>
    </div>
  </div>
</nav>