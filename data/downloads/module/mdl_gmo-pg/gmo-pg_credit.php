<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once(MODULE_PATH . "mdl_gmo-pg/mdl_gmo-pg.inc");

class LC_Page {
    function LC_Page() {
        $this->tpl_css = '/css/layout/shopping/card.css';

        if (GC_MobileUserAgent::isMobile()) {
            $this->tpl_mainpage = MODULE_PATH . "mdl_gmo-pg/gmo-pg_credit_mobile.tpl";
        } else {
            $this->tpl_mainpage = MODULE_PATH . "mdl_gmo-pg/gmo-pg_credit.tpl";
        }
        global $arrPayMethod;
        $this->arrPayMethod = $arrPayMethod;

        /**
         * session_start����no-cache�إå������������뤳�Ȥ�
         * �����ץܥ�����ѻ���ͭ�������ڤ�ɽ�����������롣
         * private-no-expire:���饤����ȤΥ���å������Ĥ��롣
         */
        session_cache_limiter('private-no-expire');
    }
}

$objPage = new LC_Page();
$objView = GC_MobileUserAgent::isMobile() ? new SC_MobileView() : new SC_SiteView();
$objSiteSess = new SC_SiteSession();
$objCartSess = new SC_CartSession();
$arrInfo     = sf_getBasisData();
$arrGMOConf  = sfGetPaymentDB();

// ������������������Ƚ��
$uniqid = sfCheckNormalAccess($objSiteSess, $objCartSess);

// �ѥ�᡼���������饹
$objFormParam = lfInitParam();

