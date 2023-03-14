<?php 
include('db_connect.php');
$firstame=$_POST['name'];
$lastname= $_POST['surname'];
$email=$_POST['email'];
$message=$_POST['message'];
$sql2="INSERT INTO `feedback`(`id`, `first name`, `lastname`, `email`, `comment`) VALUES ('DEFAULT','$firstame','$lastname','$email','$message')";
$result=$conn->query($sql2);
if($result){
    header('Location:index.php');
}
else{
    die("Connection failed: " 
    . $$conn->connect_error);
}
?>