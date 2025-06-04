<?php 
    // @see https://desenvolvimentoparaweb.com/css/css-breakpoints-maneira-correta/


    session_start();
    $data ="0";
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    if(!isset($_SESSION['nomes'])){
        $emails = json_decode(file_get_contents("email.json"), true);
        $senhas = json_decode(file_get_contents("senha.json"), true);
        $nomes = json_decode(file_get_contents("nome.json"), true);
        $datas = json_decode(file_get_contents("data.json"), true);
        $QuantProd = json_decode(file_get_contents("Producao.json"), true);
        $QuantRetrabs = json_decode(file_get_contents("retrabalho.json"), true);
        $QuantPerdass = json_decode(file_get_contents("perdas.json"), true);
        $QuantFuncionarioss = json_decode(file_get_contents("funcionarios.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $_SESSION['nomes'] = $nomes;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['emails'] = $emails;

        $data0 = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("data.json", $data0);
    }
    else{
        $emails = $_SESSION['emails'];
        $id = array_search($_SESSION['usuario'], $emails);
        $nomes = $_SESSION['nomes'];
    }
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
            background-color:#ffeba7 !important;
        }
        .card-body {
            padding: 6px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
        }
        .card {
            margin: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
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
                border-radius: 10px;
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
                        <a href="desempenho.php">ACOMPANHAR DESEMPENHO</a>
                        <a href="gravar.php">IMPRIMIR DADOS</a>
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
            <form class="row g-2 align-items-end justify-content-start mb-4" method="get">
                <div class="col-auto">
                    <label for="data_inicial" class="label-custom">Data Inicial</label>
                    <input type="date" class="form-control" id="data_inicial" name="data_inicial" style="color:#ffeba7;" value="<?php echo isset($_GET['data_inicial']) ? htmlspecialchars($_GET['data_inicial']) : ''; ?>">
                </div>
                <div class="col-auto">
                    <label for="data_final" class="label-custom">Data Final</label>
                    <input type="date" class="form-control" id="data_final" name="data_final" style="color:#ffeba7;" value="<?php echo isset($_GET['data_final']) ? htmlspecialchars($_GET['data_final']) : ''; ?>">
                </div>
                <div class="col-auto" style="padding-top: 28px;">
                    <button type="submit" class="btn btn-filter-custom d-flex align-items-center px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                            <path d="M6 10.117V14.5a.5.5 0 0 0 .757.429l2-1.2A.5.5 0 0 0 9 13.5v-3.383l5.447-6.516A1 1 0 0 0 13.882 2H2.118a1 1 0 0 0-.765 1.601L6 10.117z"/>
                        </svg>
                        <span style="font-weight:700; color:#23243a;">Filtrar</span>
                    </button>
                </div>
                <div class="col-auto" style="padding-top: 30px;">
                    <button type="submit" class="btn btn-filter-custom d-flex align-items-center px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                        <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM5.904 10.803 10 6.707v2.768a.5.5 0 0 0 1 0V5.5a.5.5 0 0 0-.5-.5H6.525a.5.5 0 1 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 .707.707"/>
                        </svg>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><span style="font-weight:700; color:#23243a;">Cadastrar Produção</span></a>
                    </button>
                </div>
            </form>
            
            <!-- Gráficos principais: 1 e 2 lado a lado, cobrindo toda a largura -->
            <div class="row g-3 align-items-end"><!-- align-items-end para alinhar os cards pela base -->
                <div class="cols-12 col-md-4 mb-0"><!-- mb-0 remove margem inferior -->
                    <div class="card" style="height:55vh; min-height:120px; max-height:700px; margin-bottom:0;">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 1: Resumo de Datas</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                            <?php include "grafico.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-0">
                    <div class="card" style="height:55vh; min-height:220px; max-height:700px; margin-bottom:0;">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 2: Quantidade Produzida</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto; height:100%;">
                            <?php include "grafico_produzidas.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Demais gráficos em linhas de até 3 -->
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-0 pt-0"><!-- mt-0 e pt-0 para remover margem/padding superior -->
                <div class="col">
                    <div class="card h-55">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 3: Quantidade de Refugo</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto;">
                            <?php include "grafico_retrabalho.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-55">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 4: Funcionarios Presentes</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto;">
                            <?php include "grafico_funcionarios.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-55">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 5: Modelos Mais Produzidos</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto;">
                            <?php include "grafico_modelo.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-55">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 6: Produção por Dia</b>
                        </div>
                        <div class="card-body" style="background:#fff; border-radius:8px; overflow-x:auto;">
                            <?php include "grafico_dias.php"; ?>
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
    </body>
</html>