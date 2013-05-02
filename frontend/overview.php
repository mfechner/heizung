<?php
include('Smarty.class.php');
session_start();

$smarty = new Smarty;
$smarty->assign('name', 'george smith');
$smarty->assign('address', '45th & Harris');

$smarty->display('overview.tpl');
