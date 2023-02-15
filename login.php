
<?php
  session_start();
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

  $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_login WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE tbl_login SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: login.php");
        }
    }
	
	
	
if (isset($_POST['submit'])){

$UserName=$_POST['username'];
$Password= md5($_POST['password']);
$sql=mysqli_query($conn,"select * from tbl_login where type=3");
$cnt=mysqli_num_rows($sql);

$login=mysqli_query($conn,"select * from tbl_login where email='$UserName' and password='$Password'");
$count=mysqli_num_rows($login);
$row=mysqli_fetch_array($login);
if ($count > 0){
$id=$row['id'];
$login2=mysqli_query($conn,"select * from users where login_id='$id'");
$rw=mysqli_fetch_array($login2);


// $login3=mysqli_query($conn,"select * from tbl_staff where login_id='$id'");
// $rw1=mysqli_fetch_array($login3);

// $admin=mysqli_query($conn,"select * from tbl_branch where login_id='$id'");
// $ad=mysqli_fetch_array($admin);
$_SESSION['login_id']=$row['id'];
$_SESSION['login_type']=$row["type"];
$_SESSION['login_branch_id']=$rw['branch_id'];
// $_SESSION['login_branch_id']=$row["branch_id"];
$user=$row['email'];
$type=$row['type'];
	 if($row["type"]=="2")
	    {
         if($row["status"]==1)
		 {
			 
		  $_SESSION['name'] = $row["name"];
		  
		   if (empty($row['code'])) {
            header('Location:staff/staff_index.php');
			//   $sql2="INSERT INTO tbl_history VALUES('','$email','$type','Login', NOW())";
		//   $result=$conn->query($sql2);
            } 
			else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
		 }
		 else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
	    } 
	  else if($row["type"]=="1")
	    {
		   
		  
		   $_SESSION['name'] = $row["name"];
		   $_SESSION['count'] =$cnt;
		  header('Location:admin.php');
	     
		  $sql2="INSERT INTO tbl_history VALUES('','$user','$type','Login', NOW())";
		  $result=$conn->query($sql2);
		
		}
	  else if($row["type"]=="3")
	     {
	         if($row["status"]==1)
		     {
		    $_SESSION['name'] = $row["name"];
			
		   
		    if (empty($row['code'])) {
              header('Location:user/user_index.php');
			  $sql2="INSERT INTO tbl_history VALUES('','$user','$type','Login', NOW())";
		      $result=$conn->query($sql2);
            } 
			else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
			 }
		  else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
		 }
		  else if($row["type"]=='2')
	     {
	         if($row["status"]==1)
		     {
				
		  $_SESSION['name'] = $row["sname"];
		   if (empty($row['code'])) {
		  header('Location:staff_dashboard.php');
	     $sql2="INSERT INTO tbl_history VALUES('','$B_email','$type','Login', NOW())";
		  $result=$conn->query($sql2);
			 }
			  
			else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
			 }
		  else{
		     $msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
			}
		 }
		 
	  else
	     {
	      $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
	     }
   }
   else
    {
	$msg = "<div class='alert alert-danger'>Incorrect username or Password.</div>";
	}
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login</title>
	<link rel="icon" type="image/png" href="images/icon.png" sizes="16x16">
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->
  
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script>
  $(document).on('click','#log',function()
  {  $("#captcha_message").hide();
 var response = grecaptcha.getResponse();
 if(response.length == 0)
 {
 $("#captcha_message").html("Please verify you are not a robot");
               $("#captcha_message").show();
 return false;
 }
 else{
 $("#captcha_message").hide();
 return true;
 }
  });
 
 
</script>

<style>
    
.error_form
{
top: 12px;
color: rgb(216, 15, 15);
    font-size: 15px;
font-weight:bold;
    font-family: Helvetica;
}

</style>

</head>

<body>

    <section class="w3l-mockup-form">
        <div class="container">
          
            <div class="workinghny-form-grid"> 
                <div class="main-mockup">
                    
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/login1.jpg" alt="">
                        </div>
                    </div>
                    <div id="google_element" class="content-wthree">
                       <a href="index.html"> <h3>Moovit</h3></a>
                        <h2>Login Now</h2>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="email" id="email" name="username" placeholder="Enter Your E-mail" required>
                            <input type="password" class="password" id="pass" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <br><span class="error_form" id="captcha_message"></span>
                            <div class="g-recaptcha" data-sitekey="6LdLyeUjAAAAABWuyGPJF30aX3xI4_26Lnc-UfrM"></div>
                            <br><button name="submit" id="log" name="submit" class="btn" type="submit">Login</button>
                            <div class="row">
          
                            <p><a href="forgotpass.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                        </form>
                        <div class="social-icons">
                            
							<p>  <a href="register.php">Signup!</a>.</p>
                        </div>
                        
                     
                    </div>
                </div>
            </div>
            <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
                        <script>
                            function loadGoogleTranslate() {
                                new google.translate.TranslateElement("google_element");
                            }
                        </script>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
<script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
                        <script>
                            function loadGoogleTranslate() {
                                new google.translate.TranslateElement("google_element");
                            }
                        </script>
</body>

</html>
