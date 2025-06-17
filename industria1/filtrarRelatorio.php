<?php
session_start();

$dataInicial = $_GET["data_inicialRelatorio"] ?? '';
$dataFinal = $_GET["data_finalRelatorio"] ?? '';

function dataBRtoISO($data) {
    $data = str_replace(['/', '.'], '-', $data);
    $partes = preg_split('/[-]/', $data);
    if(count($partes) === 3) {
        // Detecta se está no formato dd-mm-yyyy ou yyyy-mm-dd
        if(strlen($partes[2]) === 4) {
            // dd-mm-yyyy para yyyy-mm-dd
            return $partes[2].'-'.$partes[1].'-'.$partes[0];
        } else {
            // yyyy-mm-dd já está correto
            return $data;
        }
    }
    return $data;
}

$datas = json_decode(file_get_contents("data.json"), true);
$QuantProd = json_decode(file_get_contents("Producao.json"), true);
$QuantRetrab = json_decode(file_get_contents("retrabalho.json"), true);
$QuantPerda = json_decode(file_get_contents("perdas.json"), true);
$QuantFuncionario = json_decode(file_get_contents("funcionarios.json"), true);
$modelos = json_decode(file_get_contents("ModeloProd.json"), true);
$Tempo1 = json_decode(file_get_contents("tempoProd.json"), true);

$DataFiltro = [];
$ProdFiltro = [];
$RetrabFiltro = [];
$PerdaFiltro = [];
$FuncionarioFiltro = [];
$ModeloFiltro = [];
$TempoFiltro = [];

for ($i = 0; $i < count($datas); $i++) {
    $dataISO = dataBRtoISO($datas[$i]);
    $dataInicialISO = $dataInicial ? dataBRtoISO($dataInicial) : '';
    $dataFinalISO = $dataFinal ? dataBRtoISO($dataFinal) : '';
    if ($dataInicialISO && $dataISO < $dataInicialISO) continue;
    if ($dataFinalISO && $dataISO > $dataFinalISO) continue;
    $DataFiltro[] = $datas[$i];
    $ProdFiltro[] = $QuantProd[$i];
    $RetrabFiltro[] = $QuantRetrab[$i];
    $PerdaFiltro[] = $QuantPerda[$i];
    $FuncionarioFiltro[] = $QuantFuncionario[$i];
    $ModeloFiltro[] = $modelos[$i];
    $TempoFiltro[] = $Tempo1[$i];
}

file_put_contents("DataFiltro.json", json_encode($DataFiltro, JSON_PRETTY_PRINT));
file_put_contents("ProdFiltro.json", json_encode($ProdFiltro, JSON_PRETTY_PRINT));
file_put_contents("RetrabFiltro.json", json_encode($RetrabFiltro, JSON_PRETTY_PRINT));
file_put_contents("PerdaFiltro.json", json_encode($PerdaFiltro, JSON_PRETTY_PRINT));
file_put_contents("FuncionarioFiltro.json", json_encode($FuncionarioFiltro, JSON_PRETTY_PRINT));
file_put_contents("ModeloFiltro.json", json_encode($ModeloFiltro, JSON_PRETTY_PRINT));
file_put_contents("TempoFiltro.json", json_encode($TempoFiltro, JSON_PRETTY_PRINT));

$_SESSION['filtrorelatorio'] = true;
header("Location:desempenho.php");
exit;
