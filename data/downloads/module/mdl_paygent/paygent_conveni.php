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
		if (GC_MobileUserAgent::isMobile()) {
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_conveni_mobile.tpl";
		} else {
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_conveni.tpl";
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
if (GC_MobileUserAgent::isMobile()) {
	$objView = new SC_MobileView();
} else {
	$objView = new SC_SiteView();
}
$objCampaignSess = new SC_CampaignSession();
$objSiteInfo = $objView->objSiteInfo;
$arrInfo = $objSiteInfo->data;

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

// �����Ƚ��פ򸵤˺ǽ��׻�
$arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

switch($_POST['mode']) {
// ���Υڡ��������
case 'return':
	// ����ʿ�ܤǤ��뤳�Ȥ�Ͽ���Ƥ���
	$objSiteSess->setRegistFlag();
	if (GC_MobileUserAgent::isMobile()) {
		header("Location: " . gfAddSessionId(MOBILE_URL_SHOP_CONFIRM));
	} else {
		header("Location: " . URL_SHOP_CONFIRM);
	}
	break;
// ����
case 'next':
	// �����ͤ��Ѵ�
	$objFormParam->convParam();
	$objPage->arrErr = lfCheckError();
	// ���ϥ��顼�ʤ��ξ��
	if(count($objPage->arrErr) == 0) {
		 // ���ϥǡ����μ�����Ԥ�
    	$arrInput = $objFormParam->getHashArray();
		// ���쥸�å���ʸ����
		$arrRet = sfSendPaygentConveni($arrData, $arrInput, $uniqid);
		
		// ����
		if($arrRet['result'] === "0") {
            // �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
            $objSiteSess->setRegistFlag();
            LC_Helper_Send_Payment::sendPaymentData(MDL_PAYGENT_CODE, $arrData['payment_total']);
			if (GC_MobileUserAgent::isMobile()) {
				header("Location: " . gfAddSessionId(MOBILE_URL_SHOP_COMPLETE));
			} else {
				header("Location: " . URL_SHOP_COMPLETE);
			}
		} else {
			// ����
			$objPage->tpl_error = "��Ѥ˼��Ԥ��ޤ�����". $arrRet['response'];
		}
	}
	break;
}


// ���̤�ɽ������
$objPage = sfPaygentDisp($objPage, $payment_id);

$objPage->arrConvenience = $arrConvenience;
$objPage->arrForm = $objFormParam->getFormParamList();
$objView->assignobj($objPage);
// �ե졼�������(�����ڡ���ڡ����������ܤʤ��ѹ�)
$objCampaignSess->pageView($objView);

//---------------------------------------------------------------------------------------------

/* �ѥ�᡼������ν���� */
function lfInitParam($arrData) {
	global $objFormParam;
	$objFormParam->addParam("����ӥ�", "cvs_company_id", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));	
	$objFormParam->addParam("���Ѽ���", "customer_family_name", PAYGENT_CONVENI_MTEXT_LEN / 2, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name01']);
	$objFormParam->addParam("���Ѽ�̾", "customer_name", PAYGENT_CONVENI_MTEXT_LEN / 2, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name02']);
	$objFormParam->addParam("���Ѽ�������", "customer_family_name_kana", PAYGENT_CONVENI_STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana01']);
	$objFormParam->addParam("���Ѽ�̾����", "customer_name_kana", PAYGENT_CONVENI_STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana02']);
	$objFormParam->addParam("�������ֹ�", "customer_tel", 11, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK" ,"NUM_CHECK"), $arrData['order_tel01'].$arrData['order_tel02'].$arrData['order_tel03']);
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