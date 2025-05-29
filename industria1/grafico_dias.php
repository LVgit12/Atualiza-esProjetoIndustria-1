<?php
// Exemplo de estrutura esperada em modelos.json:
// [{"dataDia":"2024-06-01","QuantProd":10,"ModeloProd":"Modelo 1"}, ...]
$producaoPorDia = [];

if (file_exists("modelos.json")) {
    $dados = json_decode(file_get_contents("modelos.json"), true);
    foreach ($dados as $registro) {
        if (!empty($registro['dataDia']) && isset($registro['QuantProd'])) {
            $dia = $registro['dataDia'];
            $producaoPorDia[$dia] = ($producaoPorDia[$dia] ?? 0) + (int)$registro['QuantProd'];
        }
    }
}
ksort($producaoPorDia);
?>
<div id="grafico_dias" style="width:100%; min-width:320px; max-width:600px; height:250px; margin:auto; background:#fff; border-radius:8px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartDias);

  function drawChartDias() {
    var data = google.visualization.arrayToDataTable([
      ['Dia', 'Produzidas'],
      <?php
      foreach ($producaoPorDia as $dia => $qtd) {
          // Use o tipo Date para o eixo X
          $parts = explode('-', $dia); // yyyy-mm-dd
          if(count($parts) === 3) {
              // Mês em JS começa do zero
              $jsMonth = (int)$parts[1] - 1;
              echo "[new Date({$parts[0]}, $jsMonth, {$parts[2]}), $qtd],";
          }
      }
      ?>
    ]);

    var options = {
      title: 'Produção por Dia',
      legend: { position: 'none' },
      backgroundColor: '#fff',
      chartArea: {width: '80%', height: '70%', backgroundColor: { fill: '#fff' }},
      colors: ['#4f8cff'],
      width: '100%',
      height: 250,
      titleTextStyle: { color: '#23243a', fontSize: 18, bold: true },
      hAxis: { title: 'Dia', textStyle: {color: '#23243a'}, format: 'dd/MM/yyyy' },
      vAxis: { title: 'Produzidas', minValue: 0, textStyle: {color: '#23243a'} }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('grafico_dias'));
    chart.draw(data, options);
  }
</script>
