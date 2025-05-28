<?php 
    session_start();
    $data = date("d/m/Y");
    $_SESSION['data'] = $data;
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
        body {
            background: #2a2b38;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .user-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: center;
            margin: 16px 40px 0 0;
            color: #ffeba7;
            font-size: 1.1rem;
            font-weight: 500;
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
            margin: 24px 0 32px 0;
            width: 100%;
            gap: 0;
            overflow: hidden;
        }
        .menu-bar a {
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
        .menu-bar a:hover {
            background: #ffeba7;
            color: #23243a;
        }
        .card-header {
            background-color: #ffeba7 !important;
        }
        .card-body {
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
        }
        .card {
            margin: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
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
        <div class="user-info">
            Olá, <?php echo isset($_SESSION['nomes']) && isset($id) ? htmlspecialchars($_SESSION['nomes'][$id]) : 'Usuário'; ?> 
            <a href="sair.php" title="Sair">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M6 2a2 2 0 0 0-2 2v2a.5.5 0 0 0 1 0V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"/>
                  <path d="M.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H9.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2z"/>
                </svg>
            </a>
        </div>
        <div class="card-body" style="background-color: #ffeba7">    
            <center><h2><b>DESEMPENHO</b></h2></center>
        </div> 
        <nav class="menu-bar">
            <a href="inicial.php">HOME</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">CADASTRAR DADOS</a>
            <a href="desempenho.php">ACOMPANHAR DESEMPENHO</a>
            <a href="gravar.php">SALVAR DADOS</a>
        </nav>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 1: Funcionários Presentes</b>
                        </div>
                        <div class="card-body">
                            <?php include "grafico_funcionarios.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 2: Unidades Produzidas</b>
                        </div>
                        <div class="card-body">
                            <?php include "grafico_produzidas.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 3: Unidades de Retrabalho</b>
                        </div>
                        <div class="card-body">
                            <?php include "grafico_retrabalho.php"; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header" style="background-color: #ffeba7;">
                            <b>Gráfico 4: Número de Defeitos</b>
                        </div>
                        <div class="card-body">
                            <?php include "grafico_defeitos.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>