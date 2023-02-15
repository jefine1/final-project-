<?php
include '../db_connect.php';
session_start();
?>
<?php 
	if(!isset($_SESSION['login_id']))
	    header('location:login.php');
 
    ob_start();
 

	include 'header.php' 
?>
  <?php include 'topbar.php' ?>
  <?php include 'sidebar.php' ?>
<div class="col-12">
<div class="card">
    <div class="card-body">
        Welcome <?php echo $_SESSION['name'] ?>!
    </div>
</div>
</div>
<?php include 'footer.php' ?>