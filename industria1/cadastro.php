<?php
    session_start();
    $data[] = date('Y-m-d');
    $datas[] = json_decode(file_get_contents("data.json"), true);
    if (in_array($data, $datas)) {
        echo "Data já cadastrada!";
    } 
    else {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $var1[] = $datas;
        $var2 = array_search($data, $var1);
        if($var1[0] == "0") {
            unset($var1[$var2]);
            array_push($var1, $data);
        }
        else{
            array_push($var1, $data);
        }
        $var1 = $data;
        $QuantProds = $_POST['QuantProd'];
        $time = $_POST['time'];
        $QuantRetrabs = $_POST['QuantRetrab'];
        $QuantPerdass = $_POST['QuantPerdas'];
        $QuantFuncionarioss = $_POST['QuantFuncionarios'];
        $ModeloProds = $_POST['ModeloProd'];

        // Corrigir leitura e atualização dos arrays dos arquivos JSON
        $QuantProd = json_decode(file_get_contents("Producao.json"), true);
        if (!is_array($QuantProd)) $QuantProd = [];
        $QuantProd[] = $QuantProds;

        $QuantRetrab = json_decode(file_get_contents("retrabalho.json"), true);
        if (!is_array($QuantRetrab)) $QuantRetrab = [];
        $QuantRetrab[] = $QuantRetrabs;

        $QuantPerda = json_decode(file_get_contents("perdas.json"), true);
        if (!is_array($QuantPerda)) $QuantPerda = [];
        $QuantPerda[] = $QuantPerdass;

        $QuantFuncionario = json_decode(file_get_contents("funcionarios.json"), true);
        if (!is_array($QuantFuncionario)) $QuantFuncionario = [];
        $QuantFuncionario[] = $QuantFuncionarioss;

        $modelos = json_decode(file_get_contents("ModeloProd.json"), true);
        if (!is_array($modelos)) $modelos = [];
        $modelos[] = $ModeloProds;

        $Tempo1 = json_decode(file_get_contents("tempoProd.json"), true);
        if (!is_array($Tempo1)) $Tempo1 = [];
        $Tempo1[] = $time;

        
        $data1 = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("data.json", $data1);
        $time1 = json_encode($Tempo1, JSON_PRETTY_PRINT);
        file_put_contents("tempoProd.json", $time1); 
        $producao = json_encode($QuantProd, JSON_PRETTY_PRINT);
        file_put_contents("Producao.json", $producao);
        $retrabalho = json_encode($QuantRetrab, JSON_PRETTY_PRINT);
        file_put_contents("retrabalho.json", $retrabalho);
        $perda = json_encode($QuantPerda, JSON_PRETTY_PRINT);
        file_put_contents("perdas.json", $perda);
        $funcionario = json_encode($QuantFuncionario, JSON_PRETTY_PRINT);
        file_put_contents("funcionarios.json", $funcionario);
        $QtdModeloProds = json_encode($modelos, JSON_PRETTY_PRINT);
        file_put_contents("ModeloProd.json", $QtdModeloProds);
        $_SESSION['producao'] = json_decode(file_get_contents("tempoProd.json", true));
        header("Location: inicial.php");
    }
    }
?>

