<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../require.php");

// ǧ�ڲ��ݤ�Ƚ��
sfIsSuccess(new SC_Session());

// order_id�θ���
if (lfIsValidOrderID() !== true) {
    sfDispError('');
}

class LC_Page {
    var $arrMAILTEMPLATE;

    function LC_Page() {
		$this->tpl_mainpage = 'order/mail.tpl';
		$this->tpl_subnavi = 'order/subnavi.tpl';
		$this->tpl_mainno = 'order';
		$this->tpl_subno = 'index';
		$this->tpl_subtitle = '�������';
	}
}

$objPage = new LC_Page();
$objView = new SC_AdminView();
$objFormParam = new SC_FormParam();

// �ѥ�᡼������ν����
lfInitParam();

// �����ѥ�᡼���ΰ����Ѥ�
foreach ($_POST as $key => $val) {
	if (ereg("^search_", $key)) {
		$objPage->arrSearchHidden[$key] = $val;
	}
}

$objPage->tpl_order_id = $_POST['order_id'];

// DB������������ɤ߹���
lfGetOrderData($_POST['order_id']);

//�ƥ�ץ졼�ȥե�����إǡ���������
$objPage->arrMAILTEMPLATE = lfCreateTemplateList();

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
switch($mode) {
// ���������������
case 'pre_edit':
	break;
// ��ǧ���̤������.
case 'return':
	// POST�ͤμ���
	$objFormParam->setParam($_POST);
	break;
case 'send':
	// POST�ͤμ���
	$objFormParam->setParam($_POST);
	// �����ͤ��Ѵ�
	$objFormParam->convParam();
	$objPage->arrErr = $objFormParam->checkerror();
	// �᡼�������
	if (count($objPage->arrErr) == 0) {
		// ��ʸ���ե᡼��
		sfSendOrderMail($_POST['order_id'], $_POST['template_id'], $_POST['subject'], $_POST['body']);
	}
	header("Location: " . URL_SEARCH_ORDER);
	exit;
	break;
case 'confirm':
	// POST�ͤμ���
	$objFormParam->setParam($_POST);
	// �����ͤ��Ѵ�
	$objFormParam->convParam();
	// �����ͤΰ����Ѥ�
	$objPage->arrHidden = $objFormParam->getHashArray();
	$objPage->arrErr = $objFormParam->checkerror();
	// �᡼�������
	if (count($objPage->arrErr) == 0) {
		// ��ʸ���ե᡼��(�����ʤ�)
		$objSendMail = sfSendOrderMail($_POST['order_id'], $_POST['template_id'], $_POST['subject'], $_POST['body'], false);
		// ��ǧ�ڡ�����ɽ��
		$objPage->tpl_subject = $objSendMail->subject;
		$objPage->tpl_body = mb_convert_encoding( $objSendMail->body, "EUC-JP", "auto" );
		$objPage->tpl_to = $objSendMail->tpl_to;
		$objPage->tpl_mainpage = 'order/mail_confirm.tpl';

		$objView->assignobj($objPage);
		$objView->display(MAIN_FRAME);

		exit;
	}
	break;
case 'change':
	$objFormParam->setValue('template_id', $_POST['template_id']);

    if(sfIsInt($_POST['template_id'])) {
        $objQuery = new SC_Query();
		$where = "template_id = ?";
		$arrRet = $objQuery->select("subject, body", "dtb_mailtemplate", $where, array($_POST['template_id']));
        $objFormParam->setParam($arrRet[0]);
	}
	break;
}

if(sfIsInt($_POST['order_id'])) {
	$objPage->arrMailHistory = lfGetMailHistory($_POST['order_id']);
}

$objPage->arrForm = $objFormParam->getFormParamList();
$objView->assignObj($objPage);
$objView->display(MAIN_FRAME);
//-----------------------------------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam() {
	global $objFormParam;
	$objFormParam->addParam("�ƥ�ץ졼��", "template_id", INT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
	$objFormParam->addParam("�᡼�륿���ȥ�", "subject", STEXT_LEN, "KVa",  array("EXIST_CHECK", "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
	$objFormParam->addParam("��ʸ", "body", LTEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
}

function lfGetOrderData($order_id) {
	global $objFormParam;
	global $objPage;
	if(sfIsInt($order_id)) {
		// DB������������ɤ߹���
		$objQuery = new SC_Query();
		$where = "order_id = ?";
		$arrRet = $objQuery->select("*", "dtb_order", $where, array($order_id));
		$objFormParam->setParam($arrRet[0]);
		list($point, $total_point) = sfGetCustomerPoint($order_id, $arrRet[0]['use_point'], $arrRet[0]['add_point']);
		$objFormParam->setValue('total_point', $total_point);
		$objFormParam->setValue('point', $point);
		$objPage->arrDisp = $arrRet[0];
	}
}

/**
 * POST�����order_id�򸡾ڤ���.
 *
 * @param void
 * @return boolean
 */
function lfIsValidOrderID() {
    if (isset($_POST['order_id']) && sfIsint($_POST['order_id'])) {
        return true;
    }
    return false;
}

/**
 * �ƥ�ץ졼�ȥץ�������˥塼��������������.
 * array(
 *   array(template_id => template_name),
 *   array(template_id => template_name),
 *   ...
 * )
 *
 * @param void
 * @return array
 */
function lfCreateTemplateList() {
    $objQuery = new SC_Query;
    $objQuery->setOrder('template_id ASC');
    $arrTemp = $objQuery->select('template_id, template_name', 'dtb_mailtemplate', 'del_flg = 0');

    $arrRet = array();
    foreach($arrTemp as $val) {
        $arrRet[$val['template_id']] = $val['template_name'];
    }

    return $arrRet;
}

/**
 * �᡼���ۿ�������������.
 *
 * @param integer $order_id
 * @return array
 */
function lfGetMailHistory($order_id) {
    $cols  = "send_date, subject, template_id, send_id";
    $where = "order_id = ?";
    $objQuery = new SC_Query();
    $objQuery->setorder("send_date DESC");

    $arrRet = $objQuery->select($cols, "dtb_mail_history", $where, array($order_id));
    return $arrRet;
}
