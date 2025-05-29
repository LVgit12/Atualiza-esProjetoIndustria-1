<?php
// Exemplo: dados.json = [{"ModeloProd":"Modelo A"}, {"ModeloProd":"Modelo B"}, ...]
$modelos = ["Modelo 1", "Modelo 2", "Modelo 3", "Modelo 4"];
$contagem = array_fill_keys($modelos, 0);

if (file_exists("modelos.json")) {
    $dados = json_decode(file_get_contents("modelos.json"), true);
    foreach ($dados as $registro) {
        if (!empty($registro['ModeloProd']) && isset($contagem[$registro['ModeloProd']])) {
            $contagem[$registro['ModeloProd']]++;
        }
    }
}
?>
<div id="grafico_modelo" style="width:100%; min-width:320px; max-width:550px; height:250px; margin:auto; background:#fff; border-radius:8px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartModelo);

  function drawChartModelo() {
    var data = google.visualization.arrayToDataTable([
      ['Modelo', 'Produzidos'],
      <?php
      foreach ($contagem as $modelo => $qtd) {
          echo "['$modelo', $qtd],";
      }
      ?>
    ]);

    var options = {
      title: 'Modelos Mais Produzidos',
      legend: { position: 'right', textStyle: {color: '#23243a', fontSize: 13}},
      backgroundColor: '#fff',
      chartArea: {width: '80%', height: '80%', backgroundColor: { fill: '#fff' }},
      colors: ['#ffeba7', '#ffd700', '#e74c3c', '#4f8cff'],
      width: '100%',
      height: 250,
      titleTextStyle: { color: '#23243a', fontSize: 18, bold: true }
    };

    var chart = new google.visualization.PieChart(document.getElementById('grafico_modelo'));
    chart.draw(data, options);
  }
</script>
