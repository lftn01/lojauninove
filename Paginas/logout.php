<?php
session_start();
unset($_SESSION['usuario']);
header("Location: /Paginas/home.php");