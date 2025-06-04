<?php
    session_start();
    $data[] = date('Y-m-d');
    $datas[] = json_decode(file_get_contents("data.json"), true);
    if (in_array($data, $datas)) {
        echo "Data já cadastrada!";
    } 
    else {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $var1 = $datas;
        $var2[]= array_search($data, $var1);
        array_diff($var1, $var2);
        $var1 = $data;
        $QuantProds = $_POST['QuantProd'];
        $QuantRetrabs = $_POST['QuantRetrab'];
        $QuantPerdass = $_POST['QuantPerdas'];
        $QuantFuncionarioss = $_POST['QuantFuncionarios'];
        $ModeloProds = $_POST['ModeloProd'];
        $data1 = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("data.json", $data1); 
        $producao = json_encode($QuantProds, JSON_PRETTY_PRINT);
        file_put_contents("Producao.json", $producao);
        $retrabalho = json_encode($QuantRetrabs, JSON_PRETTY_PRINT);
        file_put_contents("retrabalho.json", $retrabalho);
        $perda = json_encode($QuantPerdass, JSON_PRETTY_PRINT);
        file_put_contents("perdas.json", $perda);
        $funcionario = json_encode($QuantFuncionarioss, JSON_PRETTY_PRINT);
        file_put_contents("funcionarios.json", $funcionario);
        $QtdModeloProds = json_encode($ModeloProds, JSON_PRETTY_PRINT);
        file_put_contents("ModeloProd.json", $QtdModeloProds);
        header("Location: inicial.php");

    }
    }
?>

