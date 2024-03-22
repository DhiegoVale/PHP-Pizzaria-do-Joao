<?php
include_once("loginverificacao.php");
session_destroy();

header('Location: login.php');

?>