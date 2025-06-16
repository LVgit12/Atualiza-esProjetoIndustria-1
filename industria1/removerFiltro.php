<?php
    session_start();
    $_SESSION['filtro'] = false;
    $_SESSION['filtrograficos'] = false;
    header("Location:inicial.php");
    exit;
?>