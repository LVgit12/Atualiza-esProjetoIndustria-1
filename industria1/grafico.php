<?php
  $date = date("d/m/Y");
  $datas = json_decode(file_get_contents("data.json"), true);
  $prod = json_decode(file_get_contents("Producao.json"), true);
  $perda =  json_decode(file_get_contents("perdas.json"), true);
  $retrabalho = json_decode(file_get_contents("retrabalho.json"), true); 
  $index = array_search($date, $datas);

  $dia = isset($datas[$index]) ? $datas[$index] : '';
  $fabricados = isset($prod[$index]) ? (float)$prod[$index] : 0;
  $retrabs = isset($retrabalho[$index]) ? (float)$retrabalho[$index] : 0;
  $perdas = isset($perda[$index]) ? (float)$perda[$index] : 0;

  if (empty($datas)) {
      echo "Ainda não há dados cadastrados!";
  } else {?>
  <html>
    <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Fabricados', 'Retrabalho'],
            ['Fabricados',     <?php echo $fabricados; ?>],
            ['Retrabalho',     <?php echo $retrabs; ?>, ],
            ['Perdas',  <?php echo $perdas; ?>]]
          );

          var options = {
            title: '',
            pieHole: 0.35,
          };

          var chart = new google.visualization.PieChart(document.getElementById('1'));
          chart.draw(data, options);
        }
      </script>
    </head>
    <body>
      <div id="1" style="width: 400px; height: 300px;"></div>
    </body>
  </html>

    
<?php 
  }
?>

