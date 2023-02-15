<?php
 
 include "db_connect.php";
 include "footer.php";
 include "sidebar.php";
 include "header.php";
 include "topbar.php";
?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>Parcel</title>
 <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
     
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['State','Number'],
 <?php 
      $query = "SELECT count(state) AS number, state FROM branches GROUP BY state";

       $exec = mysqli_query($conn,$query);
       while($row = mysqli_fetch_array($exec)){

       echo "['".$row['state']."',".$row['number']."],";
       }
       ?> 
 
 ]);

 var options = {
 title: 'Registered Branches',
  pieHole: 0,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }
  
    </script>

</head>
<body>

    <!--header area end-->
    
    <!--sidebar end-->

<!--<div class="content">-->

<style>
.dashboard {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.9);
  transition: 0.3s;
  width: 13%;
  margin: 20px;
  float: left;
  margin-left:75px;
  margin-top:90px;
  
  
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.card-header {
  background-color: #0000FF;
  padding: 20px;
  text-align: center;
  
}

.card-body {
  padding: 20px;
  
}
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0);
  transition: 0.3s;
  width: 13%;
  margin: 20px;
  float: left;
  margin-left:50px;
  margin-top:90px;
  
}

.card1:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.card1-header {
  background-color: yellow;
  padding: 20px;
  text-align: center;
  
}

.card1-body {
  padding: 20px;
}
.card2 {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0);
  transition: 0.3s;
  width: 13%;
  margin: 20px;
  float: left;
  margin-left:50px;
  margin-top:90px;
  
}

.card2:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.card2-header {
  background-color: green;
  padding: 20px;
  text-align: center;
  
}

.card2-body {
  padding: 20px;
}
.card3 {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0);
  transition: 0.3s;
  width: 13%;
  margin: 20px;
  float: left;
  margin-left:50px;
  margin-top:90px;
  
}

.card3:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.card3-header {
  background-color: orange;
  padding: 20px;
  text-align: center;
 
}

.card3-body {
  padding: 20px;
}
.card4 {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0);
  transition: 0.3s;
  width: 13%;
  margin: 20px;
  float: left;
  margin-left:50px;
  margin-top:90px;
  
}

.card4:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.8);
}

.card4-header {
  background-color: red;
  padding: 20px;
  text-align: center;
  
}

.card4-body {
  padding: 20px;
}
</style>
<br>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>

</body>
</html>