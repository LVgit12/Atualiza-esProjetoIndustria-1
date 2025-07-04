<?php 
    // @see https://desenvolvimentoparaweb.com/css/css-breakpoints-maneira-correta/

    session_start();
    $verificador = isset($_SESSION['filtro']) ? $_SESSION['filtro'] : null;
    $verificadorgraficos = isset($_SESSION['filtrograficos']) ? $_SESSION['filtrograficos'] : null;
    $datas = json_decode(file_get_contents("data.json"), true);
    $date = date("d-m-Y");
    $DataFiltro = json_decode(file_get_contents("DataFiltro.json"), true);
    if(in_array($date, $datas)){
        $index = array_search($date, $datas);
    }
    else{
        $index = "vazio";
    }
    $_SESSION['index'] = $index;
    if(count($datas) == 0) {
        $data ="0";
        $data0 = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("data.json", $data0);
    }
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    if(!isset($_SESSION['nomes'])){
        $emails[] = json_decode(file_get_contents("email.json"), true);
        $senhas[] = json_decode(file_get_contents("senha.json"), true);
        $nomes[] = json_decode(file_get_contents("nome.json"), true);
        $QuantProd[] = json_decode(file_get_contents("Producao.json"), true);
        $QuantRetrabs[] = json_decode(file_get_contents("retrabalho.json"), true);
        $QuantPerdass[] = json_decode(file_get_contents("perdas.json"), true);
        $QuantFuncionarioss[] = json_decode(file_get_contents("funcionarios.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);

        $_SESSION['nomes'] =     $nomes;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['emails'] = $emails;

    }
    else{
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
    }

    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : null;
    $filtrograficos = isset($_GET['filtrograficos']) ? $_GET['filtrograficos'] : (isset($_POST['filtrograficos']) ? $_POST['filtrograficos'] : null);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale-1">
        <meta http-equiv="content-language" content="pt-br">
        <title>Sapataria</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <style>
        body { /* fundo e corpo da pagina */
            background: #2a2b38;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .user-info a {
            color: #4f8cff;
            margin-left: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.3rem;
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .user-info a:hover {
            background: #4f8cff22;
            text-decoration: none;
        }
        .menu-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background: #28294d;
            padding: 0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
            margin: 24px 10 1px 0;
            width: 100%;
            gap: 0;
            overflow: hidden;
        }
        .user-info {
            margin-left: auto;
            display: flex;
            align-items: center;
        }
        .menu-bar a {  /* COR DO TEXTO DOS BOTOES DO MENU */
            text-decoration: none;
            color: #ffeba7;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 18px 32px;
            border: none;
            border-radius: 0;
            background: transparent;
            transition: background 0.2s, color 0.2s;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            box-sizing: border-box;
        }
        .menu-bar a:hover { /*efeito menu (botoes) */
            background: #ffeba7;    
            color: #23243a; 
        }
        .user-info a.sair:hover{
            background:rgb(161, 21, 21)!important; 
            color:#23243a !important;
        }
        .card-header {
            background-color:#23243a !important;
        }
        .card-body {
            padding: 0px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
        }
        .card {
            margin: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgb(0, 0, 0);
        }
        .label-custom {
            color: #ffeba7 !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1.08rem;
            margin-bottom: 3px;
            text-shadow: 0 1px 2px #23243a44;
        }
        /* Adicione para inputs de data */
        input[type="date"].form-control {
            background-color: #23243a;
            color: #ffeba7;
            border: 1px solid #ffeba7;
        }
        input[type="date"].form-control:focus {
            background-color: #23243a;
            color: #ffeba7;
            border-color: #ffd700;
            box-shadow: 0 0 0 0.2rem rgba(255,235,167,.25);
        }
        .btn-filter-custom {
                background: linear-gradient(90deg,#ffeba7 60%,#ffd700 100%);
                color: #23243a;
                font-weight: 700;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(40,41,77,0.13);
                border: none;
                transition: box-shadow 0.2s, transform 0.2s;
        }
        .btn-filter-custom:hover, .btn-filter-custom:focus {
            box-shadow: 0 4px 16px rgba(40,41,77,0.18);
            transform: translateY(-2px) scale(1.03);
            color: #23243a;
        }
        .btn-filter-custom a {
            text-decoration: none !important;
            color: #23243a !important;
        }
        .btn-filter-custom a:hover {
            text-decoration: none !important;
        }
        /* Responsividade */
        @media (max-width: 991.98px) {
            .user-info {
                margin: 16px 16px 0 0;
                font-size: 1rem;
            }
            .menu-bar a {
                font-size: 1rem;
                padding: 14px 18px;
                min-width: 90px;
            }
        }
        @media (max-width: 767.98px) {
            .user-info {
                margin: 12px 8px 0 0;
                font-size: 0.98rem;
            }
            .menu-bar {
                flex-direction: column;
                border-radius: 0px;
            }
            .menu-bar a {
                width: 100%;
                justify-content: flex-start;
                padding: 14px 18px;
                border-bottom: 1px solid #23243a22;
                min-width: unset;
            }
            .menu-bar a:last-child {
                border-bottom: none;
            }
        }
        @media (max-width: 575.98px) {
            .user-info {
                margin: 8px 4px 0 0;
                font-size: 0.95rem;
                flex-direction: column;
                align-items: flex-end;
                gap: 4px;
            }
            .menu-bar {
                margin: 12px 0 18px 0;
                border-radius: 8px;
            }
            .menu-bar a {
                font-size: 0.98rem;
                padding: 12px 10px;
            }
        }
        @media (max-width: 400px) {
            .menu-bar a {
                font-size: 0.92rem;
                padding: 10px 4px;
            }
        }
    </style>
    <body>
        
        <div class="card-body" style="background-color: #ffeba7">    
            <div style="display: flex; flex-direction: column; align-items: center;">
                <h2><b>VISÃO GERAL</b></h2>
                <nav class="menu-bar" style="width: 100%;">
                    <div class="menu-links" style="display: flex; flex: 1; justify-content: center;">
                        <a href="inicial.php">VISÃO GERAL</a>
                        <a href="desempenho.php">RELATÓRIO</a>
                    </div>
                    <div class="user-info">
                        <a href="sair.php" class="sair" title="Sair">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M6 2a2 2 0 0 0-2 2v2a.5.5 0 0 0 1 0V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"/>
                            <path d="M.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H9.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2z"/>
                            </svg>
                        </a>
                    </div>
                </nav>
            </div>
        </div> 
        
        <div class="container-fluid mt-4">
            <form class="row g-2 align-items-end justify-content-start mb-4" method="get" action="filtrar.php">
                <div class="col-auto">
                    <label for="data_inicial" class="label-custom">Data Inicial</label>
                    <input type="date" class="form-control" name="data_inicial" style="color:#ffeba7;" required value="<?php echo isset($_GET['data_inicial']) ? htmlspecialchars($_GET['data_inicial']) : ''; ?>">
                </div>
                <div class="col-auto">
                    <label for="data_final" class="label-custom">Data Final</label>
                    <input type="date" class="form-control" name="data_final" style="color:#ffeba7;" required value="<?php echo isset($_GET['data_final']) ? htmlspecialchars($_GET['data_final']) : ''; ?>">
                </div>
                <div class="col-auto" style="padding-top: 28px;">
                    <button type="submit"  class="btn btn-filter-custom d-flex align-items-center px-4 py-2" style="font-weight:700; color:#23243a;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                            <path d="M6 10.117V14.5a.5.5 0 0 0 .757.429l2-1.2A.5.5 0 0 0 9 13.5v-3.383l5.447-6.516A1 1 0 0 0 13.882 2H2.118a1 1 0 0 0-.765 1.601L6 10.117z"/>
                        </svg>
                        Filtrar
                    </button>
                </div>  
                <div class="col-auto" style="padding-top: 30px;">
                    <button type="button" class="btn btn-filter-custom d-flex align-items-center px-4 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                        <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707"/>
                        </svg>
                        <span style="font-weight:700; color:#23243a;">Cadastrar Produção</span>
                    </button>
                </div>
                <?php if ($verificador == true) { ?>
                <div class="col-auto" style="padding-top: 30px;">
                    <button type="button" class="btn btn-filter-custom d-flex align-items-center px-4 py-2" onclick="window.location.href='removerFiltro.php'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                        <span style="font-weight:700; color:#23243a;">Remover filtro</span>
                    </button>
                </div>
                <?php } ?>
            </form>

            <div class="row g-3 align-items">
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Quantidade produzida:
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br>
                            <?php 
                                if($verificador == false){
                                    $prod = json_decode(file_get_contents("Producao.json"), true);
                                    if($index == "vazio"){
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                    }
                                    else{
                                        echo $prod[$index];
                                    }
                                }
                                else{
                                    $Producao1 = json_decode(file_get_contents("ProdFiltro.json"), true);
                                    if (!is_array($Producao1)) $Producao1 = [];
                                    $total = 0;

                                    foreach($Producao1 as $item1){
                                        $total += intval($item1);
                                    }
                                    echo $total;
                                
                                }   
                            ?>
                        </h3></center>
                    </div>
                </div>
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Quantidade de perdas: 
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br>
                            <?php 
                                if($verificador == false){
                                    $perda = json_decode(file_get_contents("perdas.json"), true);
                                    if($index == "vazio"){
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                    }
                                    else{
                                        echo $perda[$index];
                                    }
                                }
                                else{
                                    $Perda1 = json_decode(file_get_contents("PerdaFiltro.json"), true);
                                    if (!is_array($Perda1)) $Perda1 = [];
                                    $totalperdas = 0;

                                    foreach($Perda1 as $item2){
                                        $totalperdas += intval($item2);
                                    }
                                    echo $totalperdas;
                                } 
                            ?>
                        </h3></center>
                    </div>
                </div>
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Taxa de Produção:
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br>
                            <?php 
                                if($verificador == false){
                                    $Taxaprod = json_decode(file_get_contents("TxProd.json"), true);
                                    if($index == "vazio"){
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                       
                                    }
                                    else{   
                                        echo round($Taxaprod[$index], 2)."%";
                                    }
                                }
                                else{
                                    $Producao1 = json_decode(file_get_contents("ProdFiltro.json"), true);
                                    if (!is_array($Producao1)) $Producao1 = [];
                                    $total = 0;

                                    foreach($Producao1 as $item3){
                                        $total += intval($item3);
                                    }
                                    $quantia = count($Producao1);
                                    $Taxaprod = ($total / (200 * $quantia)) * 100;
                                    $_SESSION['Taxaprod'] = $Taxaprod;
                                    echo round($Taxaprod, 2)."%";
                                }
                            ?>
                        </h3></center>
                    </div>
                </div>
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Taxa de Refugo:
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br> 
                            <?php 
                                if($verificador == false){
                                    $tr = json_decode(file_get_contents("Txrefugo.json"), true);
                                    if($index == "vazio"){   
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                    }
                                    else{
                                        echo round($tr[$index], 2)."%";
                                    }
                                }
                                else{
                                    $Producao1 = json_decode(file_get_contents("ProdFiltro.json"), true);
                                    if (!is_array($Producao1)) $Producao1 = [];
                                    $total = 0;

                                    foreach($Producao1 as $item1){
                                        $total += intval($item1);
                                    }

                                    $Perda1 = json_decode(file_get_contents("PerdaFiltro.json"), true);
                                    if (!is_array($Perda1)) $Perda1 = [];
                                    $totalperdas = 0;

                                    foreach($Perda1 as $item4){
                                        $totalperdas += intval($item4);
                                    }
                                    
                                    $Taxarefugo = ($totalperdas / $total) * 100;
                                    $_SESSION['TaxaRefugo'] = $Taxarefugo;
                                    echo round($Taxarefugo, 2)."%";
                                } 
                            ?>
                        </h3></center>
                    </div>
                </div>
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Quantidade de funcionários:
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br> 
                            <?php 
                                if($verificador == false){
                                    $tr = json_decode(file_get_contents("funcionarios.json"), true);
                                    if($index == "vazio"){
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                    }
                                    else{
                                        echo $tr[$index];
                                    }
                                }
                                else{
                                    $funcionarios = json_decode(file_get_contents("funcionarios.json"), true);
                                    if (!is_array($funcionarios)) $funcionarios = [];
                                    $totalfuncionarios = 0;

                                    foreach($funcionarios as $item2){
                                        $totalfuncionarios += intval($item2);
                                    }
                                    echo $totalfuncionarios;
                                } 
                            ?>
                        </h3></center>
                    </div>
                </div>
                <div class="cols-12 col-md-2 mb-0">
                    <div class="card-header" style="background-color: #ffeba7; color:#ffeba7;">
                        Quantidade de retrabalho:
                    </div>
                    <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                        <center><h3></br> 
                            <?php 
                                if($verificador == false){
                                    $Retrabalho = json_decode(file_get_contents("retrabalho.json"), true);
                                    if($index == "vazio"){
                                        echo "Ainda não há dados cadastrados no dia de hoje!";
                                    }
                                    else{
                                        echo $Retrabalho[$index];
                                    }
                                }
                                else{
                                    $Retrabalho1 = json_decode(file_get_contents("RetrabFiltro.json"), true);
                                    if (!is_array($Retrabalho1)) $Retrabalho1 = [];
                                    $totalRetrab = 0;

                                    foreach($Retrabalho1 as $item5){
                                        $totalRetrab += intval($item5);
                                    }
                                    echo $totalRetrab;
                                    $verificador = false;
                                    $_SESSION['filtro'] = false;
                                }
                            ?>
                        </h3></center>
                    </div>
                </div>
            </div>
            <br/><br/>
            
            <!-- Gráficos principais: 1 e 2 lado a lado, cobrindo toda a largura -->
            <div class="row g-3 align-items"><!-- align-items-end para alinhar os cards pela base -->
                <div class="cols-12 col-md-12 mb-0"><!-- mb-0 remove margem inferior -->
                    <div class="card" style="height:55vh; min-height:800px; max-height:900px; margin-bottom:0;">
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                            <div class="row g-3 align-items">
                                <div class="cols-12 col-md-12 mb-0">
                                    <div class="card">
                                        <div class="card-details">
                                            <p class="text-title"><h7><b>
                                                <?php $primeiroProd = reset($DataFiltro); $ultimoProd = end($DataFiltro);
                                                    if ($verificadorgraficos == true){
                                                        if ($primeiroProd == $ultimoProd) {
                                                            echo "Quantidade Produzida do dia: $primeiroProd"; 
                                                        } else {
                                                         echo "Quantidade Produzida dos dias: $primeiroProd a $ultimoProd";}}
                                                    else{
                                                            echo "Quantidade Produzida nos últimos dias: ";
                                                         }
                                                     ?></b></h7></p>
                                            <p class="text-body"><?php include "grafico_Barra_QuantProd.php"; ?></p>
                                        </div>
                                    </div>    
                                </div>
                                <div class="cols-12 col-md-4 mb-0">
                                    <div class="card">
                                        <div class="card-details">
                                            <p class="text-title"><h7><b><?php $primeiroProd = reset($DataFiltro); $ultimoProd = end($DataFiltro);
                                                    if ($verificadorgraficos == true){
                                                        if ($primeiroProd == $ultimoProd) {
                                                            echo "Resumo da Produção do dia: $primeiroProd"; 
                                                        } else {
                                                         echo "Resumo Total das Produções dos dias: $primeiroProd a $ultimoProd";}}
                                                    else{
                                                            echo "Resumo da Produção dos últimos dias:";
                                                         } ?></h7></b></p>
                                            <p class="text-body"><?php include "grafico_Rosca_Prod.php"; ?></p>
                                        </div>
                                    </div>    
                                </div>
                                <div class="cols-12 col-md-4 mb-0">
                                    <div class="card">
                                        <div class="card-details">
                                            <p class="text-title"><h7><b><?php $primeiroProd = reset($DataFiltro); $ultimoProd = end($DataFiltro);
                                                    if ($verificadorgraficos == true){
                                                        if ($primeiroProd == $ultimoProd) {
                                                            echo "Taxa de Produção do dia: $primeiroProd"; 
                                                        } else {
                                                         echo "Taxa das Produções dos dias: $primeiroProd a $ultimoProd";}}
                                                    else{
                                                            echo "Taxa da Produção dos dias anteriores:";
                                                         } ?></h7></b></p>
                                            <p class="text-body"><?php include "grafico_TaxaProd.php"; ?></p>
                                        </div>
                                    </div>    
                                </div>
                                <div class="cols-12 col-md-4 mb-0">
                                    <div class="card">
                                        <div class="card-details">
                                            <p class="text-title"><h7><b><?php $primeiroProd = reset($DataFiltro); $ultimoProd = end($DataFiltro);
                                                    if ($verificadorgraficos == true){
                                                        if ($primeiroProd == $ultimoProd) {
                                                            echo "Taxa de Perda do dia: $primeiroProd"; 
                                                        } else {
                                                         echo "Taxa de Perdas dos dias: $primeiroProd a $ultimoProd";}}
                                                    else{
                                                            echo "Taxa de Perda dos dias anteriores: ";
                                                         } ?></h7></b></p>
                                            <p class="text-body"><?php include "grafico_TaxaPerda.php"; ?></p>
                                        </div>
                                    </div>    
                                </div>
                            <?php 
                            $verificadorgraficos = false;
                            $_SESSION['filtrograficos'] = false; ?>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #ffeba7">
                            <h5 class="modal-title" id="exampleModalLabel">REGISTRAR DADOS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start" style="background-color: #28294d; color: #ffeba7;">
                            <form action="cadastro.php" method="post">
                                <label class="form-label">QUANTIDADE PRODUZIDA</label>
                                <input class="form-control" type="number" name="QuantProd" required style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                </br>
                                <label class="form-label">QUANTIDADE DE RETRABALHO</label>
                                <input class="form-control" type="number" name="QuantRetrab" required style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                </br>
                                <label class="form-label">QUANTIDADE DE PERDAS</label>
                                <input class="form-control" type="number" name="QuantPerdas" required style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                </br>
                                <label class="form-label">QUANTIDADE DE FUNCIONARIOS PRESENTES</label>
                                <input class="form-control" type="number" name="QuantFuncionarios" required style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                </br>
                                <label class="form-label">TEMPO DE PRODUÇÃO</label>
                                <input class="form-control" type="text" name="time" id="tempoProducao" required maxlength="5" placeholder="--:--" style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                </br>
                                <label class="form-label">MODELO PRODUZIDO</label>
                                <select class="form-select" arial-label="MODELO PRODUZIDO" name="ModeloProd" required style="background:#23243a; color:#ffeba7; border:1px solid #ffeba7;">
                                    <option selected disabled></option>
                                    <option value="Modelo A">Modelo A</option>
                                    <option value="Modelo B">Modelo B</option>
                                    <option value="Modelo C">Modelo C</option>
                                    <option value="Modelo D">Modelo D</option>
                                </select>
                                </br>
                                <input type="submit" class="btn btn-success" value="CADASTRAR">
                                <input type="button" class="btn btn-outline-danger" value="FECHAR" data-bs-dismiss="modal">
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
            </div>
        </div>
        <!-- Adiciona máscara para o campo tempo de produção -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tempoInput = document.getElementById('tempoProducao');
            if (tempoInput) {
                tempoInput.addEventListener('input', function(e) {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length > 4) value = value.slice(0, 4);
                    if (value.length > 2) {
                        value = value.slice(0,2) + ':' + value.slice(2);
                    }
                    this.value = value;
                });
            }
        });
        </script>
    </body>
</html>