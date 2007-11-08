<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once(MODULE_PATH . "mdl_paygent/mdl_paygent.inc");

class LC_Page {
	function LC_Page() {
		/** ɬ�����ꤹ�� **/
		$this->tpl_mainpage = MODULE_PATH . 'mdl_paygent/paygent_bank.tpl';		// �ᥤ��ƥ�ץ졼��
		/*
		 session_start����no-cache�إå������������뤳�Ȥ�
		 �����ץܥ�����ѻ���ͭ�������ڤ�ɽ�����������롣
		 private-no-expire:���饤����ȤΥ���å������Ĥ��롣
		*/
		session_cache_limiter('private-no-expire');		
	}
}

$objPage = new LC_Page();
$objView = new SC_SiteView();
$objCampaignSess = new SC_CampaignSession();
$objSiteInfo = $objView->objSiteInfo;
$arrInfo = $objSiteInfo->data;

if (GC_MobileUserAgent::isMobile()) {
	sfDispSiteError(FREE_ERROR_MSG, "", false, "��ԥͥåȷ�Ѥϡ������Ѥε���ˤ��б����Ƥ���ޤ���", true);
	exit;
}

// �ѥ�᡼���������饹
$objFormParam = new SC_FormParam();

// �������ơ��֥���ɹ�
$arrData = sfGetOrderTemp($uniqid);

// �ѥ�᡼������ν����
lfInitParam($arrData);
// POST�ͤμ���
$objFormParam->setParam($_POST);

// �����Ƚ��׽���
$objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);

// �������ơ��֥���ɹ�
$arrData = sfGetOrderTemp($uniqid);

// �����Ƚ��פ򸵤˺ǽ��׻�
$arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

switch($_POST['mode']) {
// ���Υڡ��������
case 'return':
	// ����ʿ�ܤǤ��뤳�Ȥ�Ͽ���Ƥ���
	$objSiteSess->setRegistFlag();
	header("Location: " . URL_SHOP_CONFIRM);
	exit;
	break;
// ����
case 'next':
	// �����ͤ��Ѵ�
	$objFormParam->convParam();
	$objPage->arrErr = lfCheckError($arrRet);
	// ���ϥ��顼�ʤ��ξ��
	if(count($objPage->arrErr) == 0) {
		 // ���ϥǡ����μ�����Ԥ�
    	$arrInput = $objFormParam->getHashArray();
		// ���쥸�å���ʸ����
		$arrRet = sfSendPaygentBANK($arrData, $arrInput, $uniqid);		
		
		// ����
		if($arrRet['asp_url'] != "") {
            // �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
			$objSiteSess->setRegistFlag();
			header("Location: " . $arrRet['asp_url']);
		} else {
			// ����
			$objPage->tpl_error = "ǧ�ڤ˼��Ԥ��ޤ�����������Ǥ����������Ƥ򤴳�ǧ����������";
		}
	}
	break;
// ��ѥڡ����ؤ����ܸ�α���
default:
	// �����Τ��ä�����ID���������ơ��֥��ID�Ȱ��פ��Ƥ��롣
	if($_GET['trading_id'] == $arrData['order_id']) {
		if($_GET['result'] == '0' && $_GET['payment_id'] != "") {
			// �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
            $objSiteSess->setRegistFlag();
            header("Location: " . URL_SHOP_COMPLETE);
		} else {
			// ����
			$objPage->tpl_error = "��Ѥ˼��Ԥ��ޤ�����������Ǥ������٤���³����Ԥ������̤Τ���ʧ����ˡ�����򤷤Ʋ�������";
		}
	}	
	break;
}

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

// ���̤�ɽ������
$objPage = sfPaygentDisp($objPage, $payment_id);

$objPage->arrNetBank = $arrNetBank;
$objPage->arrForm = $objFormParam->getFormParamList();
$objView->assignobj($objPage);
// �ե졼�������(�����ڡ���ڡ����������ܤʤ��ѹ�)
$objCampaignSess->pageView($objView);
//-------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam($arrData) {
	global $objFormParam;
	$objFormParam->addParam("���Ѽ���", "customer_family_name", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name01']);
	$objFormParam->addParam("���Ѽ�̾", "customer_name", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name02']);
	$objFormParam->addParam("���Ѽ�������", "customer_family_name_kana", STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana01']);
	$objFormParam->addParam("���Ѽ�̾����", "customer_name_kana", STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana02']);
}

/* �������ƤΥ����å� */
function lfCheckError() {
	global $objFormParam;
	// ���ϥǡ������Ϥ���
	$arrRet =  $objFormParam->getHashArray();
	$objErr = new SC_CheckError($arrRet);
	$objErr->arrErr = $objFormParam->checkError();
	
	return $objErr->arrErr;
}
?>