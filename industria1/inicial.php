<?php
    session_start();
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
        <title>PHP / Array</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <style>
        .user{
            float: right;
        }
        body{
            background:  #2a2b38;
        }

        @keyframes gradient {
            0% {
            background-position: 0% 50%;
            }
            50% {
            background-position: 100% 50%;
            }
            100% {
            background-position: 0% 50%;
        }
        }

    </style>
    <body>
        <div class="card-body" style="background-color: #ffeba7">    
            <center><h2><b>MENU INICIAL</b></h2></center>
        </div> 
        <nav>
            &nbsp;&nbsp;<b><a href="inicial.php" style="color: white; text-decoration:none"> HOME |</a><a href="inicial.php" style="color: white; text-decoration:none" data-bs-toggle="modal" data-bs-target="#exampleModal"> CADASTRAR DADOS |</a><a href="desempenho.php" style="color: white; text-decoration:none"> ACOMPANHAR DESEMPENHO |</a><a href="gravar.php" style="color: white; text-decoration:none"> SALVAR DADOS</a></b>
            <div class="user" style="color: white; text-decoration:none">
                <b><?php echo $nomes[$id]; ?> - <a href="sair.php" style="color: white; text-decoration:none">SAIR</a></b>&nbsp;&nbsp;
            </div>
        </nav>
        <br><br>
        <center><h2><font color="white">SEJA BEM-VINDO, <?php echo $nomes[$id] ?>!</font></h2></center>
        <br/><br/>
        <div class="row justify-content-center row-cols-1 row-cols-md-3 text-center">
                <div class="card mb-4 rounded shadow-sw">
                    <div class="card-header py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#000080" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg><br/>
                        <h3><font color="black"><b>DADOS RECENTES</b></font></h3>
                    </div>
                    <div class="card-body">
                        <?php
                            
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
                            <label class="form-label">QUANTIDADE DE FUNCIONÁRIOS DO DIA</label>
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
                            <input type="submit" class="btn btn-success" value="CADASTRAR">
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