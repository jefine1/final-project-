<?php
  include('session.php');
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
$id=$_SESSION['id'];
$sql=mysqli_query($conn,"select * from users where login_id='$id'");
$row=mysqli_fetch_array($sql);
$sql2=mysqli_query($conn,"select * from tbl_login where id='$id'");
$row2=mysqli_fetch_array($sql2);

 if (isset($_POST['submit'])) {

$id=$_SESSION['id'];
$sql=mysqli_query($conn,"select * from tbl_branch where login_id='$id'");
$row=mysqli_fetch_array($sql);
$sql2=mysqli_query($conn,"select * from tbl_login where id='$id'");
$row2=mysqli_fetch_array($sql2);
        $firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
$lastname = mysqli_real_escape_string($conn, $_POST['last_name']);
$address= mysqli_real_escape_string($conn, $_POST['address']);
$contact= mysqli_real_escape_string($conn, $_POST['contact']);
       

$sql="UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`contact`='$contact',`address`='$address' WHERE login_id='$id'";
$result = mysqli_query($conn, $sql);
if($sql) {
              header('Location:userproedit.php');
 }
 }
 if (isset($_POST['upload'])) {

$id=$_SESSION['id'];
       $image=$_FILES['image']["name"];
       $temp = explode(".", $_FILES["image"]["name"]);
       $newfilename = round(microtime(true)) . '.' . end($temp);
       $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
  $image_name= addslashes($_FILES['image']['name']);
  $image_size= getimagesize($_FILES['image']['tmp_name']);
  move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" .$newfilename);
$location="upload/" .$newfilename;
       

$sql="UPDATE `users` SET `img`='$location' WHERE login_id='$id'";
$result = mysqli_query($conn, $sql);
if($sql) {
              header('Location:userproedit.php');
 }
 }

?>
<html lang="en">
  <head>
  <style>
 
 @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');

* {
    box-sizing: border-box;
}

body>div{
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', sans-serif;
}

.table_responsive {
   max-width: 900px;
    border: 1px solid #00bcd4;
    background-color: #efefef33;
    padding:10px;
    overflow: auto;
    margin: auto;
    border-radius:10px;
}

table {
    width:100%;
overflow:hidden;
    font-size: 13px;
    color: #444;
    white-space: nowrap;
    border-collapse: collapse;
align-items:center;
}

table>thead {
    background-color:green;
    color: #fff;
}

table>thead th {
   padding: 15px;
}

table th,
table td {
    border: 1px solid #00000017;
    padding:auto;
}

table>tbody>tr>td>img {
    display: inline-block;
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius:30%;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px #0003;
}

