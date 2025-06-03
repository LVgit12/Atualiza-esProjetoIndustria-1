<?php
    session_start();
    $data = date('0000-00-00');
    $datas = date('Y-m-d');
    $datas1 = json_encode($datas, JSON_PRETTY_PRINT);
    file_put_contents("data.json", $datas1);
    if (array_search($datas, $_SESSION['datas'])) {
        echo "Data já cadastrada!";
    } else {
       echo "Data cadastrada com sucesso!";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $QuantProds = $_POST['QuantProd'];
        $QuantRetrabs = $_POST['QuantRetrab'];
        $QuantPerdass = $_POST['QuantPerdas'];
        $QuantFuncionarioss = $_POST['QuantFuncionarios'];
        $ModeloProds = $_POST['ModeloProd'];
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


        



        exit();
    }

?>

