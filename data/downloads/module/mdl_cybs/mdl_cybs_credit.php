<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once MODULE_PATH . "mdl_cybs/mdl_cybs.inc";
require_once MODULE_PATH . "mdl_cybs/class/mdl_cybs_config.php";
require_once MODULE_PATH . "mdl_cybs/class/mdl_cybs_request.php";

// extension�����󥹥ȡ��뤵��Ƥ��ʤ���Х��顼����ɽ��
if (!lfLoadModCybs()) {
    sfDispSiteError(FREE_ERROR_MSG, '', false,
        '���η�Ѥϻ��Ѥ��뤳�Ȥ�����ޤ���<br>������Ǥ�������ʧ����ˡ������ľ���Ʋ�������');
}

class LC_Page {
    function LC_Page() {
        $this->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs_credit.tpl';
        // ��ʧ����ˡ
        global $arrPayMethod;
        $this->arrPayMethod = $arrPayMethod;
        // �����ɲ�Ҽ���
        global $arrCardCompany;
        $this->arrCardCompany = $arrCardCompany;
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

$objCybs =& Mdl_Cybs_Config::getInstanse();
$objPage->enable_ondemand = $objCybs->enableOndemand(); //����ǥޥ�ɲݶ�λ��Ѳ���
$objPage->tpl_payment_method = '�����С����������';

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

// �桼����ˡ���ID�μ����ȹ������֤�������������å�
$uniqid = sfCheckNormalAccess($objSiteSess, $objCartSess);

$objForm = lfInitParam($_POST);
$objPage->arrForm = $objForm->getFormParamList();

switch(lfGetMode()) {

case 'register':
    // ���Ϲ��ܤθ���
    if ($arrErr = $objForm->checkError()) {
        $objPage->arrErr = $arrErr;
        break;
    }

    // �����Ƚ��׽���
    $objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
    // �������ơ��֥���ɹ�
    $arrData = sfGetOrderTemp($uniqid);
    // �����Ƚ��פ򸵤˺ǽ��׻�
    $arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

    /**
     * ����ǥޥ�ɲݶ⤬ͭ���ǡ����ĥ����ɤ���Ͽ����˥����å������äƤ������ϡ�
     * ���֥�����ץ������������
     */
    if ($objCybs->enableOndemand() && $objForm->getValue('register_ondemand')) {
        // ��Ͽ����Υ����å�
        if (!$objCybs->canAddSubsId()) {
            $objPage->tpl_error = '��Ͽ����륫���ɤη����' . MDL_CYBS_SUBS_ID_MAX . "��ޤǤǤ���\n";
            gfPrintLog(' -> ondemand error: over card max', MDL_CYBS_LOG);
            break;
        }
        // ����ǥޥ�ɲݶ�Υꥯ�����Ȥ���������
        $arrResults = lfSendRequest(lfCreateOndemandParam($objForm->getHashArray(), $arrData));
        if (PEAR::isError($e = lfIsError($arrResults))) {
            $objPage->tpl_error = $e->getMessage();
            gfPrintLog(' -> ondemand error: ' . $e->getMessage(), MDL_CYBS_LOG);
            gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
            break;
        }
        // ���֥�����ץ����ID��ܵҥơ��֥���ɲä���
        $subsId = $arrResults['pay_subscription_create_subscription_id'];
        $objCybs->addSubsId($subsId);
    }

    $authAddParam = null; // ���㡼���Хå����ɲåѥ�᡼��

    // 3D�����奢��������Ƚ��
    if ($objCybs->use3D() && !$objCybs->enableOndemand()) {
        // 3D�����奢�ꥯ�����Ȥ���������
        $arrResults = lfSendRequest(lfCreateEnrollParam($objForm->getHashArray(), $arrData));
        // ���顼����
        if (PEAR::isError($e = lfIsError($arrResults))) {
            $objPage->tpl_error = $e->getMessage();
            gfPrintLog(' -> 3d(enroll) error: ' . $e->getMessage(), MDL_CYBS_LOG);
            gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
            break;
        }

        /**
         * ��Ͽͭ��ξ��ϥ�����쥯��HTML����Ϥ���.
         * ��Ͽ̵���Ǥ���Ϳ���ؿʤ����(�嵭���顼Ƚ���SOK�ξ��)��,
         * ���㡼���Хå��ѤΥѥ�᡼�����ɲä�����Ϳ���ꥯ�����Ȥؿʤ�.
         */
        if (isset($arrResults['pa_enroll_rflag']) && $arrResults['pa_enroll_rflag'] == 'DAUTHENTICATE') {
            $objPage->AcsUrl  = $arrResults['pa_enroll_acs_url'];
            $objPage->TermUrl = SSL_URL . 'shopping/load_payment_module.php';
            $objPage->PaReq   = $arrResults['pa_enroll_pareq'];
            $objPage->MD      = base64_encode(serialize($objForm->getHashArray())); // POST�ǡ�����MD���ݻ�
            $objPage->tpl_onload   = 'OnLoadEvent()';
            $objPage->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs_credit_3d.tpl'; // ������쥯��HTML
            $objSiteSess->setRegistFlag();
            break;
        }
        // ���㡼���Хå����ɲåѥ�᡼��
        $authAddParam = array(
            'e_commerce_indicator' => $arrResults['pa_enroll_e_commerce_indicator'],
            'eci_raw'              => '06',
        );
        // �ޥ����������ɤΤߤΥѥ�᡼��
        if ($objForm->getValue('card_company') === '002') $authAddParam['ucaf_collection_indicator'] = '1';
    }

    $arrSendParam = array();
    // ����ǥޥ�ɷ�ѻ��Υѥ�᡼������
    if ($objCybs->enableOndemand() && $objForm->getValue('register_ondemand')) {
        $arrSendParam = lfCreateAuthParam($objForm->getHashArray(), $arrData);
        $arrSendParam = lfCreateOndemandAuthParam($subsId, $arrSendParam);

    // �̾��ѤΥѥ�᡼������
    } else {
        $arrSendParam = lfCreateAuthParam($objForm->getHashArray(), $arrData, $authAddParam);
    }

    // Ϳ���ꥯ�����Ȥ���������
    $arrResults = lfSendRequest($arrSendParam);
    if (PEAR::isError($e = lfIsError($arrResults))) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog(' -> auth error: ' . $e->getMessage(), MDL_CYBS_LOG);
        gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
        break;
    }

    $objSiteSess->setRegistFlag();
    //lfRegisterOrderTemp($uniqid, $objForm->getHashArray(), $arrResults);
    header("Location: " . URL_SHOP_COMPLETE);
    exit;

// �ѥ�������Ϥ�������
case 'verify3d':
    // �����Ƚ��׽���
    $objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
    // �������ơ��֥���ɹ�
    $arrData = sfGetOrderTemp($uniqid);
    // �����Ƚ��פ򸵤˺ǽ��׻�
    $arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

    // ����+Ϳ���ꥯ�����Ȥ���������
    $obj3DForm = lfInit3DParam($_POST);
    $arrResults = lfSendRequest(lfCreateValidateParam($obj3DForm->getHashArray(), $arrData));
    if (PEAR::isError($e = lfIsError($arrResults))) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog(' -> error: ' . $e->getMessage(), MDL_CYBS_LOG);
        gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
        break;
    }

