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
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_credit_mobile.tpl";
		} else {
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_credit.tpl";
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

// ���쥸�å��ѥѥ�᡼���μ���
$arrPaymentDB = sfGetPaymentDB(MDL_PAYGENT_ID, "AND memo03 = 1");
$arrConfig = unserialize($arrPaymentDB[0]['other_param']);

// �⡼������
$_POST['mode'] = lfGetMode();

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
		$arrRet = sfSendPaygentCredit($arrData, $arrInput, $uniqid);
		
		// ��������Ͽ
        if ($_POST['stock_new'] == 1 && $_POST['stock'] != 1 && 
            ($arrRet['result'] === "0" || $arrRet['result'] === "7")) {
            sfSetPaygentCreditStock($arrData, $arrInput);
        }
		// ������3D�����奢̤�б���
		if ($arrRet['result'] === "0") {
            // �������Ͽ���줿���Ȥ�Ͽ
            $objSiteSess->setRegistFlag();
            LC_Helper_Send_Payment::sendPaymentData(MDL_PAYGENT_CODE, $arrData['payment_total']);
			if (GC_MobileUserAgent::isMobile()) {
				header("Location: ". gfAddSessionId(MOBILE_URL_SHOP_COMPLETE));
			} else {
				header("Location: ". URL_SHOP_COMPLETE);
			}
		// ������3D�����奢�б���
		} elseif ($arrRet['result'] === "7") {
			// �����ɲ�Ҳ��̤����ܡ�ACS��ʧ��ǧ���׵�HTML��ɽ����
			print mb_convert_encoding($arrRet['out_acs_html'], CHAR_CODE, "Shift-JIS");
			exit;
		// ����
		} else {
			$objPage->tpl_error = "��Ѥ˼��Ԥ��ޤ�����". $arrRet['response'];
		}
	}
	break;
// 3D�����奢�»ܸ�
case '3d_secure':
	// ���쥸�å���ʸ������3D�����奢�»ܸ��
	$arrRet = sfSendPaygetnCredit3d($arrData, $_POST, $uniqid);
	// ����
	if ($arrRet['result'] === "0") {
		// �������Ͽ���줿���Ȥ�Ͽ
		$objSiteSess->setRegistFlag();
		LC_Helper_Send_Payment::sendPaymentData(MDL_PAYGENT_CODE, $arrData['payment_total']);
		header("Location: ". URL_SHOP_COMPLETE);
	}
	break;
// ��Ͽ�����ɺ��
case 'deletecard':
    // �����ͤ��Ѵ�
    $objFormParam->convParam();
    $objPage->arrErr = lfCheckError();
    // ���ϥ��顼�ʤ��ξ��
    if(count($objPage->arrErr) == 0) {
        // ���ϥǡ����μ���
        $arrInput = $objFormParam->getHashArray();
        $arrRet = sfDelPaygentCreditStock($arrData, $arrInput);
        // ����
        if ($arrRet[0]['result'] !== "0") {
            $objPage->arrErr['CardSeq'] = "��Ͽ�����ɾ���κ���˼��Ԥ��ޤ�����". $arrRet[0]['response'];
        }
    }
	break;
}

// ��Ͽ�����ɾ���μ���
if ($arrConfig['stock_card'] == 1) {
    $objPage = lfGetStockCardData($arrData, $objPage);
}

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

// ���̤�ɽ������
$objPage = sfPaygentDisp($objPage, $payment_id);

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
	$_POST['mode'] = (isset($_POST['mode'])) ? $_POST['mode'] : "";
	$_POST['stock'] = (isset($_POST['stock'])) ? $_POST['stock'] : "";
	if ($_POST['mode'] == "deletecard" || $_POST['stock'] == 1) {
		$objFormParam->addParam("��ʧ���", "payment_class", INT_LEN, "n", array());
		$objFormParam->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array());
		$objFormParam->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array());
		$objFormParam->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array());
		$objFormParam->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array());
		$objFormParam->addParam("�����ɴ���ǯ", "card_year", 2, "n", array());
		$objFormParam->addParam("�����ɴ��·�", "card_month", 2, "n", array());
		$objFormParam->addParam("��", "card_name01", 32, "KVa", array());
		$objFormParam->addParam("̾", "card_name02", 32, "KVa", array());
	} else {
		$objFormParam->addParam("��ʧ���", "payment_class", INT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
		$objFormParam->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
		$objFormParam->addParam("��", "card_name01", 32, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
		$objFormParam->addParam("̾", "card_name02", 32, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
	}
	if ($_POST['mode'] == "deletecard") {
		$objFormParam->addParam("���������", "CardSeq", "", "n", array("EXIST_CHECK", "NUM_CHECK"));
	} elseif ($_POST['stock'] == 1) {
		$objFormParam->addParam("", "stock", "", "n", array());
		$objFormParam->addParam("��Ͽ������", "CardSeq", "", "n", array("EXIST_CHECK", "NUM_CHECK"));
	}
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

/**
 * �⡼������
 */
function lfGetMode() {
    $mode = '';
    // 3D�����奢�����
    if (isset($_GET['mode']) && $_GET['mode'] == "credit_3d" && 
        isset($_GET['uniqid']) && $_GET['uniqid'] == $uniqid) {
        $mode = '3d_secure';
    // ��Х��롧��Ͽ�����ɤκ��
    } elseif (isset($_POST['deletecard'])) {
        $mode = 'deletecard';
    // ����¾
    } elseif (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }
    return $mode;
}

/**
 * ��Ͽ�����ɾ������
 */
function lfGetStockCardData($arrData, $objPage) {
    $objQuery = new SC_Query();
    
    // ��Ͽ�Ԥγ�ǧ
    $ret = $objQuery->select("paygent_card", "dtb_customer", "customer_id = ?", array($arrData['customer_id']));
    // ��Ͽ�Ԥξ������
    if (count($ret) > 0) {
        $objPage->stock_flg = 1;
        if ($ret[0]['paygent_card'] == 1) {
            $arrRet = sfGetPaygentCreditStock($arrData);
            // ����
            if ($arrRet[0]['result'] === "0") {
                foreach ($arrRet as $key => $val) {
                    if ($key != 0) {
                        $objPage->arrCardInfo[] = array("CardSeq" => $val['customer_card_id'],
                                                     "CardNo" => $val['card_number'],
                                                     "Expire" => $val['card_valid_term'],
                                                     "HolderName" => $val['cardholder_name']);
                    }
                }
            // ����
            } else {
                $objPage->tpl_error = "��Ͽ�����ɾ���μ����˼��Ԥ��ޤ�����". $arrRet[0]['response'];
            }
        }
    }
    $objPage->cnt_card = count($objPage->arrCardInfo);
    if ($objPage->cnt_card >= 5) $objPage->stock_flg = 0;
    if ($objPage->cnt_card > 0) $objPage->tpl_onload = "fnCngStock();";
    
    return $objPage;
}
?>