.deletebtn {
font-family: Arial;
color: #FFFFFF;
font-size: 12px;
text-decoration:none;
border-radius: 5px;
border: 1px #d83526 solid;
background: linear-gradient(180deg, #fe1900 5%, #ce0000 100%);
text-shadow: 1px 1px 1px #b23d35;
box-shadow: inset 1px 1px 2px 0px #f29d93;
cursor: pointer;
display: inline-flex;
align-items: center;
}
.deletebtn:hover {
color: #FFFFFF;
background: linear-gradient(180deg, #ce0000 5%, #fe1900 100%);
}
.deletebtn-icon {
padding: 10px 0px;
}
.deletebtn-icon svg {
vertical-align: middle;
position: relative;
top: -1px;
left: 11px;
}
.deletebtn-text {
padding: 10px 18px;
}

.editbtn {
font-family: Arial;
color: #FFFFFF;
font-size: 12px;
border-radius: 5px;
text-decoration:none;
border: 1px #3381ed solid;
background: linear-gradient(180deg, #3d93f6 5%, #1e62d0 100%);
text-shadow: 1px 1px 1px #1571cd;
box-shadow: inset 1px 1px 2px 0px #97c4fe;
cursor: pointer;
display: inline-flex;
align-items: center;
}
.editbtn:hover {
background: linear-gradient(180deg, #1e62d0 5%, #3d93f6 100%);
color: #FFFFFF;
}
.editbtn-icon {
padding: 10px 7px;
}
.editbtn-icon svg {
vertical-align: middle;
position: relative;
top: -1px;
left: 11px;
}
.editbtn-text {
padding: 10px 14px;
}


table>tbody>tr {
    background-color: #fff;
    transition: 0.3s ease-in-out;
}


table>tbody>tr:nth-child(even) {
    background-color: rgb(238, 238, 238);
}

table>tbody>tr:hover{
    filter: drop-shadow(0px 2px 6px #0002);
}


  input[type=text],input[type=email],input[type=number]select {
  width:30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width:40%;
  background-color: #2a5889;
  margin-left:20%;
  color: white;
  padding: 7px 17px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #28517c;
}


input[type=reset] {
  width:20%;
  background-color:red;
  color: white;
  padding: 10px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
margin-left:25%;
}



#div {
  border-radius: 5px;
  padding: 20px;
  width:17%;
  height:45 %;
  margin-left:26%;
 background-color:#ffffff;
  margin-top:25%;
}
#h1{

margin-left:30%;
font-size:32px;
color:blue;
 font-family: "Times New Roman", Times, serif;
}

.css-button {
font-family: Arial;
color: #ffffff;
text-decoration: none;
font-size: 12px;
padding:1px 5px;
border-radius: 5px;
border: 1px #74b807 solid;
background: linear-gradient(180deg, #8ac403 5%, #78a809 100%);
text-shadow: 1px 1px 1px #528009;
box-shadow: inset 1px 1px 2px 0px #a4e271;
cursor: pointer;
display: inline-flex;
align-items: center;
}
.css-button:hover {
background: linear-gradient(180deg, #78a809 5%, #8ac403 100%);
 color:#FFFFFF;
}
.css-button-icon {
padding: 10px 10px;
border-right: 1px solid rgba(255, 255, 255, 0.16);
box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button-icon svg {
vertical-align: middle;
position: relative;
}
.css-button-text {
padding: 10px 18px;
}



.css-button2 {
font-family: Arial;
color: #ffffff;
font-size: 12px;
text-decoration: none;
padding:1px 5px;
border-radius: 5px;
border: 1px #3381ed solid;
background: linear-gradient(180deg, #0000cd 5%, #14149e 100%);



text-shadow: 1px 1px 1px #1571cd;
box-shadow: inset 1px 1px 2px 0px #97c4fe;
cursor: pointer;
display: inline-flex;
align-items: center;
}
.css-button2:hover {
  background: linear-gradient(180deg, #14149e 5%, #0000cd 100%);
  color:#FFFFFF;
}
.css-button2-icon {
padding: 10px 10px;
border-right: 1px solid rgba(255, 255, 255, 0.16);
box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button2-text {
padding: 10px 18px;
}

.css-button3{
font-family: Arial;
color: #FFFFFF;
font-size: 12px;
text-decoration: none;
font-size: 12px;
padding:1px 5px;
border-radius: 5px;
border: 1px #d83526 solid;
background: linear-gradient(180deg, #fe1900 5%, #ce0000 100%);
text-shadow: 1px 1px 1px #b23d35;
box-shadow: inset 1px 1px 2px 0px #f29d93;
cursor: pointer;
display: inline-flex;
align-items: center;
}
.css-button3:hover {
background: linear-gradient(180deg, #ce0000 5%, #fe1900 100%);
color: #FFFFFF;
}
.css-button3-icon {
padding: 10px 10px;
border-right: 1px solid rgba(255, 255, 255, 0.16);
box-shadow: rgba(0, 0, 0, 0.14) -1px 0px 0px inset;
}
.css-button3-text {
padding: 10px 18px;
}
#btngrp{
margin-left:14.5%;
}


img {
    display: inline-block;
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius:50%;
   
    box-shadow: 0 2px 6px #0003;
}


.img2 {
    display: inline-block;
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius:50%;
   margin-top:30%;
    box-shadow: 0 2px 6px #0003;
}


<style>
body {
  background: #BA68C8;
}

.form-control:focus {
  box-shadow: none;
  border-color: #BA68C8;
}

.profile-button {
  background: #BA68C8;
  box-shadow: none;
  border: none;
}

.profile-button:hover {
  background: #682773;
}

.profile-button:focus {
  background: #682773;
  box-shadow: none;
}

.profile-button:active {
  background: #682773;
  box-shadow: none;
}

.back:hover {
  color: #682773;
  cursor: pointer;
}

</style>

  </style>
 
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"/>
 
    <link rel="stylesheet" href="css/style3.css" />
      <title>Edit user</title>
      <link rel="icon" type="image/png" href="images/icon.png" sizes="16x16">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
 
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
       
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
           <div class="input-group">
<div>
               <img width="60" class="img" height="50" src="<?php echo $_SESSION['img'];?>">&nbsp;
  </div>
  <h4 style="font-family:Garamond,serif;font-size:20px;margin:auto;"><?php echo $_SESSION['name']; ?></h4>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
  <li><a class="dropdown-item" href="user_profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="changepassword.php?id=<?php echo $_SESSION['id'];?>">Change Password</a></li>
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
            </li>
            <li>
              <a href="user_dashboard.php   " class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Welcome <?php echo $_SESSION['name']; ?></span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
             
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
           
          </div>
 
 
  <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
<link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"/>

       <form action="" method="POST" enctype="multipart/form-data">
<div class="container rounded bg-white mt-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="img2" src="<?php echo $row['img']?>" width="90"><i id="myBtn" class="fa fa-camera" aria-hidden="true"></i></span><span class="font-weight-bold"><?php echo $row['firstname']."".$row['lastname']?></span><span class="text-black-50"><?php echo $row2['email']?></span></div>
            </div>
            <div class="col-md-8">
                 <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                            <h6 ><a href="user_profile.php" style="text-decoration:none;">Back</a></h6>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><input type="text" class="form-control" name="first_name" value="<?php echo $row['firstname']?>" ></div>
                   <div class="col-md-6"><input type="text" class="form-control" name="last_name" value="<?php echo $row['lastname']?>" ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><p class="form-control" name="email" ><?php echo $row2['email']?></p></div>
                       <div class="col-md-6"><input type="text" class="form-control" name="contact" value="<?php echo $row['contact']?>" ></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><p class="form-control" name="gender" ><?php echo $row['gender']?></p></div>
                        <div class="col-md-6"><p class="form-control" name="age"><?php echo $row['Age']?></p></div>
                    </div>
                    <div class="row mt-3">

                       <div class="col-md-6"><input type="text" class="form-control" name="address" value="<?php echo $row['address']?>" ></div>
                   
</div>
             <div class="mt-5 text-right"><button type="submit" id="submit" name="submit" class="btn btn-primary profile-button" >Save changes</button></div>
                </div>
            </div>
        </div>
    </div>
</form>

 
 
        </div>
       
        <div class="row">
<div id="myModal" class="modal" >

  <div class="modal-content" id="div">

    <form action="#" method="POST" enctype="multipart/form-data">
<div>
   <input type="file" id="txt" name="image" required>
   <input type="submit" style="margin-left:50%;"name="upload" value="upload">
</div>
  </form>
  </div>

</div>

    </main>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
var bn = document.getElementById("bn");
bn.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>