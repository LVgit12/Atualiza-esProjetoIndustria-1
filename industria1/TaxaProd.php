<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $produzido = $_POST['QuantProd'];
        $tempoproducao = $_POST['time'];
        $MetaDiaria = 200; // Defina a meta diária de produção 
        $Taxaproducao = ($produzido / $MetaDiaria) * 100; // Cálculo da taxa de produção
        $recebeprod = json_decode(file_get_contents("Producao.json"), true);
        if (!is_array($recebeprod)) {
            $recebeprod = [];
        }
        $prod1 = json_encode($recebeprod, JSON_PRETTY_PRINT);
        file_put_contents("TxProd.json", $prod1);
    }
?>