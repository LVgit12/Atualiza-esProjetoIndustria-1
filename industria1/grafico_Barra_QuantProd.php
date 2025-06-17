<?php
    $date = date("d/m/Y");
    $verificador = $_SESSION['filtrograficos'];
    $datas = json_decode(file_get_contents("data.json"), true);
    $index = array_search($date, $datas);
    $DataFiltro = json_decode(file_get_contents("DataFiltro.json"), true);
    $ProdFiltro = json_decode(file_get_contents("ProdFiltro.json"), true);
    $Producao = json_decode(file_get_contents("Producao.json"), true);
    $i = 0;
    if (!is_array($DataFiltro)) $DataFiltro = [];
    if (!is_array($datas)) $datas = [];
    if (!is_array($ProdFiltro)) $ProdFiltro = [];
    if (!is_array($Producao)) $Producao = [];
    // Filtrar últimos 7 dias
    function ultimos7($array) {
        return array_slice($array, -7);
    }
    if ($verificador) {
        $DataFiltro = ultimos7($DataFiltro);
        $ProdFiltro = ultimos7($ProdFiltro);
    } else {
        $datas = ultimos7($datas);
        $Producao = ultimos7($Producao);
    }
?>
<html>
    
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data = new google.visualization.arrayToDataTable([
                ['Data', 'Produção'],
                <?php
                if ($verificador) {
                    for ($i = 0; $i < count($DataFiltro); $i++) {
                        $data = isset($DataFiltro[$i]) ? $DataFiltro[$i] : '';
                        $prod = isset($ProdFiltro[$i]) ? $ProdFiltro[$i] : 0;
                        echo "['$data', $prod],\n";
                    }
                } else {
                    for ($i = 0; $i < count($datas); $i++) {
                        $data = isset($datas[$i]) ? $datas[$i] : '';
                        $prod = isset($Producao[$i]) ? $Producao[$i] : 0;
                        echo "['$data', $prod],\n";
                    }
                }
                ?>
            ]);

            var options = {
                width: 1800,
                legend: { position: 'none' },
                bar: { groupWidth: "90%" },
                chartArea: {width: '80%', height: '70%'},
                hAxis: { title: ' ' },
                vAxis: { title: 'Produção' }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        </script>
    </head>
        <body>
            <div id="chart_div" style="width: 400px; height: 300px;"></div>
        </body>
</html>

