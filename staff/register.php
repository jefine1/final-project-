

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }
    //Load Composer's autoloader
    require 'vendor/autoload.php';

   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "mt1";
 
 // Create connection
$conn = new mysqli($servername, 
    $username, $password, $dbname);
	
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}

    $msg = "";

    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
		$lastname = mysqli_real_escape_string($conn, $_POST['last_name']);
		
		
		$address= mysqli_real_escape_string($conn, $_POST['address']);
		$contact= mysqli_real_escape_string($conn, $_POST['contact']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));
		
		
		function generateRandomString($length = 25) {
              $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
              $charactersLength = strlen($characters);
              $randomString = '';
             for ($i = 0; $i < $length; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
              }
             return $randomString;
              }
		
		
	 
			
		
			
			
		
	  
		
		
       $image=$_FILES['image']["name"];
       $temp = explode(".", $_FILES["image"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
       $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	   $image_name= addslashes($_FILES['image']['name']);
	   $image_size= getimagesize($_FILES['image']['tmp_name']);
	   move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" .$newfilename);			
			$location="upload/" .$newfilename;
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tbl_login WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } 
		
		else if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE contact='{$contact}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$contact} - This number has been already exists.</div>";
        }
		
		
		else {
            if ($password === $confirm_password) {
               $sql="INSERT INTO tbl_login VALUES (DEFAULT,'$firstname','$email','$password','3','$code',1)";
				$result = mysqli_query($conn, $sql);

                if ($result) {
					$val="SELECT id from tbl_login where email='".$email."'";
					if ($res=$conn->query($val)){
						foreach($res as $data)
						{
							$login_id=$data['id'];
						}
			
                         $sql2  = "INSERT INTO `users`(`id`, `login_id`, `firstname`, `lastname`, `email`, `address`, `contact`, `password`,`confirm_password`, `created_at`, `type`, `branch_id`, `date_created`, `img`) VALUES ('','$login_id','$firstname ','$lastname','$email','$address','$contact',' $password',$confirm_password, ,3, , ,'$location')";
                        $result2 = mysqli_query($conn, $sql2);
					}
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'moovitcs@gmail.com';                     //SMTP username
                        $mail->Password   = 'avcepxvubgaulgry';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('moovitcs@gmail.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'no reply';
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost/Moovit/login.php?verification='.$code.'">http://localhost/Moovit/login.php?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Registration</title>
    <link rel="icon" type="image/png" href="images/icon.png" sizes="16x16">
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css2/style.css" type="text/css" media="all" />
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

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

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
         
            <div class="workinghny-form-grid">
                <div class="main-mockup">
            
                    <div class="w3l_form align-self">
                       <div class="left_grid_info">
					  
					    
                       <img src="images/reg.gif"  alt="">
                           
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h3>Moovit</h3>
                        <h2> Sign Up</h2>
                  <div>
				   <?php echo $msg; ?>
				  <div>
                       
                        <form action="" method="post" id="registration_form" enctype="multipart/form-data">
                           
				<label>
					First Name
				</label> &nbsp; <span class="error_form" id="fname_error_message"></span>			   <div>
				<input type="text" id="form_fname" name="first_name" required="">
				
				
			</div>
			<div>
			<label>
					Last Name
				</label>&nbsp;	
				<span class="error_form" id="sname_error_message"></span>
				<input type="text" id="form_sname" name="last_name" required="">
				
				
			</div>
			
			
			
				
			
				
			<div><label>Address</label>	
				<input type="address" id="" name="address" required="">
				
			</div>
			
			<div><label>Contact</label>
			<span class="error_form" id="pno_error_message"></span>		<div>
				<input type="text" id="form_pno" name="contact" required="">
					
			</div>
			<label>Email id</label>	&nbsp;
               <span class="error_form" id="email_error_message"></span>		<div>	
				<input type="email" id="form_email" name="email" required="">
					
		
			<div><label>Password</label>&nbsp; 
			<span class="error_form" id="password_error_message"></span>	</div>
				<input type="password" id="form_password" name="password" required="">
				
					
		
			<div><label>Re-Enter Password</label>&nbsp; 	
              <span class="error_form" id="retype_password_error_message"></span>	</div>		
				<input type="password" id="form_retype_password" name="confirm_password" required="">
				
				
			</div>
			
			<div><label>Photo</label>&nbsp;
<span class="error_form" id="photo_error_message"></span>			
			  <input type="file" id="form_photo" name="image"/>
                            <button name="submit" class="btn" id="regbtn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="login.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
       $(function() {

         $("#fname_error_message").hide();
         $("#sname_error_message").hide();
		 $("#age_error_message").hide();
         $("#pno_error_message").hide();
         $("#gen_error_message").hide();
		
         $("#email_error_message").hide();
         $("#password_error_message").hide();
         $("#retype_password_error_message").hide();
		 $("#nomin_error_message").hide();
		 $("#symb_error_message").hide();
		 $("#proof_error_message").hide();
         $("#photo_error_message").hide();
		 
         var error_fname = false;
         var error_sname = false;
         var error_email = false;
		 var error_pno = false;
		 var error_gen = false;
	
		 var error_age = false;
         var error_password = false;
         var error_retype_password = false;
		 var error_nomin = false;
         var error_symb = false;
         var error_proof = false;
		 var error_photo = false;

         $("#form_fname").focusout(function(){
            check_fname();
         });
         $("#form_sname").focusout(function() {
            check_sname();
         });
            $("#form_age").focusout(function() {
            check_age();
         });
           
		 $("#form_pno").focusout(function() {
                check_pno();
            });
			
	    $("#form_gen").focusout(function() {
                check_gen();
            });
				
	  
			
         $("#form_email").focusout(function() {
            check_email();
         });
		  
         $("#form_password").focusout(function() {
            check_password();
         });
         $("#form_retype_password").focusout(function() {
            check_retype_password();
         });
		 
		 
		 $("#form_nomin").focusout(function() {
                check_nomin();
            });
			
	    $("#form_symb").focusout(function() {
                check_symb();
            });
				
	    $("#form_proof").focusout(function() {
                check_proof();
            });
			
         $("#form_photo").focusout(function() {
            check_photo();
         });
		 
		 

         function check_fname() {
            var pattern = /^[a-zA-Z]*$/;
            var fname = $("#form_fname").val();
            if (pattern.test(fname) && fname !== '') {
               $("#fname_error_message").hide();
               $("#form_fname").css("border-bottom","2px solid #34F458");
            } else {
               $("#fname_error_message").html("Should contain only Characters");
               $("#fname_error_message").show();
               $("#form_fname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }

         function check_sname() {
            var pattern = /^[a-zA-Z]*$/;
            var sname = $("#form_sname").val()
            if (pattern.test(sname) && sname !== '') {
               $("#sname_error_message").hide();
               $("#form_sname").css("border-bottom","2px solid #34F458");
            } else {
               $("#sname_error_message").html("Should contain only Characters");
               $("#sname_error_message").show();
               $("#form_sname").css("border-bottom","2px solid #F90A0A");
               error_fname = true;
            }
         }
		 
		 
		 function check_age() {
            var age = $("#form_age").val();
            if (age >18 ) {
               $("#age_error_message").hide();
               $("#form_age").css("border-bottom","2px solid #34F458");
            } else {
               $("#age_error_message").html("Age must be greaterthan 18");
               $("#age_error_message").show();
               $("#form_age").css("border-bottom","2px solid #F90A0A");
               error_gen = true;
            }
         }

		 
		 function check_nomin() {
             var image = document.getElementById("form_nomin");


        var size = parseFloat(image.files[0].size / (1024 * 1024)).toFixed(2); 

        if(size > 2) {

            $("#nomin_error_message").html("File too big(choose less than 4mb)");
                    $("#nomin_error_message").show();
                    $("#form_nomin").css("border-bottom","2px solid #F90A0A");
                    error_nomin = true;

        }else{
                  $("#nomin_error_message").hide();
                    $("#form_nomin").css("border-bottom","2px solid #34F458");

        }

         }
		 
		 
		 
		 
		 function check_symb() {
            const fi = document.getElementById('form_symb');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                    $("#symb_error_message").html("File too big(choose less than 4mb)");
                    $("#symb_error_message").show();
                    $("#form_symb").css("border-bottom","2px solid #F90A0A");
                    error_symb = true;
                } else {
                    $("#symb_error_message").hide();
                    $("#form_symb").css("border-bottom","2px solid #34F458");
                } 
            }
        }
         }
		 function check_proof() {
            const fi = document.getElementById('form_proof');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                    $("#proof_error_message").html("File too big(choose less than 4mb)");
                    $("#proof_error_message").show();
                    $("#form_proof").css("border-bottom","2px solid #F90A0A");
                    error_symb = true;
                } else {
                    $("#proof_error_message").hide();
                    $("#form_proof").css("border-bottom","2px solid #34F458");
                } 
            }
        }
         }
		 function check_photo() {
            const fi = document.getElementById('form_photo');
        // Check if any file is selected.
        if (fi.files.length > 0) {
            for (const i = 0; i <= fi.files.length - 1; i++) {
 
                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 4096) {
                    $("#photo_error_message").html("File too big(choose less than 4mb)");
                    $("#photo_error_message").show();
                    $("#form_photo").css("border-bottom","2px solid #F90A0A");
                    error_symb = true;
                } else {
                    $("#photo_error_message").hide();
                    $("#form_photo").css("border-bottom","2px solid #34F458");
                } 
            }
        }
         }
		 
		 function check_pno() {
                var pattern = /[0-9 -()+]+$/;
                var pno = $("#form_pno").val()
                if (pattern.test(pno) && pno.length == 10) {
                    $("#pno_error_message").hide();
                    $("#form_pno").css("border-bottom", "2px solid #34F458");
                } else {
                    $("#pno_error_message").html("Should contain only 10 digits");
                    $("#pno_error_message").show();
                    $("#form_pno").css("border-bottom", "2px solid #F90A0A");
                    error_pno = true;
                }
            }
			
			function check_gen() {
            var gen = $("#form_gen").val();
            if ( gen=='Male' || gen=='Female' ) {
               $("#gen_error_message").hide();
               $("#form_gen").css("border-bottom","2px solid #34F458");
            } else {
               $("#gen_error_message").html("Select Male or Female");
               $("#gen_error_message").show();
               $("#form_gen").css("border-bottom","2px solid #F90A0A");
               error_gen = true;
            }
         }
			
          
		
         
            function check_password() {
                var pattern =/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
                var password = $("#form_password").val();
                if (pattern.test(password) && password !== '') {
                    $("#password_error_message").hide();
                    $("#form_password").css("border-bottom", "2px solid #34F458");
                } else {
                    $("#password_error_message").html("Password format is:User@1234");
                    $("#password_error_message").show();
                    $("#form_password").css("border-bottom", "2px solid #F90A0A");
                    error_password = true;
                }
            }


         function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
               $("#retype_password_error_message").html("Passwords not Matched");
               $("#retype_password_error_message").show();
               $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
               error_retype_password = true;
            } else {
               $("#retype_password_error_message").hide();
               $("#form_retype_password").css("border-bottom","2px solid #34F458");
            }
         }

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#form_email").css("border-bottom","2px solid #34F458");
            } else {
               $("#email_error_message").html("Invalid Email");
               $("#email_error_message").show();
               $("#form_email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }
		 
         $("#registration_form").submit(function() {
         error_fname = false;
         error_sname = false;
         error_email = false;
		 error_pno = false;
		 error_gen = false;
		
		 error_age = false;
         error_password = false;
         error_retype_password = false;
		 error_nomin = false;
		 error_symb = false;
		 error_proof = false;
         error_photo = false;


            check_fname();
            check_sname();
			check_age();
			check_pno();
			check_gen();
		
            check_email();
            check_password();
            check_retype_password();
			
			
            if (error_fname === false && error_gen === false  && error_pno === false && error_age === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false ) {
               alert("Registration in process!!");
               return true;
            } else {
               alert("Please Fill the form Correctly");
               return false;
            }


         });
      });
    </script>

</body>

</html>