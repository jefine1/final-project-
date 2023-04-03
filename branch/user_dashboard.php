<?php
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mt1";
 
 // Create connection
$conn = new mysqli($servername,$username,$password,$dbname);
	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
  
    <link rel="stylesheet" href="css/style3.css" />
    <title>User_dashboard</title>

    <link rel="icon" type="image/png" href="images/icon.png" sizes="16x16">
	<style>
		img {
    display: inline-block;
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius:50%;
   
    box-shadow: 0 2px 6px #0003;
}
.button-24 {
            background: #FF4742;
            border: 1px solid #FF4742;
            border-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: nunito, roboto, proxima-nova, "proxima nova", sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 12px 14px;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
        }
        
        .button-24:hover,
        .button-24:active {
            background-color: initial;
            background-position: 0 0;
            color: #FF4742;
        }
        
        .button-24:active {
            opacity: .5;
        }
        
        .button-44 {
            background: #FF4742;
            border: 1px solid #FF4742;
            border-radius: 6px;
            margin-left:90%;
            box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-block;
            font-family: nunito, roboto, proxima-nova, "proxima nova", sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 16px;
            min-height: 40px;
            outline: 0;
            padding: 12px 14px;
            text-align: center;
            text-rendering: geometricprecision;
            text-transform: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
        }
        
        .button-44:hover,
        .button-44:active {
            background-color: initial;
            background-position: 0 0;
            color: #FF4742;
        }
        
        .button-44:active {
            opacity: .5;
        }
</style>
  </head>
<body onload=display_ct();>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
       
        
<span id='ct' class="clock" ></span>

          <form class="d-flex ms-auto my-3 my-lg-0">
		  
            <div class="input-group">
             
			<!-- <img width="60" height="50" src="<?php echo $_SESSION['img'];?>">&nbsp; -->
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              
              <a
                class=""
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                style="text-decoration: none; color: #fff; font-weight: bold;"
                
              >
              <p > </p> 
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
				<li><a class="dropdown-item" href="changepassword.php">Change Password</a></li>
                <li><a class="dropdown-item" href="logout.php?id=<?php echo $_SESSION['id'];?>">Log Out</a></li>
          
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
		   <li>
              <a href="user_dashboard.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Welcome </span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              <a href="user_profile.php">Profile</a>
              </div>
            </li>
            </li>
            <li>
              <a href="ship.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>New Shippment</span>
              </a>
            </li>
            <li>
              <a href="oldship.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-building"></i></span>
                <span>Shippments</span>
              </a>
            </li>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
            <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
   
          </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
