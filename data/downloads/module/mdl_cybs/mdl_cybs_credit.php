<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once MODULE_PATH . "mdl_cybs/mdl_cybs.inc";

// ��Х���ϥ��顼����ɽ��
if (GC_MobileUserAgent::isMobile()) {
    sfDispSiteError(
        FREE_ERROR_MSG,
        '',
        false,
        '���η�Ѥϻ��Ѥ��뤳�Ȥ�����ޤ���<br>������Ǥ�������ʧ����ˡ������ľ���Ʋ�������',
        true);
}

// extension�����󥹥ȡ��뤵��Ƥ��ʤ���Х��顼����ɽ��
if (!sfCybsLoadModCybs()) {
    sfDispSiteError(FREE_ERROR_MSG, '', false,
        '���η�Ѥϻ��Ѥ��뤳�Ȥ�����ޤ���<br>������Ǥ�������ʧ����ˡ������ľ���Ʋ�������');
}

class LC_Page {
    function LC_Page() {
        $this->tpl_css      = URL_DIR . 'css/layout/shopping/confirm.css';
        $this->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs_credit.tpl';
        // ��ʧ����ˡ
        global $arrCybsPayMethod;
        $this->arrPayMethod = $arrCybsPayMethod;
        // �����ɲ�Ҽ���
        global $arrCybsCardCompany;
        $this->arrCardCompany = $arrCybsCardCompany;
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
$objPage->enable_ondemand = $objCybs->enableOndemand(); // ����ǥޥ�ɲݶ�λ��Ѳ���
$objPage->can_add_subsid  = $objCybs->canAddSubsId();   // ��������Ͽ����¤�Ƚ��

$objPage->tpl_payment_method = '�����С����������';

$objDate = new SC_Date();
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(RELEASE_YEAR + CREDIT_ADD_YEAR);
$objPage->arrYear = $objDate->getZeroYear();
$objPage->arrMonth = $objDate->getZeroMonth();

// �桼����ˡ���ID�μ����ȹ������֤�������������å�
$uniqid = sfCheckNormalAccess($objSiteSess, $objCartSess);

// �����Ƚ��׽���
$objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
// �������ơ��֥���ɹ�
$arrData = sfGetOrderTemp($uniqid);
// �����Ƚ��פ򸵤˺ǽ��׻�
$arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

$objForm = lfInitParam($_POST);
$objPage->arrForm = $objForm->getFormParamList();

$objCybs->deleteSubsId(200);

switch(lfGetMode()) {

case 'register':
    // ���Ϲ��ܤθ���
    if ($arrErr = $objForm->checkError()) {
        $objPage->arrErr = $arrErr;
        break;
    }

    $authAddParam = null; // ���㡼���Хå����ɲåѥ�᡼��

    // 3D�����奢��������Ƚ��
    if ($objCybs->use3D() && lfIs3DCard($objForm->getValue('card_company'))) {
        // 3D�����奢�ꥯ�����Ȥ���������
        $arrResults = sfCybsSendRequest(lfCreateEnrollParam($objForm->getHashArray(), $arrData));
        // ���顼����
        if (PEAR::isError($e = sfCybsIsError($arrResults))) {
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

    $arrSendParam = lfCreateAuthParam($objForm->getHashArray(), $arrData, $authAddParam);
    /**
     * ����ǥޥ�ɲݶ⤬ͭ���ǡ����ĥ����ɤ���Ͽ����˥����å������äƤ������ϡ�
     * ���֥�����ץ��������ѥ�᡼�����ɲä���
     */
    if ($objCybs->enableOndemand() && $objForm->getValue('register_ondemand')) {
        //$arrSendParam = lfCreateAuthParam($objForm->getHashArray(), $arrData);
        //$arrSendParam = lfCreateOndemandAuthParam($subsId, $arrSendParam);
        // ��Ͽ����Υ����å�
        if (!$objCybs->canAddSubsId()) {
            $objPage->tpl_error = '��Ͽ����륫���ɤη����' . MDL_CYBS_SUBS_ID_MAX . "��ޤǤǤ���\n";
            gfPrintLog(' -> ondemand error: over card max ', MDL_CYBS_LOG);
            break;
        }
        $arrSendParam['ics_applications']           .= ',ics_pay_subscription_create';
        $arrSendParam['recurring_disable_auto_auth'] = 'Y';
        $arrSendParam['recurring_frequency']         = 'on-demand';
        $arrSendParam['card_type']                   = $objForm->getValue('card_company');
    }

    // Ϳ���ꥯ�����Ȥ���������
    $arrResults = sfCybsSendRequest($arrSendParam);
    if (PEAR::isError($e = sfCybsIsError($arrResults))) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog(' -> auth error: ' . $e->getMessage(), MDL_CYBS_LOG);
        gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
        break;
    }

    // ���֥�����ץ����ID��ܵҥơ��֥���ɲä���
    if (isset($arrResults['pay_subscription_create_subscription_id'])) {
        $objCybs->addSubsId($arrResults['pay_subscription_create_subscription_id'], $arrResults['merchant_ref_number']);
    }

    $objSiteSess->setRegistFlag();
    lfRegisterOrderTemp($uniqid, $arrResults, $objForm->getHashArray());
    header("Location: " . URL_SHOP_COMPLETE);
    exit;
    break;

// ��Ͽ�����ɤλ���
case 'ondemand':
    // ���Ϲ��ܤθ���
    $subsId = $objForm->getValue('subs_id');
    $paymethod = $objForm->getValue('ondemand_paymethod');
    $arrErr = $objForm->checkError();
    if (empty($subsId) || !empty($arrErr['subs_id'])) {
        $objPage->arrErr['subs_id'] = '�������Ѥ��륫���ɤ����򤷤Ʋ�������';
        break;
    }
    if (empty($paymethod) || !empty($arrErr['ondemand_paymethod'])) {
        $objPage->arrErr['ondemand_paymethod'] = '��������ʧ����ˡ�����򤷤Ʋ�������';
        break;
    }
    $arrForm = $objForm->getHashArray();
    $arrForm['paymethod'] = $paymethod;

    $arrSendParam = lfCreateAuthParam($arrForm, $arrData);
    $arrSendParam = lfCreateOndemandAuthParam($subsId, $arrSendParam);
    $arrResults = sfCybsSendRequest($arrSendParam);
    if (PEAR::isError($e = sfCybsIsError($arrResults))) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog(' -> auth error: ' . $e->getMessage(), MDL_CYBS_LOG);
        gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
        break;
    }

    $objSiteSess->setRegistFlag();
    lfRegisterOrderTemp($uniqid, $arrResults, $arrForm);
    header("Location: " . URL_SHOP_COMPLETE);
    exit;
    break;

// �ѥ�������Ϥ�������
case 'verify3d':
    // ����+Ϳ���ꥯ�����Ȥ���������
    $obj3DForm = lfInit3DParam($_POST);
    $arrResults = sfCybsSendRequest(lfCreateValidateParam($obj3DForm->getHashArray(), $arrData));
    if (PEAR::isError($e = sfCybsIsError($arrResults))) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog(' -> error: ' . $e->getMessage(), MDL_CYBS_LOG);
        gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
        break;
    }

    $objSiteSess->setRegistFlag();
    $arrForm = unserialize(base64_decode($arrResults['MD']));
    lfRegisterOrderTemp($uniqid,  $arrResults, $arrForm);
    header("Location: " . URL_SHOP_COMPLETE);
    exit;
    break;

// �����ɤκ��
case 'delete':
    // ���Ϲ��ܤθ���
    $index = $objForm->getValue('delete_subs_index');
    if (isset($index) && is_numeric($index)) {
        $objCybs->deleteSubsId($index);
    }
    break;

// ���ܥ��󲡲���
case 'return':
    $objSiteSess->setRegistFlag();
    header("Location: " . URL_SHOP_CONFIRM);
    exit;

// �̾�ɽ��
default:
}

lfSetCybsCardInfo($objPage); // ��Ͽ�Ѥߥ����ɾ���򥻥åȤ���

$objView->assignobj($objPage);
$objView->display(SITE_FRAME);

function lfSetCybsCardInfo(&$objPage) {
    $objCybs =& Mdl_Cybs_Config::getInstanse();
    // ����ǥޥ�ɲݶ⤬̵���ʤ�return
    if (!$objCybs->enableOndemand()) {
        return;
    }

    // ���֥�����ץ����ID�����
    $arrSubsIds = $objCybs->getSubsIds();

    $objPage->cardCount = 0; // ���֥�����ץ�������Ͽ���

    foreach ($arrSubsIds as $subs) {
        $arrSendParam = lfCreateOndemandRetParam($subs['subs_id'], $subs['merchant_ref_number']);
        $arrResults = sfCybsSendRequest($arrSendParam);

        if (PEAR::isError($e = sfCybsIsError($arrResults))) {
            $objPage->tpl_error = $e->getMessage();
            gfPrintLog(' -> get subs info error: ' . $e->getMessage(), MDL_CYBS_LOG);
            gfPrintLog(print_r($arrResults, true), MDL_CYBS_LOG);
            return;
        }
        $objPage->cardCount++;
        $objPage->arrCard[] = $arrResults; // �����ɾ����ƥ�ץ졼�Ȥ�assign
    }
}

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
    $objForm->addParam("���Ѥ��륫����", "subs_id", MTEXT_LEN, "n", array("NUM_CHECK", "MAX_LENGTH_CHECK"));
    $objForm->addParam("���������", "delete_subs_index", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objForm->setParam($arrParam);
    $objForm->convParam();
    return $objForm;
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
    $arrSendParam = array(
        'subscription_id'     => $subsId,
        "ics_applications"    => "ics_auth",
        "server_host"         => $arrAuthParam['server_host'],
        "server_port"         => $arrAuthParam["server_port"],
        'merchant_id'         => $arrAuthParam['merchant_id'],
        'merchant_ref_number' => $arrAuthParam['merchant_ref_number'],
        'currency'            => $arrAuthParam['currency'],
        'offer0'              => $arrAuthParam['offer0'],
        'jpo_payment_method'  => $arrAuthParam['jpo_payment_method'],
    );

    // ʬ����
    if (isset($arrAuthParam["jpo_installments"])) {
        $arrSendParam['jpo_installments'] = $arrAuthParam['jpo_installments'];
    }
    return $arrSendParam;
}

function lfCreateOndemandRetParam($subsId, $merchant_ref_number) {
    global $arrCybsRequestURL;

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    return array(
        'subscription_id'     => $subsId,
        "ics_applications"    => "ics_pay_subscription_retrieve",
        "server_host"         => $arrCybsRequestURL[$arrConfig['cybs_request_url']],
        "server_port"         => "80",
        'merchant_id'         => $arrConfig['cybs_merchant_id'],
        'merchant_ref_number' => $merchant_ref_number,
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
        //'pa_merchant_id'      => $arrConfig['cybs_merchant_id'],
        'pa_merchant_name'    => lfToSjis($arrInfo['shop_name']),
        'pa_merchant_url'     => SSL_URL,
    );

    $arrSendParam["offer0"] = "amount:" . $arrData['payment_total'];

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
    );

    $arrSendParam["offer0"] = "amount:" . $arrData['payment_total'];

    $arrSendParam = lfCreateAuthParam($arrCardData, $arrData, $arrSendParam);
    $arrSendParam["ics_applications"] = "ics_pa_validate,ics_auth";

    return $arrSendParam;
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
function lfRegisterOrderTemp($uniqid, $arrResults, $arrForm) {
    $sqlval = array(
        'memo06' => MDL_CYBS_AUTH_STATUS_AUTH,
        'memo07' => $arrResults['request_token'],
        'memo08' => $arrResults['request_id'],
        'memo09' => $arrForm['paymethod']
        //'memo10' => $arrResults[''],
    );
    $objQuery = new SC_Query;
    $objQuery->update("dtb_order_temp", $sqlval, "order_temp_id = ?", array($uniqid));
}

/**
 * 3D�б������ɤ��ɤ���������å�����
 *
 * @param�����ɼ��� $cardtype
 * @return boolean
 */
function lfIs3DCard($cardtype) {
    $arrCardType = array('001', '002', '007');
    if (in_array($cardtype, $arrCardType)) {
        return true;
    }
    return false;
}
?>
