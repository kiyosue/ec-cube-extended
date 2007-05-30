<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../require.php");

class LC_Page {
	
	var $arrSession;
	var $site_info;
	var $objDate;
	var $arrForm;
	var $mode;
	var $arrMagazineType;
	var $title;
	
	function LC_Page() {
		$this->tpl_mainpage = 'basis/mail.tpl';
		$this->tpl_mainno = 'basis';
		$this->tpl_subnavi = 'basis/subnavi.tpl';
		$this->tpl_subno = 'mail';
	}
}

$conn = new SC_DBConn();
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objSess = new SC_Session();

// ǧ�ڲ��ݤ�Ƚ��
sfIsSuccess($objSess);

$objPage->arrSendType = array("�ѥ�����","����");
$objPage->mode = "regist";

// id�����ꤵ��Ƥ���Ȥ��ϡ��Խ���ɽ��
if ( $_REQUEST['template_id'] ){
	$objPage->title = "�Խ�";
} else {
	$objPage->title = "������Ͽ";
}

// �⡼�ɤˤ�����ʬ��
if ( $_GET['mode'] == 'regist' ) {
	
	// ������Ͽ
	$objPage->arrForm = lfConvData( $_GET );
	//print_r($objPage->arrForm);print("<br>");
    $objPage->arrErr = lfErrorCheck($objPage->arrForm);
	
	if ( ! $objPage->arrErr ){
		// ���顼��̵���Ȥ�����Ͽ���Խ�
		lfRegistData( $objPage->arrForm, $_GET['template_id']);	
		//sfReload("mode=complete");	// ��ʬ����ɹ����ơ���λ���̤�����
	}
} 

$objView->assignobj($objPage);
$objView->display(MAIN_FRAME);


function lfRegistData( $arrVal, $id = null ){
	
	$query = new SC_Query();
	
    $sqlval['template_name'] = $arrVal['template_name'];
	$sqlval['subject'] = $arrVal['subject'];
	$sqlval['mail_method'] = $arrVal['mail_method'];
	$sqlval['creator_id'] = $_SESSION['member_id'];
	$sqlval['header'] = $arrVal['header'];
    $sqlval['footer'] = $arrVal['footer'];
	$sqlval['update_date'] = "now()";

	if ( $id ){
		$query->update("dtb_mailtemplate", $sqlval, "template_id=".$id );
	} else {
		$sqlval['create_date'] = "now()";
		$query->insert("dtb_mailtemplate", $sqlval);
	}
}

function lfConvData( $data ){
	
	 // ʸ������Ѵ���mb_convert_kana���Ѵ����ץ�����							
	$arrFlag = array(
					  "template_name" => "KV"
                     ,"subject" => "KV"
					 ,"body" => "KV"
					);
		
	if ( is_array($data) ){
		foreach ($arrFlag as $key=>$line) {
			$data[$key] = mb_convert_kana($data[$key], $line);
		}
	}
	return $data;
}

// ���ϥ��顼�����å�
function lfErrorCheck() {
	$objErr = new SC_CheckError();
    
	$objErr->doFunc(array("�᡼�����", "send_type"), array("EXIST_CHECK", "ALNUM_CHECK"));
    $objErr->doFunc(array("�ƥ�ץ졼��", "template_name"), array("EXIST_CHECK", "ALNUM_CHECK"));
//	$objErr->doFunc(array("Subject", "subject"), array("EXIST_CHECK","MAX_LENGTH_CHECK"));
//	$objErr->doFunc(array("�إå���", 'header'), array("EXIST_CHECK","MAX_LENGTH_CHECK"));
//    $objErr->doFunc(array("�եå���", 'footer'), array("EXIST_CHECK","MAX_LENGTH_CHECK"));

	return $objErr->arrErr;
}



?>