<?php 
    // @see https://desenvolvimentoparaweb.com/css/css-breakpoints-maneira-correta/

    session_start();
    $verificador = isset($_SESSION['filtrorelatorio']) ? $_SESSION['filtrorelatorio'] : null; // Corrigido nome da variável
    $datas = json_decode(file_get_contents("data.json"), true);
    if (!is_array($datas)) $datas = [];
    $date = date("d/m/Y");
    $index = array_search($date, $datas);
    $_SESSION['index'] = $index;
    if(count($datas) == 0) {
        $data ="0";
        $data0 = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("data.json", $data0);
    }
    if(!isset($_SESSION['usuario'])){
        header('Location:index.php');
    }
    $emails = json_decode(file_get_contents("email.json"), true);
    $senhas = json_decode(file_get_contents("senha.json"), true);
    $nomes = json_decode(file_get_contents("nome.json"), true);
    $QuantProd = json_decode(file_get_contents("Producao.json"), true);
    $QuantRetrabs = json_decode(file_get_contents("retrabalho.json"), true);
    $QuantPerdass = json_decode(file_get_contents("perdas.json"), true);
    $QuantFuncionarioss = json_decode(file_get_contents("funcionarios.json"), true);
    $Modelos = json_decode(file_get_contents("ModeloProd.json"), true);
    $tempo = json_decode(file_get_contents("tempoProd.json"), true);
    
    $DataFiltro = json_decode(file_get_contents("DataFiltro.json"), true);
    $ProdFiltro = json_decode(file_get_contents("ProdFiltro.json"), true);
    $RetrabFiltro = json_decode(file_get_contents("RetrabFiltro.json"), true);
    $PerdaFiltro = json_decode(file_get_contents("PerdaFiltro.json"), true);
    $FuncionarioFiltro = json_decode(file_get_contents("FuncionarioFiltro.json"), true);
    $ModeloFiltro = json_decode(file_get_contents("ModeloFiltro.json"), true);
    $TempoFiltro = json_decode(file_get_contents("TempoFiltro.json"), true);
    if (!is_array($QuantProd)) $QuantProd = [];
    if (!is_array($QuantRetrabs)) $QuantRetrabs = [];
    if (!is_array($QuantPerdass)) $QuantPerdass = [];
    if (!is_array($QuantFuncionarioss)) $QuantFuncionarioss = [];
    if (!is_array($Modelos)) $Modelos = [];
    if (!is_array($tempo)) $tempo = [];
    $id = array_search($_SESSION['usuario'], $emails);
    $_SESSION['nomes'] = $nomes;
    $_SESSION['senhas'] = $senhas;
    $_SESSION['emails'] = $emails;

    $data_inicial = isset($_GET['data_inicialRelatorio']) ? $_GET['data_inicialRelatorio'] : '';
    $data_final = isset($_GET['data_finalRelatorio']) ? $_GET['data_finalRelatorio'] : '';
    if ($data_inicial !== '' && $data_final !== '') {
        // Redireciona para filtrarRelatorio.php para aplicar o filtro
        header('Location: filtrarRelatorio.php?data_inicialRelatorio=' . urlencode($data_inicial) . '&data_finalRelatorio=' . urlencode($data_final));
        exit;
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
        .btn-outline-warning{
            color: #ffeba7;
            background-color: #23243a;
            border-color    : #ffeba7;
        }
        .btn-outline-warning:hover{
            background-color: #ffeba7;
            
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
        @media print {
            body * {
                visibility: hidden !important;
            }
            #tabela-dados, #tabela-dados * {
                visibility: visible !important;
            }
            #tabela-dados {
                position: absolute;
                left: 0;
                top: 0;
                width: 100vw;
                background: white;
                color: black;
            }
        }
    </style>
    <body>
        <div class="card-body" style="background-color: #ffeba7">    
            <div style="display: flex; flex-direction: column; align-items: center;">
                <h2><b>RELATÓRIO</b></h2>
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
            <form class="row g-2 align-items-end justify-content-start mb-4" method="get" action="filtrarRelatorio.php">
                <div class="col-auto">
                    <label for="data_inicial" class="label-custom">Data Inicial</label>
                    <input type="date" class="form-control" id="data_inicialRelatorio" name="data_inicialRelatorio" style="color:#ffeba7;" value="<?php echo isset($_GET['data_inicialRelatorio']) ? htmlspecialchars($_GET['data_inicialRelatorio']) : ''; ?>">
                </div>
                <div class="col-auto">
                    <label for="data_final" class="label-custom">Data Final</label>
                    <input type="date" class="form-control" id="data_finalRelatorio" name="data_finalRelatorio" style="color:#ffeba7;" value="<?php echo isset($_GET['data_finalRelatorio']) ? htmlspecialchars($_GET['data_finalRelatorio']) : ''; ?>">
                </div>
                <div class="col-auto" style="padding-top: 28px;">
                    <button type="submit" class="btn btn-filter-custom d-flex align-items-center px-4 py-2" style="font-weight:700; color:#23243a;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                            <path d="M6 10.117V14.5a.5.5 0 0 0 .757.429l2-1.2A.5.5 0 0 0 9 13.5v-3.383l5.447-6.516A1 1 0 0 0 13.882 2H2.118a1 1 0 0 0-.765 1.601L6 10.117z"/>
                        </svg>
                        <span style="font-weight:700; color:#23243a;">Filtrar</span>
                    </button>
                </div>
                <div class="col-auto" style="padding-top: 28px;">
                    <button type="button" class="btn btn-filter-custom d-flex align-items-center px-4 py-2" onclick="window.print()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#23243a" class="me-2" viewBox="0 0 16 16">
                            <path d="M2 7a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7zm2-5a2 2 0 0 0-2 2v2h12V4a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v1H3V4a1 1 0 0 1 1-1zm0 8a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                        <span style="font-weight:700; color:#23243a;">Imprimir</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="container-fluid mt-4">
            <!-- Botões de filtro para ordenação -->
            <div class="mb-3 d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="0">Ordenar por Data</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="1">Ordenar por Produção</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="2">Ordenar por Retrabalho</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="3">Ordenar por Perdas</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="4">Ordenar por Funcionários</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="5">Ordenar por Tempo de Produção</button>
                <button type="button" class="btn btn-outline-warning sort-filter" data-col="6">Ordenar por Modelo</button>
            </div>
            <table class="table table-dark table-striped" id="tabela-dados">
                 <thead>
                 <tr>
                    <th>DATA</th>
                    <th>PRODUÇÃO</th>
                    <th>RETRABALHO</th>
                    <th>PERDAS</th>
                    <th>FUNCIONÁRIOS</th>
                    <th>TEMPO DE PRODUÇÃO</th>
                    <th>MODELO</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    if($verificador == false){
                        $total = count($datas);
                        $por_pagina = 20;
                        $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
                        $inicio = ($pagina - 1) * $por_pagina;
                        $fim = min($inicio + $por_pagina, $total);
                        for ($i = $inicio; $i < $fim; $i++){
                            echo "<tr>";
                            echo "<td>".$datas[$i]."</td>";
                            echo "<td>".$QuantProd[$i]."</td>";
                            echo "<td>".$QuantRetrabs[$i]."</td>";
                            echo "<td>".$QuantPerdass[$i]."</td>";
                            echo "<td>".$QuantFuncionarioss[$i]."</td>";
                            echo "<td>".$tempo[$i]."</td>";
                            echo "<td>".$Modelos[$i]."</td>";
                            echo "</tr>";
                        }
                    }
                    else{
                        $total = count($DataFiltro); // Corrigido para usar array filtrado
                        $por_pagina = 20;
                        $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
                        $inicio = ($pagina - 1) * $por_pagina;
                        $fim = min($inicio + $por_pagina, $total);
                        for ($i = $inicio; $i < $fim; $i++){
                            echo "<tr>";
                            echo "<td>".$DataFiltro[$i]."</td>";
                            echo "<td>".$ProdFiltro[$i]."</td>";
                            echo "<td>".$RetrabFiltro[$i]."</td>";
                            echo "<td>".$PerdaFiltro[$i]."</td>";
                            echo "<td>".$FuncionarioFiltro[$i]."</td>";
                            echo "<td>".$TempoFiltro[$i]."</td>";
                            echo "<td>".$ModeloFiltro[$i]."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
            <?php if ($total > $por_pagina) { 
                $total_paginas = ceil($total / $por_pagina); ?>
            <nav aria-label="...">
                <ul class="pagination pagination-sm">
                    <?php for ($p = 1; $p <= $total_paginas; $p++) { ?>
                        <li class="page-item <?php if ($p == $pagina) echo 'active'; ?>">
                            <a class="page-link" href="?pagina=<?php echo $p; ?>"><?php echo $p; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
            <?php } ?>
        </div>
        <script>
        // Ordenação de tabela por coluna 
        document.addEventListener('DOMContentLoaded', function() {
            const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
            const comparer = (idx, asc) => (a, b) => {
                let v1 = getCellValue(asc ? a : b, idx);
                let v2 = getCellValue(asc ? b : a, idx);
                v1 = v1.replace(/\D/g, '') !== '' ? parseFloat(v1.replace(/[^\d,.-]/g, '').replace(',', '.')) : v1;
                v2 = v2.replace(/\D/g, '') !== '' ? parseFloat(v2.replace(/[^\d,.-]/g, '').replace(',', '.')) : v2;
                if (!isNaN(v1) && !isNaN(v2)) return v1 - v2;
                return v1.toString().localeCompare(v2.toString(), 'pt-BR', {numeric: true});
            };
            // Estado de ordenação para cada coluna
            const sortState = {};
            document.querySelectorAll('.sort-filter').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const table = document.getElementById('tabela-dados');
                    const tbody = table.querySelector('tbody');
                    let col = parseInt(btn.getAttribute('data-col'));
                    // Alterna asc/desc para cada coluna
                    sortState[col] = !sortState[col];
                    let asc = sortState[col];
                    let rows = Array.from(tbody.querySelectorAll('tr'));
                    rows.sort(comparer(col, asc));
                    rows.forEach(tr => tbody.appendChild(tr));
                });
            });
        });
        </script>
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