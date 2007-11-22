<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../require.php");

class LC_Page {
	var $arrSession;
	var $tpl_mode;
	function LC_Page() {
		$this->tpl_mainpage = "basis/mail_edit.tpl";
		$this->tpl_subnavi = "basis/subnavi.tpl";
		$this->tpl_mainno = "basis";
		$this->tpl_subno = "mail";
		$this->tpl_subtitle = "�᡼������";
	}
}

$objQuery = new SC_Query();
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objSess = new SC_Session();

//ǧ�ڲ��ݤ�Ƚ��
sfIsSuccess($objSess);

$objPage->arrMailTEMPLATE = $arrMAILTEMPLATE;
$objPage->arrSendType = $arrMailType;

// �Խ�/����
if ($_POST['mode'] == "edit") {
	if (sfCheckNumLength($_POST['template_id']) === true) {
		$result = $objQuery->select("*", "dtb_mailtemplate", "template_id = ?", array($_POST['template_id']));
		if ($result) {
			$objPage->arrForm = $result[0];
		} else {
			$objPage->arrForm['template_id'] = $_POST['template_id'];
		}
	} else {
		$objPage->arrForm['template_id'] = 0;
	}

// ��Ͽ
} elseif ($_POST['mode'] == "regist" && sfCheckNumLength($_POST['template_id']) === true) {
	// POST�ǡ����ΰ����Ѥ�
	$objPage->arrForm = lfConvertParam($_POST);
	$objPage->arrErr = fnErrorCheck($objPage->arrForm);
	// ���顼
	if ($objPage->arrErr) {
		$objPage->tpl_msg = "���顼��ȯ�����ޤ���";
	// ����
	} else {
		lfRegist($objQuery, $objPage->arrForm, $_POST['template_id']);
		sfReload("mode=complete");
	}

// ��λ
} elseif ($_GET['mode'] == 'complete') {
	$objPage->tpl_mainpage = "basis/mail_complete.tpl";
}

$objView->assignobj($objPage);
$objView->display(MAIN_FRAME);

//-----------------------------------------------------------------------------------------------------------------------------------

function lfRegist($objQuery, $arrVal, $id) {
	$sqlval['template_name'] = $arrVal['template_name'];
	$sqlval['subject'] = $arrVal['subject'];
	$sqlval['creator_id'] = $_SESSION['member_id'];
	$sqlval['body'] = $arrVal['body'];
	$sqlval['send_type'] = $arrVal['send_type'];
	$sqlval['update_date'] = "now()";
	
	$result = $objQuery->count("dtb_mailtemplate", "template_id=?", array($id));
	if ($result > 0) {
		$objQuery->update("dtb_mailtemplate", $sqlval, "template_id=?", array($id));
	} else {
		$sqlval['create_date'] = "now()";
		$objQuery->insert("dtb_mailtemplate", $sqlval);
	}
}

function lfConvertParam($array) {
    $new_array["send_type"] = $array["send_type"];
	$new_array["template_id"] = $array["template_id"];
    $new_array["template_name"] = mb_convert_kana($array["template_name"],"KV");
	$new_array["subject"] = mb_convert_kana($array["subject"] ,"KV");
	$new_array["body"] = mb_convert_kana($array["body"] ,"KV");
	
	return $new_array;
}

/* ���ϥ��顼�Υ����å� */
function fnErrorCheck($array) {
	$objErr = new SC_CheckError($array);
	$objErr->doFunc(array("�᡼��μ���",'send_type'), array("EXIST_CHECK"));
	$objErr->doFunc(array("�ƥ�ץ졼��",'template_id'), array("EXIST_CHECK"));
    $objErr->doFunc(array("�ƥ�ץ졼��",'template_name'), array("EXIST_CHECK"));
	$objErr->doFunc(array("�᡼�륿���ȥ�",'subject',MTEXT_LEN,"BIG"), array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
	$objErr->doFunc(array("�᡼�������",'body',LTEXT_LEN,"BIG"), array("MAX_LENGTH_CHECK","EXIST_CHECK"));
	
	return $objErr->arrErr;
}

?>