<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../../require.php");

$message = "";

// ��������
if(sfColumnExists("dtb_mailtemplate", "send_type", "int2", DEFAULT_DSN, true)) {
    $message.= "send_type ok<br />\n";
}

// ��������
if(sfColumnExists("dtb_mailtemplate", "body", "text", DEFAULT_DSN, true)) {
    $message.= "body ok<br />\n";
}

// ��������
if(sfColumnExists("dtb_mailtemplate", "template_name", "text", DEFAULT_DSN, true)) {
    $message.= "template_name ok<br />\n";
}

$objQuery = new SC_Query();

$arrVal['send_type'] = '1';
$arrVal['template_name'] = '����λ�ƥ�ץ졼��(PC��������)';

$objQuery->update("dtb_mailtemplate", $arrVal, "template_id = ?", array('1'));

$arrVal['send_type'] = '2';
$arrVal['template_name'] = '����λ�ƥ�ץ졼��(���ӥ�������)';

$objQuery->update("dtb_mailtemplate", $arrVal, "template_id = ?", array('2'));

$message.= "�ǡ����򹹿����ޤ�����<br />\n";
print($message);

?>