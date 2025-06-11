<?php

  $date = date("d/m/Y");
  $datas = json_decode(file_get_contents("data.json"), true);
  $index = array_search($date, $datas);
  $DataFiltro = json_decode(file_get_contents("DataFiltro.json"), true);
  $TaxaProd = json_decode(file_get_contents("TxProd.json"), true);
  $TaxaPerda = json_decode(file_get_contents("Txrefugo.json"), true);
  $Producao = json_decode(file_get_contents("Producao.json"), true);
  $Perda = json_decode(file_get_contents("perdas.json"), true);
  if (!is_array($DataFiltro)) $DataFiltro = [];
  if($_SESSION['filtro'] == true){
    $totalproduzido = 0;
    $totalperdido = 0;
    $quantia = count($DataFiltro);  
    foreach($DataFiltro as $item){
      $indice = array_search($item, $datas);
      $totalproduzido += $Producao[$indice];
      $totalperdido += $Perda[$indice];
    }
    $taxaproducao = ($totalproduzido / ($quantia * 200)) * 100;
    $taxaperda = ($totalperdido / $totalproduzido) * 100;
    ?>
      <html>
        <head>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['TAXA DE PRODUÇÃO', 'TAXA DE REFUGO'],
                ['Taxa de produção:', <?PHP echo $taxaproducao ?>],
                ['Taxa de refugo:', <?php echo $taxaperda ?>]
              ]);

              var options = {
                chart: {
                  
                }
              };

              var chart = new google.charts.Bar(document.getElementById('grafico7'));
              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script>
        </head>
        <body>
          <div id="grafico7" style="width: 550px; height: 300px;"></div>
        </body>
      </html>
      

    <?php
  }
  else{?>
      <html>
            <head>
              <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
              <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawStuff);

                function drawStuff() {
                  var data = new google.visualization.arrayToDataTable([
                    ['TAXA DE PRODUÇÃO', 'TAXA DE REFUGO'],
                    ['Taxa de produção:', <?PHP echo $TaxaProd[$index] ?>],
                    ['Taxa de refugo:', <?php echo $TaxaPerda[$index] ?>]
                  ]);

                  var options = {
                    chart: {
                      
                    };
                  }
                  var chart = new google.charts.Bar(document.getElementById('grafico7'));
                  chart.draw(data, google.charts.Bar.convertOptions(options));
                };
              </script>
            </head>
            <body>
              <div id="grafico7" style="width: 550px; height: 300px;"></div>
            </body>
    </html>
<?php
    }
    ?>
      