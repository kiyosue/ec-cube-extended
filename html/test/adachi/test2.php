<?php

require_once("../../require.php");
require_once("SC_FormParamsManager.php");

// Smarty�ؤ�assign��Ϣ������
$arrAssignVars = array(
    'tpl_mainpage' => 'basis/kiyaku.tpl',
    'tpl_subnavi'  => 'basis/subnavi.tpl',
    'tpl_subno'    => 'kiyaku',
    'tpl_subtitle' => '���������Ͽ',
    'tpl_mainno'   => 'basis'
);



$objView = new SC_View();
$objView->assignArray($arrAssignVars);
$objView->display('/home/web/dev.ec-cube.net/html/test/adachi/templates/test2.tpl');
?>