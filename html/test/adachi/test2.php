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



$objView = new SC_AdminView();
$objView->assignArray($arrAssignVars);
$objView->display(MAIN_FRAME);
?>