<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once(MODULE_PATH . "mdl_zeus/mdl_zeus.inc");

class LC_Page {
	function LC_Page() {
		if (GC_MobileUserAgent::isMobile()) {
			$this->tpl_mainpage = MODULE_PATH . "mdl_zeus/zeus_credit_mobile.tpl";
		} else {
			$this->tpl_mainpage = MODULE_PATH . "mdl_zeus/zeus_credit.tpl";
		}		
		/*
		 session_start����no-cache�إå������������뤳�Ȥ�
		 �����ץܥ�����ѻ���ͭ�������ڤ�ɽ�����������롣
		 private-no-expire:���饤����ȤΥ���å������Ĥ��롣
		*/
		session_cache_limiter('private-no-expire');		
	}
}

$objPage = new LC_Page();
$objView = (GC_MobileUserAgent::isMobile()) ? new SC_MobileView() : new SC_SiteView();
$objCampaignSess = new SC_CampaignSession();
$objSiteInfo = $objView->objSiteInfo;
$arrInfo = $objSiteInfo->data;


// �ѥ�᡼���������饹
$objFormParam = new SC_FormParam();
// �ѥ�᡼������ν����
lfInitParam();
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
	if (GC_MobileUserAgent::isMobile()) {
		header("Location: " . gfAddSessionId(URL_SHOP_CONFIRM));
	} else {
		header("Location: " . URL_SHOP_CONFIRM);
	}
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
		$ret = sfPostPaymentData($arrData, $arrInput);
		// ����
		if($ret) {
            // �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
            $objSiteSess->setRegistFlag();
			if (GC_MobileUserAgent::isMobile()) {
				header("Location: " . gfAddSessionId(URL_SHOP_COMPLETE));
			} else {
				header("Location: " . URL_SHOP_COMPLETE);
			}
		} else {
			// ����
			$objPage->tpl_error = "ǧ�ڤ˼��Ԥ��ޤ�����������Ǥ����������Ƥ򤴳�ǧ����������";
		}
	}
	break;
case 'quick_charge':
    // ���쥸�å���ʸ����
	$ret = sfPostPaymentData($arrData, $arrInput, true);
	// ����
	if($ret) {
    	// �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
        $objSiteSess->setRegistFlag();
		if (GC_MobileUserAgent::isMobile()) {
			header("Location: " . gfAddSessionId(URL_SHOP_COMPLETE));
		} else {
			header("Location: " . URL_SHOP_COMPLETE);
		}
	} else {
		// ����
		$objPage->tpl_error = "ǧ�ڤ˼��Ԥ��ޤ�����������Ǥ����������Ƥ򤴳�ǧ����������";
	}
	break;
}

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

// ������ʸ�򸡺����롣
$objPage->quick_charge_ok = sfEnableQuickCharge($arrData['customer_id']);

// ���̤�ɽ������
$objPage = sfZeusDisp($objPage, $payment_id);

// ��ʧ���
$objPage->arrPaymentClass = $arrPaymentClass;
$objPage->arrForm = $objFormParam->getFormParamList();
$objView->assignobj($objPage);
// �ե졼�������(�����ڡ���ڡ����������ܤʤ��ѹ�)
$objCampaignSess->pageView($objView);
//-------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam() {
	global $objFormParam;
	$objFormParam->addParam("��ʧ���", "payment_class", INT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
	$objFormParam->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("̾", "card_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
	$objFormParam->addParam("��", "card_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
	$objFormParam->addParam("�������Ѥ��������ɤ���Ѥ���", "quick_check", INT_LEN, "n", array("MAX_LENGTH_CHECK"));	
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