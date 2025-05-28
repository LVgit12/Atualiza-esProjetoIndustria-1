<?php
// @see https://desenvolvimentoparaweb.com/css/css-breakpoints-maneira-correta/


    session_start();
    $data = date("d/m/Y");
    $_SESSION['data'] = $data;
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    if(!isset($_SESSION['nomes'])){
        $emails = json_decode(file_get_contents("email.json"), true);
        $senhas = json_decode(file_get_contents("senha.json"), true);
        $nomes = json_decode(file_get_contents("nome.json"), true);
        $id = array_search($_SESSION['usuario'], $emails);
        $_SESSION['nomes'] = $nomes;
        $_SESSION['senhas'] = $senhas;
        $_SESSION['emails'] = $emails;
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
        body {
            background: #23243a;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
        .card-body {
            background-color: #ffeba7;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
        }
        .card {
            margin: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(40,41,77,0.10);
        }
        .grafico-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: auto;
            overflow: hidden;
        }
        .grafico-container iframe, .grafico-container canvas {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
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
            .grafico-container {
                padding: 8px;
            }
            .grafico-container iframe, .grafico-container canvas {
                max-width: 95%;
                height: auto;
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
            .grafico-container iframe, .grafico-container canvas {
                max-width: 90%;
                height: auto;
            }
        }
        @media (max-width: 400px) {
            .menu-bar a {
                font-size: 0.92rem;
                padding: 10px 4px;
            }
            .grafico-container iframe, .grafico-container canvas {
                max-width: 85%;
                height: auto;
            }
        }
    </style>
    <body>
        <div class="user-info">
            Olá, <?php echo htmlspecialchars($nomes[$id]); ?> 
            <a href="sair.php" title="Sair">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M6 2a2 2 0 0 0-2 2v2a.5.5 0 0 0 1 0V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"/>
                  <path d="M.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H9.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2z"/>
                </svg>
            </a>
        </div>
        <div class="card-body">    
            <center><h2><b>MENU INICIAL</b></h2></center>
        </div> 
        <nav class="menu-bar">
            <a href="inicial.php">HOME</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">CADASTRAR DADOS</a>
            <a href="desempenho.php">ACOMPANHAR DESEMPENHO</a>
            <a href="gravar.php">SALVAR DADOS</a>
        </nav>
        <br>
        <center><h2><span style="color: white;">Olá, <?php echo htmlspecialchars($nomes[$id]); ?>!</span></h2></center>
        <br/><br/>
        <div class="row justify-content-center row-cols-2 row-cols-md-3 text-center">
            <div class="cols">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3" style="background-color: #ffeba7">
                        <h3><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                        <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1z"/>
                        </div>
                        </svg>&nbsp;&nbsp;<b>GRÁFICO DO DIA: <?php echo date("d/m/Y") ?></b></h3>
                    <div class="card-body grafico-container">
                       <?php
                            include "grafico2.php";
                       ?>
                    </div>
                </div>
            </div>
            <div class="cols">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3" style="background-color: #ffeba7">
                        <h3><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-bar-chart-line-fill" viewBox="0 0 16 16">
                        <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1z"/>
                        </svg>&nbsp;&nbsp;<b></b></h3>
                    </div>
                    <div class="card-body grafico-container">
                        <?php
                            include "grafico.php";
                        ?>
                    </div>
                </div>
            </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CADASTRAR DADOS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <form action="cadastro.php" method="post">
                            <label class="form-label">QUANTIDADE DE FUNCIONÁRIOS PRESENTES NO DIA</label>
                            <input class="form-control" type="number" name="nome" required>
                            </br>
                            <label class="form-label">NÚMERO DE UNIDADES PRODUZIDAS</label>
                            <input class="form-control" type="number" name="email" required>
                            </br>
                            <label class="form-label">NÚMERO DE UNIDADES DE RETRABALHO</label>
                            <input class="form-control" type="number" name="senha" required>
                            </br>
                            <label class="form-label">NÚMERO DE DEFEITOS</label>
                            <input class="form-control" type="number" name="senha" required >
                            </br>
                            <input type="submit" class="btn btn-success" value="GERAR GRÁFICO">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">FECHAR</button>
                    </div>
                </div>
            </div>
        </div>  
    </body>
</html>