<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once MODULE_PATH . "mdl_cybs/mdl_cybs.inc";
require_once MODULE_PATH . "mdl_cybs/class/mdl_cybs_config.php";
require_once MODULE_PATH . "mdl_cybs/class/mdl_cybs_request.php";
dl(MDL_CYBS_EXT);

class LC_Page {
    function LC_Page() {
        $this->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs_credit.tpl';
        /**
         * session_start����no-cache�إå������������뤳�Ȥ�
         * �����ץܥ�����ѻ���ͭ�������ڤ�ɽ�����������롣
         * private-no-expire:���饤����ȤΥ���å������Ĥ��롣
         */
        session_cache_limiter('private-no-expire');
    }
}

$objPage = new LC_Page();
$objView = new SC_SiteView();
$objSiteSess = new SC_SiteSession();
$objCartSess = new SC_CartSession();
$objCampaignSess = new SC_CampaignSession();
$arrInfo = sf_getBasisData();

// �桼����ˡ���ID�μ����ȹ������֤�������������å�
$uniqid = sfCheckNormalAccess($objSiteSess, $objCartSess);

$objForm = lfInitParam();
$objPage->arrForm = $objForm->getFormParamList();

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
switch($mode) {

case 'register':
    // ���Ϲ��ܤθ���
    if ($arrErr = lfCheckError($objForm)) {
        $objPage->arrErr = $arrErr;
        //break;
    }
    // �����Ƚ��׽���
    $objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
    // �������ơ��֥���ɹ�
    $arrData = sfGetOrderTemp($uniqid);
    // �����Ƚ��פ򸵤˺ǽ��׻�
    $arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);
    $objConfig =& new Mdl_Cybs_Config;
sfPrintR($objConfig->getConfig());
    break;

// ���ܥ��󲡲���
case 'return':
    break;

// �̾�ɽ��
default:
}

$objView->assignobj($objPage);
$objView->display(SITE_FRAME);

/**
 * �ѥ�᡼���ν����
 *
 * @return SC_FormParam
 */
function lfInitParam() {
    $objForm = new SC_FormParam;
    $objForm->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objForm->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objForm->addParam("��", "card_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objForm->addParam("̾", "card_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objForm->addParam("��ʧ��ˡ", "paymethod", STEXT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
    return $objForm;
}

/**
 * ���Ϲ��ܤΥ��顼�����å�
 *
 * @param SC_FormParam $objForm
 * @return array|null
 */
function lfCheckError($objForm) {
    if ($arrErr = $objForm->checkError()) {
        return $arrErr;
    }
    return null;
}

function lfSendRequest($objForm, $arrData) {
    global $arrCybsRequestURL;

    $objConfig =& new Mdl_Cybs_Config;
    $objRequest = new CYBS_REQ;

    $arrConfig = $objConfig->getConfig();

    $objRequest->add_request("server_host",$arrCybsRequestURL[$arrConfig['cybs_request_url']]);
    $objRequest->add_request("server_port","80");
    $objRequest->add_request("ics_applications","ics_auth");
    $objRequest->add_request("merchant_id",$arrConfig['cybs_merchant_id']);
    $objRequest->add_request("customer_cc_number","4111111111111111");
    $objRequest->add_request("customer_cc_expmo","02");
    $objRequest->add_request("customer_cc_expyr","2010");
    $objRequest->add_request("customer_firstname","��Ϻ");
    $objRequest->add_request("customer_lastname","�����С�");
    $objRequest->add_request("customer_email","nobody@cybersourec.co.jp");
    $objRequest->add_request("customer_phone","11-1111-1111");
    $objRequest->add_request("bill_address1","������3-2-5");
    $objRequest->add_request("bill_address2","�쿭���ʥӥ�2F");
    $objRequest->add_request("bill_city","�����Ķ�");
    $objRequest->add_request("bill_state","�����");
    $objRequest->add_request("bill_zip","111-1111");
    $objRequest->add_request("bill_country","JP");
    $objRequest->add_request("merchant_ref_number","11111");
    $objRequest->add_request("currency","JPY");
    $objRequest->add_request("offer0","offerid:0^amount:200");
}

function lfConvertRequestParam($objForm) {

}
?>
