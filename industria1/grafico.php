<?php
  $date = date("d/m/Y");
  $datas = json_decode(file_get_contents("data.json"), true);
  $index = array_search($date, $datas);

  // Verifica se há dados filtrados
  $prodfiltro = json_decode(file_get_contents("ProdFiltro.json"), true);
  if (!is_array($prodfiltro)) $prodfiltro = [];
  $perdaFiltro = json_decode(file_get_contents("PerdaFiltro.json"), true);  
  if (!is_array($perdaFiltro)) $perdaFiltro = [];
  $retrabalhoFiltro = json_decode(file_get_contents("RetrabFiltro.json"), true);
  if (!is_array($retrabalhoFiltro)) $retrabalhoFiltro = [];

  if (count($prodfiltro) > 0 || count($perdaFiltro) > 0 || count($retrabalhoFiltro) > 0) {
    // Mostra dados filtrados
    $prodValue = array_sum($prodfiltro);
    $retrabalhoValue = array_sum($retrabalhoFiltro);
    $perdaValue = array_sum($perdaFiltro);
  } else {
    // Mostra dados do dia atual
    $prod = json_decode(file_get_contents("Producao.json"), true);
    $perda = json_decode(file_get_contents("perdas.json"), true);
    $retrabalho = json_decode(file_get_contents("retrabalho.json"), true);
    $prodValue = isset($prod[$index]) ? (float)$prod[$index] : 0;
    $retrabalhoValue = isset($retrabalho[$index]) ? (float)$retrabalho[$index] : 0;
    $perdaValue = isset($perda[$index]) ? (float)$perda[$index] : 0;
  }

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
      <div id="1" style="width: 500px; height: 300px;"></div>
    </body>
  </html>
<?php 
  }
?>

