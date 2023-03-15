<?php
 
 include "db_connect.php";

?>
<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>Parcel</title>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
     
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

 
 
						</td>
					</tr>	
			
				</tbody>
			</table>
      <script>
window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'summary.pdf',
                image: { type: 'jpeg', quality: 0.99 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a3', orientation: 'p' }
            };
            html2pdf().from(invoice).set(opt).save();
        })
}
</script><div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download"> download pdf</button>
            </div><div id="invoice"> 
     <b><h5 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Feedback Analysis</h5></b>
      <?php
 $sq = "SELECT comment FROM feedback";
$resul = $conn->query($sq);
if ($resul->num_rows > 0) {
  $texts = array();
  while ($row = $resul->fetch_assoc()) {
      $texts[] = $row["comment"];
  }
  $url = 'http://127.0.0.1:5000/sentiment';
  $data = json_encode(array('texts' => $texts));
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/json\r\n",
          'method'  => 'POST',
          'content' => $data,
      ),
  );
  $context  = stream_context_create($options);
  $resul = file_get_contents($url, false, $context);
  $resul = json_decode($resul, true);

  $positive = $resul['positive'];
  $negative = $resul['negative'];
  $neutral = $resul['neutral'];
  $total = $positive + $negative + $neutral;

  $pos_percent = ($positive / $total) * 100;
  $neg_percent = ($negative / $total) * 100;
  $neu_percent = ($neutral / $total) * 100;
  $pos_accuracy = ($pos_percent >( $neu_percent+$neg_percent)) ? $pos_percent : (100 -( $neu_percent+$neg_percent));
    $neg_accuracy = ($neg_percent > ($neu_percent+$pos_percent)) ? $neg_percent : (100 - ($neu_percent+$pos_percent));
  $neutral_accuracy = ($neu_percent > ($pos_percent + $neg_percent)) ? $neu_percent : (100 - ($pos_percent + $neg_percent));

 } else {
  echo "No comments.";
  $pos_percent = 0;
  $neg_percent = 0;
  $neu_percent=0;
  $neu_percent = 0;
  $pos_accuracy = 0;
  $neg_accuracy = 0;
  $neu_accuracy = 0;
  $neutral_accuracy=0;
}
?>
<div class="container-fluid">        
    <!-- <h1>Sentiment Analysis </h1> -->
    <div class="chart-container" style="margin-left:10%; width: 50%;
  height: 50%;">
        <canvas id="sentiment-chart"></canvas>
    </div>
    <div>
    <p>Total feedbacks: <?php echo $total; ?></p>
    <p>Positive: <?php echo $pos_accuracy/10; ?></p>
    <p>Negative: <?php echo $neg_accuracy/10; ?></p>
    <p>Neutral: <?php echo $neutral_accuracy/10; ?></p>
</div>



</div>

<script>
        var ctx = document.getElementById('sentiment-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Positive', 'Negative', 'Neutral'],
                datasets: [{
                    label: '.',
                    data: [<?php echo $pos_percent; ?>, <?php echo $neg_percent; ?>, <?php echo $neu_percent; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1,
                  
                }]
            },
            
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            max: 100
                        }
                    }
                }
            }
        });
    </script>
    <div class="cont"> 
<table class="table">

    <div class="col-lg-12">
	<div class="card  card-primary">
		
			
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<!-- <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
						<th class="text-center">#</th>
						
						<th>Name</th>
						<th>Email</th>
						<th>Comment</th>
					
					</tr>
				</thead>
				<tbody>

    

        <?php
      
        $cnt=1;
        $sq = "SELECT * from feedback  ";
        
        $result = $conn->query($sq);
        
         foreach($result as $rows) { 

        ?>

                    <tr>

                    <td><?php echo $cnt++; ?></td>

                    

                   

                    

                    <td><?php echo $rows['firstname']; ?></td>
                    <td><?php echo $rows['email']; ?></td>
                    <td><?php echo $rows['comment']; ?></td>
                    </tr>   
                                        

        <?php       }
         
            

        ?>                

    

</table>
    </div>
    </div>
</div></div>
</div>
</body>
</html>