    $objSiteSess->setRegistFlag();
    header("Location: " . URL_SHOP_COMPLETE);
    break;

// ���ܥ��󲡲���
case 'return':
    $objSiteSess->setRegistFlag();
    header("Location: " . URL_SHOP_CONFIRM);
    exit;

// �̾�ɽ��
default:
    // TODO ����ǥޥ�ɼ���

}

$objView->assignobj($objPage);
$objView->display(SITE_FRAME);
sfPrintR($_POST, 'blue');
sfPrintR($objPage, 'red');
/**
 * �⡼�ɤ��������
 *
 * @return string
 */

function lfGetMode() {
    $mode = isset($_POST['mode']) ? $_POST['mode'] : '';

    // 3D�����奢������ѡ������ɲ�ҤΥѥ�������ϲ��̤������ܤ���
    $obj3dForm = lfInit3DParam($_POST);
    if (!$obj3dForm->checkError()) {
        $mode = 'verify3d';
    }

    return $mode;
}

/**
 * 3D�����奢����ѥѥ�᡼���ν����
 *
 * @param array $arrParam
 * @return SC_FormParam
 */
function lfInit3DParam($arrParam) {
    $objForm = new SC_FormParam;
    $objForm->addParam("PaRes", "PaRes", '', "", array("EXIST_CHECK"));
    $objForm->addParam("MD", "MD", '', "", array("EXIST_CHECK"));
    $objForm->setParam($arrParam);
    return $objForm;
}