switch(lfGetMode()) {
// �ּ��ءץܥ��󲡲���
case 'regist':
    gfPrintLog('### GMO PG MODULE Start ###', GMO_LOG_PATH);
    // �����ͤ��Ѵ�
    $objFormParam->convParam();
    $arrErr = $objFormParam->checkError();

    // ���ϥ��顼��Ƚ��
    if (!empty($arrErr)) {
        $objPage->arrErr = $arrErr;
        break;
    }

    // �����Ƚ��׽���
    $objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);
    // �������ơ��֥���ɹ�
    $arrData = sfGetOrderTemp($uniqid);
    // �����Ƚ��פ򸵤˺ǽ��׻�
    $arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);
    // POST�ǡ��������
    $arrVal = $objFormParam->getHashArray();

    // ���顼�ե饰
    $err_flg = false;
    // �̿����顼��Ƚ��
    $access_err = false;
    // Ź�޾��󥨥顼��Ƚ��
    $credit_err = false;
    // ���顼��å�����
    $gmo_err_msg = "";

    // ��������ID�����åȤ���Ƥ��ʤ���硢EntryTrain�إꥯ�����Ȥ���������
    if(empty($_SESSION['GMO']['ACCESS_ID'])) {
        gfPrintLog('-> EntryTrain Start.', GMO_LOG_PATH);
        // Ź�޾��������
        $arrEntryRet = lfSendGMOEntry($arrData['order_id'], $arrData['payment_total']);
        if (empty($arrEntryRet)) {
            gfPrintLog('-> EntryTrain failed. access error.', GMO_LOG_PATH);
            $access_err = true;
        }

        // Ź�޾��󥨥顼��Ƚ��
        if ($arrEntryRet['ERR_CODE'] == '0' && $arrEntryRet['ERR_INFO'] == 'OK') {
            gfPrintLog('-> EntryTrain success.', GMO_LOG_PATH);
            $_SESSION['GMO']['ACCESS_ID'] = $arrEntryRet['ACCESS_ID'];
            $_SESSION['GMO']['ACCESS_PASS'] = $arrEntryRet['ACCESS_PASS'];
        } else {
            gfPrintLog('-> EntryTrain failed. credit error.', GMO_LOG_PATH);
            unset($_SESSION['GMO']);
            $credit_err = true;
            $detail_code01 = substr($arrEntryRet['ERR_INFO'], 0, 5);
            $detail_code02 = substr($arrEntryRet['ERR_INFO'], 5, 4);
            $gmo_err_msg = $detail_code01 . "-" . $detail_code02;
        }
    }

    // EntryTrain�ǥ��顼�ʤ��ξ���ExecTrain��¹Ԥ���
    if(!$access_err && !$credit_err) {
        gfPrintLog('-> ACESS_ID check Start.', GMO_LOG_PATH);
        // Ź�޾����������
        $sqlval['memo04'] = $arrEntryRet['ERR_CODE'];
        $sqlval['memo05'] = $arrEntryRet['ERR_INFO'];

        // Ź�޾��󥨥顼��Ƚ��
        if(!empty($_SESSION['GMO']['ACCESS_ID']) && !empty($_SESSION['GMO']['ACCESS_PASS'])) {
            gfPrintLog('-> ACESS_ID check OK.', GMO_LOG_PATH);
            gfPrintLog('-> ExecTrain Start.', GMO_LOG_PATH);
            // ��Ѿ��������
            $arrExecRet = lfSendGMOExec(
                $_SESSION['GMO']['ACCESS_ID'],
                $_SESSION['GMO']['ACCESS_PASS'],
                $arrData['order_id'],
                $arrVal['card_no01'],
                $arrVal['card_no02'],
                $arrVal['card_no03'],
                $arrVal['card_no04'],
                $arrVal['card_month'],
                $arrVal['card_year'],
                $arrVal['paymethod']
            );
            if (empty($arrExecRet)) {
                gfPrintLog('-> ExecTrain failed. access error.', GMO_LOG_PATH);
                $access_err = true;
            } else {
                gfPrintLog('-> ExecTrain success.', GMO_LOG_PATH);
            }
        } else {
            gfPrintLog('-> ACESS_ID check failed.', GMO_LOG_PATH);
        }
    }

    // ExecTrain���̿����顼�ʤ��ξ��
    if (!$access_err && !$credit_err) {
        // 3D�����奢��ͭ���ʾ��ϥ�����쥯�ȥڡ�������Ϥ���
        if (lfEnable3D()) {
            gfPrintLog('-> 3D secure is enable.', GMO_LOG_PATH);
            $_SESSION['GMO']['3d']['memo'] = array(
                'memo02' => serialize(array()),
                'memo03' => $arrVal['card_name01'] . " " . $arrVal['card_name02'],
            );

            $objPage->tpl_onload = 'OnLoadEvent();';
            // TODO mobile
            $objPage->tpl_mainpage = MODULE_PATH . "mdl_gmo-pg/gmo-pg-3d.tpl";
            $objPage->ACSUrl = $arrExecRet['ACSUrl'];
            $objPage->PaReq = $arrExecRet['PaReq'];;
            $objPage->TermUrl = GMO_RETURL;
            $objPage->MD = $arrExecRet['MD'];
            break;

        // 3D�����奢̵�����ϡ����顼�����å���������λ�ڡ����إ�����쥯��
        } else {
            gfPrintLog('-> 3D secure is not enable.', GMO_LOG_PATH);
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
            if($arrExecRet['Html'] == "Receipt" && empty($arrExecRet['ErrType']) && empty($arrExecRet['ErrInfo'])) {
                gfPrintLog('-> ExecTrain results success.', GMO_LOG_PATH);
                // �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
                $objSiteSess->setRegistFlag();
                // ��������ID�򥯥ꥢ���롣
                unset($_SESSION['GMO']);
                // ������λ�ڡ�����
                if (GC_MobileUserAgent::isMobile()) {
                    header("Location: " . gfAddSessionId(URL_SHOP_COMPLETE));
                } else {
                    header("Location: " . URL_SHOP_COMPLETE);
                }
            } else {
                gfPrintLog('-> ExecTrain results error.', GMO_LOG_PATH);
                $credit_err = true;
                $detail_code01 = substr($arrExecRet['ErrInfo'], 0, 5);
                $detail_code02 = substr($arrExecRet['ErrInfo'], 5, 4);
                $gmo_err_msg = $detail_code01 . "-" . $detail_code02;
            }
        }
    }

    if($access_err || $credit_err) {
        if ($access_err) {
            $objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ������̿����顼";
        } else {
            if (!empty($gmo_err_msg)) {
                $objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ�����" . $gmo_err_msg;
            } else {
                $objPage->tpl_error = "�� ���쥸�åȾ�ǧ�˼��Ԥ��ޤ����������ʥ��顼";
            }
        }
    }

    break;

