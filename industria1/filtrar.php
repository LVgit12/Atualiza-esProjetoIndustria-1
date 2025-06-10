<?php
    session_start();
    $_SESSION['filtro'] = true;
    $datas = json_decode(file_get_contents("data.json"), true);
    $QuantProd = json_decode(file_get_contents("Producao.json"), true);
    if (!is_array($QuantProd)) $QuantProd = [];
    $QuantRetrab = json_decode(file_get_contents("retrabalho.json"), true);
    if (!is_array($QuantRetrab)) $QuantRetrab = [];
    $QuantPerda = json_decode(file_get_contents("perdas.json"), true);
    if (!is_array($QuantPerda)) $QuantPerda = [];
    $QuantFuncionario = json_decode(file_get_contents("funcionarios.json"), true);
    if (!is_array($QuantFuncionario)) $QuantFuncionario = [];
    $modelos = json_decode(file_get_contents("ModeloProd.json"), true);
    if (!is_array($modelos)) $modelos = [];
    $Tempo1 = json_decode(file_get_contents("tempoProd.json"), true);
    if (!is_array($Tempo1)) $Tempo1 = [];


    // $arquivos = [
    //     "data.json" => $datas,
    //     "Producao.json" => $QuantProd,
    //     "retrabalho.json" => $QuantRetrab,
    //     "perdas.json" => $QuantPerda,
    //     "funcionarios.json" => $QuantFuncionario,
    //     "ModeloProd.json" => $modelos,
    //     "tempoProd.json" => $Tempo1
    //     ];
    // $produtos = $arquivos["Producao.json"];
    // $datas = $arquivos["data.json"];
    // $data_inicial = $_GET["data_inicial"] ?? '';
    // $data_final = $_GET["data_final"] ?? '';
    // $prodsFiltrados = [];
    // foreach($produtos as $produto){
    //     if (!isset($produto['data'])) continue;
    //     $data_produto = $produto['data'] // Skip if 'data' key is not set{
    //     }
    // } 
    
    $dataInicial = $_GET["data_inicial"] ?? ''; 
    $dataFinal = $_GET["data_final"] ?? ''  ;
    $hora = date('H:i:s');
    $datainicial = strtotime($dataInicial) + strtotime($hora);
    $datafinal = strtotime($dataFinal) + strtotime($hora);
    $i = 0;
    
    $ProdFiltro = json_decode(file_get_contents("ProdFiltro.json"), true);
    $RetrabFiltro = json_decode(file_get_contents("RetrabFiltro.json"), true);
    $PerdaFiltro = json_decode(file_get_contents("PerdaFiltro.json"), true);
    $FuncionarioFiltro = json_decode(file_get_contents("FuncionarioFiltro.json"), true);
    $ModeloFiltro = json_decode(file_get_contents("ModeloFiltro.json"), true);
    $TempoFiltro = json_decode(file_get_contents("TempoFiltro.json"), true);
    
    if (!is_array($ProdFiltro)) $ProdFiltro = [];
    if (!is_array($RetrabFiltro)) $RetrabFiltro = [];
    if (!is_array($PerdaFiltro)) $PerdaFiltro = [];
    if (!is_array($FuncionarioFiltro)) $FuncionarioFiltro = [];
    if (!is_array($ModeloFiltro)) $ModeloFiltro = [];
    if (!is_array($TempoFiltro)) $TempoFiltro = [];

    foreach($QuantProd as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $ProdFiltro[] = $item;
        }
    $i++;
    }
    
    $i = 0;
    foreach($QuantRetrab as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $RetrabFiltro[] = $item;
        }
    $i++;
    }
    
    $i = 0;
    foreach($QuantPerda as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $PerdaFiltro[] = $item;
        }
    $i++;
    }
    
    $i = 0;
    foreach($QuantFuncionario as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $FuncionarioFiltro[] = $item;
        }
    $i++;
    }
    
    $i = 0;
    foreach($modelos as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $ModeloFiltro[] = $item;
        }
    $i++;
    }
    
    $i = 0;
    foreach($Tempo1 as $item){
         $dataAtual = strtotime($datas[$i]) + strtotime($hora);
         if($dataAtual >= $datainicial && $dataAtual <= $datafinal){
            $TempoFiltro[] = $item;
        }
    $i++;
    }
    $producao = json_encode($ProdFiltro, JSON_PRETTY_PRINT);
    file_put_contents("ProdFiltro.json", $producao); 
    $retrabalho = json_encode($RetrabFiltro, JSON_PRETTY_PRINT);
    file_put_contents("RetrabFiltro.json", $retrabalho);
    $perdas = json_encode($PerdaFiltro, JSON_PRETTY_PRINT);
    file_put_contents("PerdaFiltro.json", $perdas);
    $funcionario = json_encode($FuncionarioFiltro, JSON_PRETTY_PRINT);
    file_put_contents("FuncionarioFiltro.json", $funcionario);
    $modelo = json_encode($ModeloFiltro, JSON_PRETTY_PRINT);
    file_put_contents("ModeloFiltro.json", $modelo);
    $tempo = json_encode($TempoFiltro, JSON_PRETTY_PRINT);
    file_put_contents("TempoFiltro.json", $tempo);
?>
