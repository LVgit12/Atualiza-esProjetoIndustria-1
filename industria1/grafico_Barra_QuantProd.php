<?php
    $date = date("d/m/Y");
    $verificador = isset($_SESSION['filtrograficos']) ? $_SESSION['filtrograficos'] : false;
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
?>
<div id="10" style="width: 400px; height: 300px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['bar']});
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
        axes: {
            x: {
                0: { side: 'top'} // Top x-axis.
            }
        },
        bar: { groupWidth: "90%" }
    };

    var chart = new google.charts.Bar(document.getElementById('10'));
    chart.draw(data, options);
}
</script>