// 3Dǧ�ڷ�̤�������
case '3dVerify':
    gfPrintLog('-> 3D secure Post param check start.', GMO_LOG_PATH);
    if (PEAR::isError($e = lfValidate3dVerify())) {
        $objPage->tpl_error = $e->getMessage();
        gfPrintLog('-> 3D secure Post param check error.', GMO_LOG_PATH);
        break;
    }
    gfPrintLog('-> 3D secure Post param check success.', GMO_LOG_PATH);
    gfPrintLog('-> 3dVerify start.', GMO_LOG_PATH);
    $arr3dRet = lfSend3dVerify();

    if (PEAR::isError($e = lf3dVerifyIsSuccess($arr3dRet))) {
        gfPrintLog('-> 3dVerify failed. ' . $e->getMessage(), GMO_LOG_PATH);
        $objPage->tpl_error = $e->getMessage();
        break;
    }
    gfPrintLog('-> 3dVerify success.', GMO_LOG_PATH);

    //
    $sqlval = $_SESSION['GMO']['3d']['memo'];

    // ��Ѿ����������
    $sqlval['memo06'] = $arr3dRet['ErrType'];
    $sqlval['memo07'] = $arr3dRet['ErrInfo'];

    $objQuery = new SC_Query();
    $objQuery->update("dtb_order_temp", $sqlval, "order_temp_id = ?", array($uniqid));

    // �������Ͽ���줿���Ȥ�Ͽ���Ƥ���
    $objSiteSess->setRegistFlag();
    // GMO�ѤΥ��å�������򥯥ꥢ���롣
    unset($_SESSION['GMO']);
    // ������λ�ڡ�����
    if (GC_MobileUserAgent::isMobile()) {
        header("Location: " . gfAddSessionId(MOBILE_URL_SHOP_COMPLETE));
    } else {
        header("Location: " . URL_SHOP_COMPLETE);
    }

break;

// ��ǧ�ڡ��������
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

/**
 * mode���������.
 *
 * @retrun string
 */
function lfGetMode() {
    $mode = '';

    if (isset($_POST['PaRes']) && isset($_POST['MD'])) {
        $mode = '3dVerify';
    } elseif (isset($_POST['mode'])) {
        $mode = $_POST['mode'];
    }

    return $mode;
}

/**
 * �ѥ�᡼������ν����
 *
 * @return SC_FormParam
 */
function lfInitParam() {
    $objFormParam = new SC_FormParam();
    $objFormParam->addParam("�������ֹ�1", "card_no01", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�������ֹ�2", "card_no02", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�������ֹ�3", "card_no03", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�������ֹ�4", "card_no04", CREDIT_NO_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�����ɴ���ǯ", "card_year", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�����ɴ��·�", "card_month", 2, "n", array("EXIST_CHECK", "NUM_COUNT_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("��", "card_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objFormParam->addParam("̾", "card_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "ALPHA_CHECK"));
    $objFormParam->addParam("��ʧ��ˡ", "paymethod", STEXT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));

    $objFormParam->setParam($_POST);

    return $objFormParam;
}

/**
 * ����������Ͽ����.
 *
 * @param integer $order_id
 * @param integer $amount
 * @param integer $tax
 * @return array
 */
