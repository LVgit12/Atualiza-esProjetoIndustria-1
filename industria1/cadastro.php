<?php
    session_start();
    $data = date('Y-d-m');
    $datas = json_decode(file_get_contents("data.json"), true);
    if (!is_array($datas)) $datas = [];
    if (in_array($data, $datas)) {
        echo "Data já cadastrada!";
        exit;
    } 
    else {
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Adiciona a nova data ao array e salva
            $datas[] = $data;
            file_put_contents("data.json", json_encode($datas, JSON_PRETTY_PRINT));
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
            
            $MetaDiaria = 200; // Defina a meta diária de produção 
            $Taxaproducao = ($QuantProds / $MetaDiaria) * 100; // Cálculo da taxa de produção
            // Lê o array existente ou cria um novo se estiver vazio
            $recebetx = json_decode(file_get_contents("TxProd.json"), true);
            if (!is_array($recebetx)) $recebetx = [];
            $recebetx[] = $Taxaproducao;
            // Salva o array atualizado
            file_put_contents("TxProd.json", json_encode($recebetx, JSON_PRETTY_PRINT));

            $Taxarefugo = ($QuantPerdass / $QuantProds) * 100;
            $recebeRefugo = json_decode(file_get_contents("Txrefugo.json"), true);
            if (!is_array($recebeRefugo)) $recebeRefugo = [];
            $recebeRefugo[] = $Taxarefugo;
            // Salva o array atualizado
            file_put_contents("Txrefugo.json", json_encode($recebeRefugo, JSON_PRETTY_PRINT));

            header("Location: inicial.php");
            exit;
        }
    }
?>

