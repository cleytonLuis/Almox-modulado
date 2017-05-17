<?php
// inica ou continua a sessão
session_start();
// Se não houver a informação de login na sessão
if(!isset($_SESSION['logado']) or !$_SESSION['logado'])
{
  // Mando o cara logar
  header("Location: /almox/mod_login/login.php");
  // Interrompe o script
  exit(0);
}

