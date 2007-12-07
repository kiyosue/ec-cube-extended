<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once(MODULE_PATH . "mdl_gmo-pg/mdl_gmo-pg.inc");

/*

��ʧ��ˡ��ɽ��������

1�� ���ʧ��
2�� ʬ��ʧ��
3�� �ܡ��ʥ����ʧ��
4�� �ܡ��ʥ�ʬ��ʧ��
5�� ���ʧ��

 */

$arrPayMethod = array(
	'1-0' => "���ʧ��",
	'2-3' => "ʬ��3��ʧ��",
	'2-6' => "ʬ��6��ʧ��",
	'2-10'=> "ʬ��10��ʧ��",
	'2-15'=> "ʬ��15��ʧ��",
	'2-20'=> "ʬ��20��ʧ��",
	'5-0' => "���ʧ��"	
);

class LC_Page {
	function LC_Page() {
		/** ɬ�����ꤹ�� **/
		$this->tpl_css = '/css/layout/shopping/card.css';	// �ᥤ��CSS�ѥ�
		if (GC_MobileUserAgent::isMobile()) {
			$this->tpl_mainpage = MODULE_PATH . "mdl_gmo-pg/gmo-pg_credit_mobile.tpl";
		} else {
			$this->tpl_mainpage = MODULE_PATH . "mdl_gmo-pg/gmo-pg_credit.tpl";
		}
		global $arrPayMethod;
		$this->arrPayMethod = $arrPayMethod;
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
$objSiteSess = new SC_SiteSession();
$objCartSess = new SC_CartSession();
$objSiteInfo = $objView->objSiteInfo;
$arrInfo = $objSiteInfo->data;

// �ѥ�᡼���������饹
$objFormParam = new SC_FormParam();
// �ѥ�᡼������ν����
lfInitParam();
// POST�ͤμ���
$objFormParam->setParam($_POST);

// ������������������Ƚ��
$uniqid = sfCheckNormalAccess($objSiteSess, $objCartSess);

switch($_POST['mode']) {
// ��Ͽ
case 'regist':
	// �����ͤ��Ѵ�
	$objFormParam->convParam();
	$objPage->arrErr = lfCheckError($arrRet);

	// ���ϥ��顼�ʤ��ξ��
	if(count($objPage->arrErr) == 0) {
		// ���顼�ե饰
		$err_flg = false;
		
		// �����Ƚ��׽���
		$objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
		// �������ơ��֥���ɹ�
		$arrData = sfGetOrderTemp($uniqid);
		// �����Ƚ��פ򸵤˺ǽ��׻�
		$arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);
		// �����ɤ�ǧ�ڤ�Ԥ�
		$arrVal = $objFormParam->getHashArray();
		
				// �̿����顼��Ƚ��
		$access_err = false;
		// ���顼��å�����
		$credit_err = false;
		$gmo_err_msg = "";
		
		// ��������ID�����åȤ���Ƥ��ʤ����
		if($_SESSION['GMO']['ACCESS_ID'] == "") {
			// Ź�޾��������
			$arrEntryRet = lfSendGMOEntry($arrData['order_id'], $arrData['payment_total']);
			if($arrEntryRet == NULL) {
				$access_err = true;
			}
			
			// Ź�޾��󥨥顼��Ƚ��
			if($arrEntryRet['ERR_CODE'] == '0' && $arrEntryRet['ERR_INFO'] == 'OK') {
				$_SESSION['GMO']['ACCESS_ID'] = $arrEntryRet['ACCESS_ID'];
				$_SESSION['GMO']['ACCESS_PASS'] = $arrEntryRet['ACCESS_PASS'];
			} else {
				$_SESSION['GMO']['ACCESS_ID'] = "";
				$_SESSION['GMO']['ACCESS_PASS'] = "";				
				$credit_err = true;
				$detail_code01 = substr($arrEntryRet['ERR_INFO'], 0, 5);
				$detail_code02 = substr($arrEntryRet['ERR_INFO'], 5, 4);
				$gmo_err_msg = $detail_code01 . "-" . $detail_code02;
			}
		}
		
		// ���顼�ʤ��ξ��
		if(!$access_err && !$credit_err) {
			// Ź�޾����������
			$sqlval['memo04'] = $arrEntryRet['ERR_CODE'];
			$sqlval['memo05'] = $arrEntryRet['ERR_INFO'];
			
			// Ź�޾��󥨥顼��Ƚ��
			if($_SESSION['GMO']['ACCESS_ID'] != "" && $_SESSION['GMO']['ACCESS_PASS'] != "" ) {
				// ��Ѿ��������
				$arrExecRet = lfSendGMOExec($_SESSION['GMO']['ACCESS_ID'], $_SESSION['GMO']['ACCESS_PASS'], $arrData['order_id'], $arrVal['card_no01'], $arrVal['card_no02'], $arrVal['card_no03'], $arrVal['card_no04'], $arrVal['card_month'], $arrVal['card_year'], $arrVal['paymethod']);
				if($arrExecRet == NULL) {
					$access_err = true;
				}
			}
		}
		
		// ���顼�ʤ��ξ��
		if(!$access_err && !$credit_err) {
			// �ɲþ���Ϥʤ�������ߡ��ǡ������Ǽ
			$sqlval['memo02'] = serialize(array());
					
			// �������Ƥε�Ͽ
			$sqlval['memo03'] = $arrVal['card_name01'] . " " . $arrVal['card_name02'];
	
			// ��Ѿ����������
			$sqlval['memo06'] = $arrExecRet['ErrType'];
			$sqlval['memo07'] = $arrExecRet['ErrInfo'];
			
			$objQuery = new SC_Query();
			$objQuery->update("dtb_order_temp", $sqlval, "order_temp_id = ?", array($uniqid));
		
			// Ϳ�����������ξ��
			if($arrExecRet['Html'] == "Receipt" && $arrExecRet['ErrType'] == "" && $arrExecRet['ErrInfo'] == "") {
				// �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
				$objSiteSess->setRegistFlag();
				// ��������ID�򥯥ꥢ���롣
				$_SESSION['GMO']['ACCESS_ID'] = "";
				$_SESSION['GMO']['ACCESS_PASS'] = "";	
				// ������λ�ڡ�����
				if (GC_MobileUserAgent::isMobile()) {
					header("Location: " . gfAddSessionId(URL_SHOP_COMPLETE));
				} else {
					header("Location: " . URL_SHOP_COMPLETE);
				}
			} else {
				$credit_err = true;
				$detail_code01 = substr($arrExecRet['ErrInfo'], 0, 5);
				$detail_code02 = substr($arrExecRet['ErrInfo'], 5, 4);
				$gmo_err_msg = $detail_code01 . "-" . $detail_code02;
			}
		}
		
		if($access_err || $credit_err) {
			if($access_err) {
				$objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ������̿����顼";				
			} else {
				if($gmo_err_msg != "") {
					$objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ�����".$gmo_err_msg;				
				} else {
					$objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ����������ʥ��顼";								
				}
			}
		}
	}
	break;
// ���Υڡ��������
case 'return':
	// ����ʿ�ܤǤ��뤳�Ȥ�Ͽ���Ƥ���
	$objSiteSess->setRegistFlag();
	header("Location: " . URL_SHOP_CONFIRM);
	exit;
default:
	
	break;
}

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

$objPage->arrForm = $objFormParam->getFormParamList();

// ���̤�ɽ������
$objPage = sfGmoDisp($objPage, $payment_id);

$objView->assignobj($objPage);
$objView->display(SITE_FRAME);
//-----------------------------------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam() {
	global $objFormParam;
	$objFormParam->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("��", "card_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
	$objFormParam->addParam("̾", "card_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
	$objFormParam->addParam("��ʧ��ˡ", "paymethod", STEXT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
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

// Ź�޾��������
function lfSendGMOEntry($order_id, $amount, $tax = 0) {
	
	$arrRet = sfGetPaymentDB();
		
	$arrData = array(
		'OrderId' => $order_id,		// Ź�ޤ��Ȥ˰�դ���ʸID���������롣
		'TdTenantName' => '',		// 3Dǧ�ڻ�ɽ����Ź��̾
		'TdFlag' => '',				// 3D�ե饰
		'ShopId' => $arrRet[0]['gmo_shopid'],		// ����å�ID
		'ShopPass' => $arrRet[0]['gmo_shoppass'],	// ����åץѥ����
		'Currency' => 'JPN',		// �̲ߥ�����
		'Amount' => $amount,		// ���
		'Tax' => $tax,				// ������
		'JobCd' => 'AUTH',			// ������ʬ
		'TenantNo' => $arrRet[0]['gmo_tenantno'],	// Ź��ID���������롣
	);
	
	$req = new HTTP_Request(GMO_ENTRY_URL);
	$req->setMethod(HTTP_REQUEST_METHOD_POST);
	$req->addPostDataArray($arrData);
	
	if (!PEAR::isError($req->sendRequest())) {
		$response = $req->getResponseBody();
	}
	$req->clearPostData();
	$arrRet = lfGetPostArray($response);
	
	return $arrRet;
}

function lfSendGMOExec($access_id, $access_pass, $order_id, $cardno1, $cardno2, $cardno3, $cardno4, $ex_mm, $ex_yy, $paymethod) {
	
	// ��ʧ��ˡ������μ���
	list($method, $paytimes) = split("-", $paymethod);
	
	if(!($paytimes > 0)) {
		$paytimes = "";
	}
			
	$arrData = array(
	'AccessId' => $access_id,
	'AccessPass' => $access_pass,
	'OrderId' => $order_id,
	'RetURL' => GMO_RETURL,
	// �ץ�ѡ������ɤ򰷤�ʤ�����VISA�����OK
	'CardType' => 'VISA, 11111, 111111111111111111111111111111111111, 1111111111',
	// ��ʧ����ˡ
	/*
		1:���
		2:ʬ��
		3:�ܡ��ʥ����
		4:�ܡ��ʥ�ʬ��
		5:���ʧ��
	 */
	'Method' => $method,
	// ��ʧ���
	'PayTimes' => $paytimes,
	// �������ֹ�
	/*
		��ѥ������ֹ�ϡ�4111-1111-1111-1111
	 */
	'CardNo1' => $cardno1,
	'CardNo2' => $cardno2,
	'CardNo3' => $cardno3,
	'CardNo4' => $cardno4,
    'ExpireMM' => $ex_mm,
    'ExpireYY' => $ex_yy,
	// ����Ź��ͳ�����ֵѥե饰
    'ClientFieldFlag' => '1',
    'ClientField1' => 'f1',
    'ClientField2' => 'f2',
    'ClientField3' => 'f3',
	// ������쥯�ȥڡ����Ǥα�����������ʤ�
	/*
		0: HTML ������쥯�ȥڡ�����Default �͡�
		1: �ƥ�����
	 */
	'ModiFlag' => '1',	
	);
	
	$req = new HTTP_Request(GMO_EXEC_URL);
	$req->setMethod(HTTP_REQUEST_METHOD_POST);
	
	$req->addPostDataArray($arrData);
	
	if (!PEAR::isError($req->sendRequest())) {
		$response = $req->getResponseBody();
	}
	$req->clearPostData();
	
	$arrRet = lfGetPostArray($response);
	
	return $arrRet;
}

function lfGetPostArray($text) {
	$arrRet = array();
	if($text != "") {
		$text = ereg_replace("[\n\r]", "", $text);
		$arrTemp = split("&", $text);
		foreach($arrTemp as $ret) {
			list($key, $val) = split("=", $ret);
			$arrRet[$key] = $val;
		}
	}
	return $arrRet;
}
?>