<?php
    $date = date("d/m/Y");
    $datas = json_decode(file_get_contents("data.json"), true);
    $verificador = $_SESSION['filtrograficos'];
    $index = array_search($date, $datas);
    $DataFiltro = json_decode(file_get_contents("DataFiltro.json"), true);
    $TaxaProd = json_decode(file_get_contents("TxProd.json"), true);
    $TaxaPerda = json_decode(file_get_contents("Txrefugo.json"), true);
    $i = 0;
    
    if (!is_array($DataFiltro)) $DataFiltro = [];
    if ($verificador == true) {
        ?>
        <head>  
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <div id="chart_div"></div>
          <script>
              google.charts.load('current', { packages: ['corechart', 'line'] });
              google.charts.setOnLoadCallback(drawLogScales);

              function drawLogScales() {
                  var data = new google.visualization.DataTable();
                  data.addColumn('number', 'X');
                  data.addColumn('number', 'Taxa de Produção');
                  <?php foreach($DataFiltro as $item){ ?>
                      <?php $indice = array_search($item, $datas); ?>
                      data.addRow([<?php echo $indice + 1;?>, <?php echo $TaxaProd[$indice]; ?>]);
                      <?php $i++; ?>
                  <?php } ?>

                  var options = {
                      hAxis: {
                          title: 'Time',
                          logScale: true
                      },
                      vAxis: {
                          title: 'Popularity',
                          logScale: false
                      },
                      colors: ['#a52714', '#097138']
                  };

                  var chart = new google.visualization.LineChart(document.getElementById('8'));
                  chart.draw(data, options);
                }
              </script>
        </head>
        <?php }else{
        ?>
          <head>  
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <div id="chart_div"></div>
          <script>
              google.charts.load('current', { packages: ['corechart', 'line'] });
              google.charts.setOnLoadCallback(drawLogScales);
              function drawLogScales() {
                  var data = new google.visualization.DataTable();
                  data.addColumn('number', 'X');
                  data.addColumn('number', 'Taxa de Produção');
                  <?php $i = 0; ?>
                  <?php foreach($datas as $item){ ?>

                      data.addRow([<?php echo $i + 1;?>, <?php echo $TaxaProd[$i]; ?>]);
                      <?php $i++; ?>
                  <?php } ?>

                  var options = {
                      hAxis: {
                          title: 'Time',
                          logScale: true
                      },
                      vAxis: {
                          title: 'Taxa de Produção',
                          logScale: false
                      },
                      colors: ['#a52714', '#097138']
                  };

                  var chart = new google.visualization.LineChart(document.getElementById('8'));
                  chart.draw(data, options);
                }
              </script>
        </head>
      <?php }?>
      <body>
            <div id="8" style="width: 400px; height: 300px;"></div>
        </body>