/**
 * �ѥ�᡼���ν����
 *
 * @return SC_FormParam
 */
function lfInitParam($arrParam) {
    $objForm = new SC_FormParam;
    $objForm->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�����ɲ��", "card_company", 3, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objForm->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objForm->addParam("��", "card_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objForm->addParam("̾", "card_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objForm->addParam("��ʧ��ˡ", "paymethod", STEXT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
    $objForm->addParam("�����ɾ������Ͽ", "register_ondemand", 1, "n", array("NUM_CHECK", "MAX_LENGTH_CHECK"));
    $objForm->setParam($arrParam);
    $objForm->convParam();
    return $objForm;
}

/**
 * �����С��������˥ꥯ�����Ȥ���������.
 * �����������ѥ�᡼����lfCreateParam***()����������.
 *
 * @param array $arrSendParam
 * @return array
 */
function lfSendRequest($arrSendParam) {
    $objRequest = new CYBS_REQ;

    gfPrintLog('### send request param ###', MDL_CYBS_LOG);
    gfPrintLog(print_r($arrSendParam, true), MDL_CYBS_LOG);

    foreach ($arrSendParam as $key => $value) {
        $objRequest->add_request($key, $value);
    }

    if ( ($result = cybs_send($objRequest->requests)) == false ) {
        sfDispSiteError('');
        gfPrintLog(' -> error: cybs_send() function.' , MDL_CYBS_LOG);
    }

    return $result;
}

/**
 * ics_auth�ѥ�᡼�����ۤ���.
 *
 * @param array $arrForm
 * @param array $arrData
 */
function lfCreateAuthParam($arrForm, $arrData, $addData = null) {
    global $arrCybsRequestURL;
    global $arrPref;

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    $cardNo = $arrForm['card_no01'] . $arrForm['card_no02'] . $arrForm['card_no03'] . $arrForm['card_no04'];
    $expMo = $arrForm['card_month'];
    $expYr = '20' . $arrForm['card_year'];
    $phoneNo = $arrData['order_tel01'] . $arrData['order_tel02'] . $arrData['order_tel03'];

    $arrSendParam = array(
        "ics_applications"    => "ics_auth",
        "server_host"         => $arrCybsRequestURL[$arrConfig['cybs_request_url']],
        "server_port"         => "80",
        "card_type"           => $arrForm['card_company'],
        "customer_cc_number"  => $cardNo,
        "customer_cc_expmo"   => $expMo,
        "customer_cc_expyr"   => $expYr,
        "customer_firstname"  => lfToSjis($arrData['order_name02']),
        "customer_lastname"   => lfToSjis($arrData['order_name01']),
        "customer_email"      => $arrData['order_email'],
        "customer_phone"      => $phoneNo,
        "bill_address1"       => lfToSjis($arrData['order_addr02']),
        "bill_city"           => lfToSjis($arrData['order_addr01']),
        "bill_state"          => lfToSjis($arrPref[$arrData['order_pref']]),
        "bill_zip"            => $arrData['order_zip01'] . $arrData['order_zip02'],
        "bill_country"        => "JP",
        "merchant_id"         => $arrConfig['cybs_merchant_id'],
        "merchant_ref_number" => $arrData['order_id'],
        "currency"            => "JPY",
        /**
        "ship_to_address1"    => lfToSjis($arrData['deliv_addr02']),
        "ship_to_city"        => lfToSjis($arrData['deliv_addr01']),
        "ship_to_country"     => lfToSjis($arrPref[$arrData['deliv_pref']]),
        "ship_to_state"       => $arrData['deliv_zip01'] . $arrData['deliv_zip02'],
        "ship_to_zip"         => "JP",
        */
    );

    // ��ʧ����ˡ
    list($method, $paytimes) = split("-", $arrForm['paymethod']);
    $arrSendParam["jpo_payment_method"] = $method;

    // ʬ����
    if ($paytimes > 0) $arrSendParam["jpo_installments"] = $paytimes;

    $arrSendParam["offer0"] = "amount:" . $arrData['payment_total'];

    if (is_array($addData)) {
        $arrSendParam = array_merge($arrSendParam, $addData);
    }
    return $arrSendParam;
}

/**
 * ����ǥޥ�ɲݶ�+Ϳ���ꥯ�����ȥѥ�᡼�����ۤ���.
 *
 * @param string $subsId
 * @param array $arrAuthParam
 * @return array
 */
function lfCreateOndemandAuthParam($subsId, $arrAuthParam) {
    return array(
        'subscription_id'     => $subsId,
        "ics_applications"    => "ics_auth",
        "server_host"         => $arrAuthParam['server_host'],
        "server_port"         => $arrAuthParam["server_port"],
        'merchant_id'         => $arrAuthParam['merchant_id'],
        'merchant_ref_number' => $arrAuthParam['merchant_ref_number'],
        'currency'            => $arrAuthParam['currency'],
        'offer0'              => $arrAuthParam['offer0']
    );
}

/**
 * ics_pa_enroll�ѥ�᡼�����ۤ���.
 *
 * @param array $arrForm
 * @param array $arrData
 */
function lfCreateEnrollParam($arrForm, $arrData) {
    global $arrInfo;
    global $arrCybsRequestURL;

    $objCustomer = new SC_Customer;

    $cardNo  = $arrForm['card_no01'] . $arrForm['card_no02'] . $arrForm['card_no03'] . $arrForm['card_no04'];
    $expMo   = $arrForm['card_month'];
    $expYr   = '20' . $arrForm['card_year'];
    $phoneNo = $arrData['order_tel01'] . $arrData['order_tel02'] . $arrData['order_tel03'];

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    $arrSendParam = array(
        "ics_applications"    => "ics_pa_enroll",
        "server_host"         => $arrCybsRequestURL[$arrConfig['cybs_request_url']],
        "server_port"         => "80",
        'card_type'           => $arrForm['card_company'],
        'customer_account_id' => $objCustomer->getValue('customer_id'),
        "currency"            => "JPY",
        "customer_cc_expmo"   => $expMo,
        "customer_cc_expyr"   => $expYr,
        'customer_cc_number'  => $cardNo,
        "merchant_id"         => $arrConfig['cybs_merchant_id'],
        "merchant_ref_number" => $arrData['order_id'],
        'pa_http_accept'      => $_SERVER['HTTP_ACCEPT'],
        'pa_http_user_agent'  => $_SERVER['HTTP_USER_AGENT'],
        'pa_merchant_country_code' => 'JP',
        //'pa_merchant_id'      => $arrConfig['cybs_merchant_id'], // �����С��������Υޡ�������ID�Ȥ���
        'pa_merchant_name'    => lfToSjis($arrInfo['shop_name']),
        'pa_merchant_url'     => SSL_URL,
        'offer0'              => "amount:" . $arrData['payment_total']
    );
    return $arrSendParam;
}

/**
 * ics_pa_validate�ѥ�᡼�����ۤ���
 * ics_auth�ѥ�᡼���ȥޡ�������
 *
 * @param array $arrForm MD�ڤ�PaReq���ޤޤ������
 * @param array $arrData �������ǡ���
 * @return array
 */
function lfCreateValidateParam($arrForm, $arrData) {
    global $arrCybsRequestURL;
    $objCustomer = new SC_Customer;

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    $arrCardData = unserialize(base64_decode($arrForm['MD']));

    $arrSendParam = array(
        "server_host"         => $arrCybsRequestURL[$arrConfig['cybs_request_url']],
        "server_port"         => "80",
        'card_type'           => $arrCardData['card_company'],
        'customer_account_id' => $objCustomer->getValue('customer_id'),
        "currency"            => "JPY",
        "merchant_id"         => $arrConfig['cybs_merchant_id'],
        "merchant_ref_number" => $arrData['order_id'],
        'pa_signedpares'      => trim($arrForm['PaRes']),
        'offer0'              => "amount:" . $arrData['payment_total']
    );

    $arrSendParam = lfCreateAuthParam($arrCardData, $arrData, $arrSendParam);
    $arrSendParam["ics_applications"] = "ics_pa_validate,ics_auth";

    return $arrSendParam;
}

/**
 * ����ǥޥ�ɲݶ�Υѥ�᡼�����ۤ���
 *
 * @param array $arrForm �ե�����ѥ�᡼��(�����ɾ���ʤ�)
 * @param array $arrData �������ǡ���
 * @return array
 */

function lfCreateOndemandParam($arrForm, $arrData) {
    global $arrCybsRequestURL;
    global $arrPref;
    $objCustomer = new SC_Customer;

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    $cardNo = $arrForm['card_no01'] . $arrForm['card_no02'] . $arrForm['card_no03'] . $arrForm['card_no04'];
    $expMo = $arrForm['card_month'];
    $expYr = '20' . $arrForm['card_year'];
    $phoneNo = $arrData['order_tel01'] . $arrData['order_tel02'] . $arrData['order_tel03'];

    $arrSendParam = array(
        "ics_applications"    => "ics_pay_subscription_create",
        "server_host"         => $arrCybsRequestURL[$arrConfig['cybs_request_url']],
        "server_port"         => "80",
        "customer_account_id" => $objCustomer->getValue('customer_id'),
        "customer_cc_number"  => $cardNo,
        "customer_cc_expmo"   => $expMo,
        "customer_cc_expyr"   => $expYr,
        "customer_firstname"  => lfToSjis($arrData['order_name02']),
        "customer_lastname"   => lfToSjis($arrData['order_name01']),
        "customer_email"      => $arrData['order_email'],
        "customer_phone"      => $phoneNo,
        "bill_address1"       => lfToSjis($arrData['order_addr02']),
        "bill_city"           => lfToSjis($arrData['order_addr01']),
        "bill_state"          => lfToSjis($arrPref[$arrData['order_pref']]),
        "bill_zip"            => $arrData['order_zip01'] . $arrData['order_zip02'],
        "bill_country"        => "JP",
        "merchant_id"         => $arrConfig['cybs_merchant_id'],
        "merchant_ref_number" => $arrData['order_id'],
        "currency"            => "JPY",
        /**
        "ship_to_address1"    => lfToSjis($arrData['deliv_addr02']),
        "ship_to_city"        => lfToSjis($arrData['deliv_addr01']),
        "ship_to_country"     => lfToSjis($arrPref[$arrData['deliv_pref']]),
        "ship_to_state"       => $arrData['deliv_zip01'] . $arrData['deliv_zip02'],
        "ship_to_zip"         => "JP",
        */
        "recurring_disable_auto_auth" => 'Y',
        "recurring_frequency" => 'on-demand',
        "card_type"           => $arrForm['card_company'],
    );

    return $arrSendParam;
}


/**
 * �쥹�ݥ󥹤Υ��顼�����å�
 *
 * @param array $arrResults
 * @return boolean|PEAR::Error
 */
function lfIsError($arrResults) {
    global $arrIcsErr;
    $ret = null;

    switch ($arrResults['ics_rcode']) {
    // ����
    case '1':
        $ret = true;
        break;
    case '0':
        // 3D�����奢�ξ�硢ics_rflag��DAUTHENTICATE�Ǥ������Ͽ����
        if (isset($arrResults['pa_enroll_rflag'])
            && $arrResults['pa_enroll_rflag'] == 'DAUTHENTICATE') {

            $ret = true;
            break;
        }
        $msg = "���������ݤ���ޤ�����\n���顼�����ɡ�${arrResults['ics_rflag']}\n";
        $ret = PEAR::raiseError($msg);
        break;
    case '-1':
        $msg = "�����ƥ�ޤ��ϥͥåȥ�����顼�ˤ����������顼�Ȥʤ�ޤ�����\n���顼�����ɡ�${arrResults['ics_rflag']}\n";
        $ret = PEAR::raiseError($msg);
        break;
    default:
        $ret = PEAR::raiseError("�����ʥ��顼��ȯ�����ޤ�����\n");
    }

    return $ret;
}

/**
 * SJIS���Ѵ�����
 *
 * @param string $str
 * @return string
 */
function lfToSjis($str) {
    return mb_convert_encoding($str, 'SJIS', CHAR_CODE);
}

/**
 * ���Ͼ���������Ͽ
 *
 * @param string $uniqid
 * @param array $arrForm
 */
function lfRegisterOrderTemp($uniqid, $arrForm, $arrResults) {
    $sqlval = array();
    $sqlval['memo03'] = $arrForm['card_name01'] . " " . $arrForm['card_name02'];
    //$sqlval['memo02'] = serialize($arrResults['auth_auth_code']);

    $objQuery = new SC_Query;
    $objQuery->update("dtb_order_temp", $sqlval, "order_temp_id = ?", array($uniqid));
}
?>
