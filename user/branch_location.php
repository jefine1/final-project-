<?php
include '../db_connect.php';

?>
<?php 
	if(!isset($_SESSION['login_id']))
	    header('location:login.php');
 
    ob_start();
 

	include 'header.php' 
?>
  <?php include 'topbar.php' ?>
  <?php include 'sidebar.php' ?>
  <html>
<head>
<style>

html {
  background: #2F3238;
}

.feedback-button {
  height: 40px;
  border: solid 3px #CCCCCC;
  background: #333;
  width: 100px;
  line-height: 32px;
  -webkit-transform: rotate(-90deg);
  font-weight: 600;
  color: white;
  transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  text-align: center;
  font-size: 17px;
  position: fixed;
  right: -40px;
  top: 45%;
  font-family: "Roboto", helvetica, arial, sans-serif;
  z-index: 999;
}

#feedback-main {
  display: none;
  float: left;
  padding-top: 0px;
}

#feedback-div {
  background-color: rgba(72, 72, 72, 0.4);
  padding-left: 35px;
  padding-right: 35px;
  padding-top: 35px;
  padding-bottom: 50px;
  width: 450px;
  float: left;
  left: 50%;
  position: absolute;
  margin-top: 30px;
  margin-left: -260px;
  -moz-border-radius: 7px;
  -webkit-border-radius: 7px;
}

.feedback-input {
  color: #3c3c3c;
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-weight: 500;
  font-size: 18px;
  border-radius: 0;
  line-height: 22px;
  background-color: #fbfbfb;
  padding: 13px 13px 13px 54px;
  margin-bottom: 10px;
  width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
  border: 3px solid rgba(0, 0, 0, 0);
}

.feedback-input:focus {
  background: #fff;
  box-shadow: 0;
  border: 3px solid #3498db;
  color: #3498db;
  outline: none;
  padding: 13px 13px 13px 54px;
}


/* Icons ---------------------------------- */

#feedback-name {
  background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
  background-size: 30px 30px;
  background-position: 11px 8px;
  background-repeat: no-repeat;
}

#feedback-name:focus {
  background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
  background-size: 30px 30px;
  background-position: 8px 5px;
  background-position: 11px 8px;
  background-repeat: no-repeat;
}

#feedback-email {
  background-image: url(http://rexkirby.com/kirbyandson/images/email.svg);
  background-size: 30px 30px;
  background-position: 11px 8px;
  background-repeat: no-repeat;
}

#feedback-email:focus {
  background-image: url(http://rexkirby.com/kirbyandson/images/email.svg);
  background-size: 30px 30px;
  background-position: 11px 8px;
  background-repeat: no-repeat;
}

#feedback-comment {
  background-image: url(http://rexkirby.com/kirbyandson/images/comment.svg);
  background-size: 30px 30px;
  background-position: 11px 8px;
  background-repeat: no-repeat;
}

#feedback-comment {
  width: 100%;
  height: 150px;
  line-height: 150%;
  resize: vertical;
}

input:hover,
#feedback-comment:hover,
input:focus,
#feedback-comment:focus {
  background-color: white;
}

#feedback-button-blue {
  font-family: "Roboto", helvetica, arial, sans-serif;
  float: left;
  width: 100%;
  border: #fbfbfb solid 4px;
  cursor: pointer;
  background-color: #3498db;
  color: white;
  font-size: 24px;
  padding-top: 22px;
  padding-bottom: 22px;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
  margin-top: -4px;
  font-weight: 700;
}

#feedback-button-blue:hover {
  background-color: rgba(0, 0, 0, 0);
  color: #0493bd;
}

.feedback-button-blue:hover {
  color: #3498db;
}

.feedback-ease {
  width: 0px;
  height: 74px;
  background-color: #fbfbfb;
  -webkit-transition: .3s ease;
  -moz-transition: .3s ease;
  -o-transition: .3s ease;
  -ms-transition: .3s ease;
  transition: .3s ease;
}

.feedback-submit:hover .feedback-ease {
  width: 100%;
  background-color: white;
}

@media only screen and (max-width: 580px) {
  #feedback-div {
    left: 3%;
    margin-right: 3%;
    width: 88%;
    margin-left: 0;
    padding-left: 3%;
    padding-right: 3%;
  }
}
</style>
<body>
  <br><br><script>
        function toggle_visibility() {
       var e = document.getElementById('feedback-main');
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>
<div id="feedback-main">
  <div id="feedback-div">
    <form action="contact.php" method="post" class="form" id="feedback-form1" name="form1" enctype="multipart/form-data">

      <p class="name">
        <input name="name" type="name" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" required placeholder="Name" id="feedback-name" />
      </p>

      <p class="email">
        <input name="email" type="email" class="validate[required,custom[email]] feedback-input" id="feedback-email" placeholder="Email" required />
      </p>

      <p class="text">
        <textarea name="comment" type="comment" class="validate[required,length[6,300]] feedback-input" id="feedback-comment" required placeholder="Hey, I really love the site but I believe that you could incorporate some ..... and also get rid of the ...... on the section."></textarea>
      </p>

      <div class="feedback-submit">
        <input type="submit" value="SEND" id="feedback-button-blue" />
        <div class="feedback-ease"></div>
      </div>
    </form>
  </div>
</div>

<button id="popup" class="feedback-button" onclick="toggle_visibility()">Feedback</button>
<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<?php if($_SESSION['login_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM branches")->num_rows; ?></h3>

                <p>Total Branches</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels")->num_rows; ?></h3>

                <p>Total Parcels</p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?></h3>

                <p>Total Staff</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
            </div>
          </div>
          <hr>
          <?php 
              $status_arr = array("Item Accepted by Courier","Collected","Shipped","In-Transit","Arrived At Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","Unsuccessfull Delivery Attempt");
               foreach($status_arr as $k =>$v):
          ?>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $conn->query("SELECT * FROM parcels where status = {$k} ")->num_rows; ?></h3>

                <p><?php echo $v ?></p>
              </div>
              <div class="icon">
                <i class="fa fa-boxes"></i>
              </div>
            </div>
          </div>
            <?php endforeach; ?>
      </div>

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		These are branch Locations
          	</div>
          </div>
      </div>
     
              Kozhikode: <br>Palayam, oppo. old bus stand , Kozhikode
          	</div>
            <iframe src="https://satellites.pro/India_map#11.249876,75.786726,16" width="50%" height="500px"></iframe><br><br>
                Kannur:<br>Thotta, Thalasherry road- SH 38 ,Kannur<br>
                <iframe src="https://satellites.pro/India_map#11.840416,75.420921,19" width="50%" height="500px"></iframe><br><br>
<?php endif; ?>
<script src="_include/js/feedback.js"></script>
</head>
</body>
</html>

<?php include 'footer.php' ?>