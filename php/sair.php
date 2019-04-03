<?php
session_start();
include 'conexao.php';

session_unset();
session_destroy();
$conexao = null;

header("location: ../index.php");

?>