<?php
require_once 'init.php';

$auth->logout();
$_SESSION['success_message'] = 'Você foi desconectado com sucesso.';
header('Location: login.php');
exit;