function lfSendGMOEntry($order_id, $amount, $tax = 0) {
    $arrGMOConf = sfGetPaymentDB();

    $TdTenantName = '';
    // 3D�����奢��ͭ���ʾ��ϡ�Ź��̾�����ꤹ��
    if (!empty($arrGMOConf[0]['gmo_3d'])) {
        $arrSiteInfo = sf_getBasisData();
        $TdTenantName = base64_encode($arrSiteInfo['shop_name']);
    }

    $arrSendData = array(
        'OrderId' => $order_id,                      // Ź�ޤ��Ȥ˰�դ���ʸID���������롣
        'TdTenantName' => $TdTenantName,             // 3Dǧ�ڻ�ɽ����Ź��̾
        'TdFlag' => $arrGMOConf[0]['gmo_3d'],        // 3D�ե饰
        'ShopId' => $arrGMOConf[0]['gmo_shopid'],    // ����å�ID
        'ShopPass' => $arrGMOConf[0]['gmo_shoppass'],// ����åץѥ����
        'Currency' => 'JPN',                         // �̲ߥ�����
        'Amount' => $amount,                         // ���
        'Tax' => $tax,                               // ������
        'JobCd' => 'AUTH',                           // ������ʬ
        'TenantNo' => $arrGMOConf[0]['gmo_tenantno'],// Ź��ID���������롣
    );
gfPrintLog('EntryTrain Request', GMO_LOG_PATH);
gfPrintLog(print_r($arrSendData, true), GMO_LOG_PATH);
    $req = new HTTP_Request(GMO_ENTRY_URL);
    $req->setMethod(HTTP_REQUEST_METHOD_POST);
    $req->addPostDataArray($arrSendData);

    if (!PEAR::isError($req->sendRequest())) {
        $respBody = $req->getResponseBody();
    }
gfPrintLog('EntryTrain Response', GMO_LOG_PATH);
gfPrintLog(print_r(lfGetPostArray($respBody), true), GMO_LOG_PATH);
    return lfGetPostArray($respBody);
}

/**
 * ��Ѥμ¹�
 *
 * @param string $access_id
 * @param string $access_pass
 * @param integer $order_id
 * @param integer $cardno1
 * @param integer $cardno2
 * @param integer $cardno3
 * @param integer $cardno4
 * @param integer $ex_mm
 * @param integer $ex_yy
 * @param integer $paymethod
 * @return array
 */
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
        'CardType' => 'VISA, 11111, 111111111111111111111111111111111111, 1111111111',
        'Method' => $method,
        'PayTimes' => $paytimes,
        'CardNo' => $cardno1 . $cardno2 . $cardno3 . $cardno4,
        'ExpireYYMM' => $ex_yy . $ex_mm ,
        'ClientFieldFlag' => '1',
        'ClientField1' => 'f1',
        'ClientField2' => 'f2',
        'ClientField3' => 'f3',
        'ModiFlag' => '1',
        'HTTP_ACCEPT' => $_SERVER['HTTP_ACCEPT'],
        'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']
    );
gfPrintLog('ExecTrain Request', GMO_LOG_PATH);
gfPrintLog(print_r($arrData, true), GMO_LOG_PATH);
    $req = new HTTP_Request(GMO_EXEC_URL);
    $req->setMethod(HTTP_REQUEST_METHOD_POST);

    $req->addPostDataArray($arrData);

    if (!PEAR::isError($req->sendRequest())) {
        $response = $req->getResponseBody();
    }

    $arrRet = lfParseExecResponse($response);
gfPrintLog('ExecTrain Response', GMO_LOG_PATH);
gfPrintLog(print_r($arrRet, true), GMO_LOG_PATH);
gfPrintLog($response, GMO_LOG_PATH);
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

