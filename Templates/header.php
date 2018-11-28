<?php
require_once "../Controller/PageController.php";
$controller = new \Controller\PageController();
$page = $controller->index();
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ecommerce</title>
        <link rel="stylesheet" href="/Templates/fonts/css/font-awesome.min.css">
        <link rel="stylesheet" href="/Templates/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Templates/css/style.css">
        <script src="/Templates/js/jquery-3.3.1.min.js"type="text/javascript"></script>
        <script src="/Templates/js/bootstrap.min.js"type="text/javascript"></script>
    </head>
<body>
<div class="conteudo">
    <div class="container-fluid text-center py-5 bg-azul">
        <div class="row">
            <div class="col">
                <a href="/">
                    <img width="250" class="img-fluid" src="/img/logo-fut.jpg" alt="Fut Master - artigos esportivos" title="Fut Master - artigos esportivos">
                </a>
            </div>
        </div>
    </div>
    <?php include "menu.php" ?>
