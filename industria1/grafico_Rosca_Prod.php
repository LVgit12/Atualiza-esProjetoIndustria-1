<?php
  $date = date("d/m/Y");
  $datas = json_decode(file_get_contents("data.json"), true);
  $verificador = $_SESSION['filtrograficos'];
  $data = end($datas);
  $index = array_search($data, $datas);

  // Verifica se há dados filtrados
  $prodfiltro = json_decode(file_get_contents("ProdFiltro.json"), true);
  if (!is_array($prodfiltro)) $prodfiltro = [];
  $perdaFiltro = json_decode(file_get_contents("PerdaFiltro.json"), true);  
  if (!is_array($perdaFiltro)) $perdaFiltro = [];
  $retrabalhoFiltro = json_decode(file_get_contents("RetrabFiltro.json"), true);
  if (!is_array($retrabalhoFiltro)) $retrabalhoFiltro = [];

    $prod = json_decode(file_get_contents("Producao.json"), true);
    $perda = json_decode(file_get_contents("perdas.json"), true);
    $retrabalho = json_decode(file_get_contents("retrabalho.json"), true);  
  // Mostra dados filtrados
    $prod1 = array_sum($prodfiltro);
    $retrabalho1 = array_sum($retrabalhoFiltro);
    $perda1 = array_sum($perdaFiltro);
    // Mostra dados do dia atual 

    $prodValue = array_sum($prod);
    $retrabalhoValue = array_sum($retrabalho);
    $perdaValue = array_sum($perda);

    $prodfiltro = isset($prodfiltro[$index]) ? $prodfiltro[$index] : 0;
    $retrabalhofiltro = isset($retrabalhoFiltro[$index]) ? $retrabalhoFiltro[$index] : 0;
    $perdafiltro = isset($perdaFiltro[$index]) ? $perdaFiltro[$index] : 0;
    

  if ($verificador == true) { ?>
      <html>
    <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Tipo', 'Quantidade'],
            ['Fabricados',     <?php echo $prod1; ?>],
            ['Retrabalho',     <?php echo $retrabalho1; ?>],
            ['Perdas',  <?php echo $perda1; ?>]
          ]);

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
  <?php } else {?>
  <html>
    <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Tipo', 'Quantidade'],
            ['Fabricados',     <?php echo $prodValue; ?>],
            ['Retrabalho',     <?php echo $retrabalhoValue; ?>],
            ['Perdas',  <?php echo $perdaValue; ?>]
          ]);

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