function lfParseExecResponse($queryString) {
    // 3D�����奢�Ǥʤ�����lfGetPostArray()��parse����
    if (!lfEnable3D()) {
        return lfGetPostArray($queryString);
    }

    $arrRet = array();
    // 3D�����奢����Ѥ����������ɽ���ǡ�
    if (!empty($queryString)) {
        $queryString = trim($queryString);
        $regex = '|^ACSUrl\=(.+?)&PaReq\=(.+?)&MD\=(.+?)$|';
        $ret = preg_match_all($regex, $queryString, $matches);

        gfPrintLog(print_r($matches, true), GMO_LOG_PATH);

        if ($ret !== false && $ret > 0) {
            gfPrintLog('REG STATUS:' . $ret, GMO_LOG_PATH);
            $arrRet['ACSUrl'] = $matches[1][0];
            $arrRet['PaReq']  = $matches[2][0];
            $arrRet['MD']     = $matches[3][0];
        } else {
            gfPrintLog(' STATUS:Failed', GMO_LOG_PATH);
        }
    }

    return $arrRet;
}


/**
 * 3D�٥�ե������Υꥯ�����ȥѥ�᡼���򸡾ڤ���
 *
 * @return array
 */
function lfValidate3dVerify() {

}
/**
 * 3D�٥�ե�����¹Ԥ���
 *
 * @return array
 */
function lfSend3dVerify() {
    $arrSendData = array(
        'PaRes' => $_POST['PaRes'],
        'MD'    => $_POST['MD']
    );
    $objReq =& new HTTP_Request(GMO_3D_URL);
    $objReq->setMethod('POST');
    $objReq->addPostDataArray($arrSendData);

    $respBody = '';

    if (!PEAR::isError($objReq->sendRequest())) {
        $respBody = $objReq->getResponseBody();
    }
gfPrintLog('##############POST PARAM###############', GMO_LOG_PATH);
gfPrintLog(print_r($_POST, true), GMO_LOG_PATH);

    return lfGetPostArray($respBody);
}

/**
 * 3D�٥�ե����μ¹Է�̤�Ƚ�ꤹ��
 *
 * @param array $arr3dRet
 * @return boolean|PEAR::ERROR ������:true|���Ի�:PEAR::ERROR���֥�������
 */
function lf3dVerifyIsSuccess($arr3dRet) {
    // �̿����顼
    if (empty($arr3dRet)) {
        return PEAR::raiseError('�̿����顼��ȯ�����ޤ�����');
    }

    // SSL̤�б�����
    if (!is_array($arr3dRet)) {
        return PEAR::raiseError('�̿����顼��ȯ�����ޤ�����');
    }

    // ����
    if ($arr3dRet['Html'] == "Receipt"
        && empty($arr3dRet['ErrType'])
        && empty($arr3dRet['ErrInfo'])) {

        return true;

    // ����
    } else {
        $detail_code01 = substr($arr3dRet['ErrInfo'], 0, 5);
        $detail_code02 = substr($arr3dRet['ErrInfo'], 5, 4);
        $gmo_err_msg = $detail_code01 . "-" . $detail_code02;
        gfPrintLog(print_r($arr3dRet, true), GMO_LOG_PATH);
        return PEAR::raiseError('�̿����顼��ȯ�����ޤ��������顼�����ɡ�' . $gmo_err_msg);
    }
}

/**
 * 3D�����奢��ͭ�����ɤ�����Ƚ�ꤹ��.
 * ��Х����GMO¦��̤�б��Τ��ᡢUserAgetnt����Х�����ˤ�3D�����奢̵���ȸ��ʤ�
 *
 * @return unknown
 */
function lfEnable3D() {
    global $arrGMOConf;

    if (isset($arrGMOConf[0]['gmo_3d'])
        && $arrGMOConf[0]['gmo_3d'] == '1'
        && GC_MobileUserAgent::isMobile() == false) {

        return true;
    }

    return false;
}
?>
