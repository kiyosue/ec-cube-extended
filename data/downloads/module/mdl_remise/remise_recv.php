<?php
/**
 *
 * @copyright   2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 * @version CVS: $Id$
 * @link        http://www.lockon.co.jp/
 *
 */
require_once '../require.php';
require_once MODULE_PATH . "mdl_remise/mdl_remise.inc";

if (REMISE_IP_ADDRESS_DENY == 1) {
    if (!isset($_SERVER["REMOTE_ADDR"]) || !lfIpAddressDenyCheck($_SERVER["REMOTE_ADDR"])) {
        print("NOT REMISE SERVER");
        exit;
    }
}

switch (lfGetMode()) {
case 'credit_complete':
    // ��ߡ��������ɥ��쥸�åȷ�ѷ�����ν���
    lfRemiseCreditResultCheck();
    break;

case 'conveni_mobile_complete':
    // ��Х��봰λ�ƥ�ץ졼��
    lfRemiseConveniComplete();
    break;

case 'conveni_check':
    // ����ӥ���������å�
    lfRemiseConveniCheck();
    break;

default:
    break;
}

//-------------------------------------------------------------------------------------------------------
function lfGetMode() {
    $mode = '';
    if (isset($_POST["X-TRANID"]) && isset($_POST["X-PARTOFCARD"])) {
        $mode = 'credit_complete';

    // ��Х��륳��ӥ˴�λ�ƥ�ץ졼��
    } elseif (isset($_POST['X-JOB_ID'])) {
        $mode = 'conveni_mobile_complete';

    // ����ӥ������ǧ
    } elseif (isset($_POST["JOB_ID"]) && isset($_POST["REC_FLG"]) && REMISE_CONVENIENCE_RECIVE == 1) {
        $mode = 'conveni_check';
    }
    return $mode;
}
// ��ߡ��������ɥ��쥸�åȷ�ѷ�����ν���
function lfRemiseCreditResultCheck(){
    $objQuery = new SC_Query;

    $log_path = DATA_PATH . "logs/remise_card_result.log";
    gfPrintLog("remise card result : ".$_POST["X-TRANID"] , $log_path);

    // TRAN_ID ����ꤵ��Ƥ��ơ������ɾ��󤬤�����
    if (isset($_POST["X-TRANID"]) && isset($_POST["X-PARTOFCARD"])) {

        $errFlg = FALSE;

        gfPrintLog("remise card result start----------", $log_path);
        foreach($_POST as $key => $val){
            gfPrintLog( "\t" . $key . " => " . $val, $log_path);
        }
        gfPrintLog("remise credit result end  ----------", $log_path);

        // IP���ɥ쥹���椹����
        if (REMISE_IP_ADDRESS_DENY == 1) {
            gfPrintLog("remise remoto ip address : ".$_SERVER["REMOTE_HOST"]."-".$_SERVER["REMOTE_ADDR"], $log_path);
            if (!isset($_SERVER["REMOTE_ADDR"]) || !lfIpAddressDenyCheck($_SERVER["REMOTE_ADDR"])) {
                print("NOT REMISE SERVER");
                exit;
            }
        }

        // �����ֹ�ȶ�ۤμ���
        $order_id = 0;
        $payment_total = 0;

        if (isset($_POST["X-S_TORIHIKI_NO"])) {
            $order_id = $_POST["X-S_TORIHIKI_NO"];
        }

        if (isset($_POST["X-TOTAL"])) {
            $payment_total = $_POST["X-TOTAL"];
        }

        gfPrintLog("order_id : ".$order_id, $log_path);
        gfPrintLog("payment_total : ".$payment_total, $log_path);

        // ��ʸ�ǡ�������
        $arrTempOrder = $objQuery->getall("SELECT payment_total FROM dtb_order_temp WHERE order_id = ? ", array($order_id));

        // ��ۤ����
        if (count($arrTempOrder) > 0) {
            gfPrintLog("ORDER payment_total : ".$arrTempOrder[0]['payment_total'], $log_path);
            if ($arrTempOrder[0]['payment_total'] == $payment_total) {
                $errFlg = TRUE;
            }
        }

        if ($errFlg) {
            // ��Х���ξ��ϡ�������λ������Ԥ�
            $arrCarier = array('imode', 'ezweb', 'jsky');
            if (isset($_POST["CARIER_TYPE"]) && in_array($_POST["CARIER_TYPE"], $arrCarier)) {
                gfPrintLog("Mobile Complete Start", $log_path);
                if (lfMobileComplete(REMISE_PAY_TYPE_CREDIT)) {
                    gfPrintLog("Mobile Complete Success", $log_path);
                    print(REMISE_PAYMENT_CHARGE_OK_MOBILE);
                } else {
                    gfPrintLog("Mobile Complete Error", $log_path);
                    print("ERROR");
                }
                gfPrintLog("Mobile Complete End", $log_path);
                exit;
            }

            // PC�ǤϹ�����λ���̤Ǵ�λ���뤿�ᡢ�����Ǥ����������ɤ��֤�
            print(REMISE_PAYMENT_CHARGE_OK);
            exit;
        }
        print("ERROR");
        exit;
    }
}

// ��Х��봰λ�ƥ�ץ졼��
function lfRemiseConveniComplete() {
    require_once DATA_PATH . 'conf/mobile_conf.php';

    gfPrintLog('remise mobile conveni finish start----------:', REMISE_LOG_PATH_CONVENI_RET);
    foreach($_POST as $key => $val){
        gfPrintLog( "\t" . $key . " => " . $val, REMISE_LOG_PATH_CONVENI_RET);
    }
    gfPrintLog("remise mobile conveni finish end  ----------", REMISE_LOG_PATH_CONVENI_RET);

    $objForm = lfInitParamMobileCompleteConveni();
    // �ѥ�᡼�������å�
    if ($arrErr = $objForm->checkError()) {
        gfPrintLog("Param Invalid", REMISE_LOG_PATH_CONVENI_RET);
        foreach ($arrErr as $k => $v) {
            gfPrintLog("\t$k => $v", REMISE_LOG_PATH_CONVENI_RET);
        }
        mb_http_output(REMISE_SEND_ENCODE);
        sfDispSiteError(FREE_ERROR_MSG, "", true, "����������˰ʲ��Υ��顼��ȯ�����ޤ�����<br /><br /><br />���ѥ�᡼���������Ǥ���", true);
    }
    $arrForm = $objForm->getHashArray();
    $arrOrderTemp = lfGetOrderTempConveni($arrForm, new SC_Query);
    $arrOrderTemp = $arrOrderTemp[0];

    // ������̤Υ��顼�����å�
    global $arrRemiseErrorWord;
    gfPrintLog("\terror check", REMISE_LOG_PATH_CONVENI_RET);
    if ($arrForm["X-R_CODE"] !== $arrRemiseErrorWord["OK"]) {
        $err_detail = $arrForm["X-R_CODE"];
        gfPrintLog("\t error check result: $err_detail", REMISE_LOG_PATH_CONVENI_RET);
        mb_http_output(REMISE_SEND_ENCODE);
        sfDispSiteError(FREE_ERROR_MSG, "", true, "����������˰ʲ��Υ��顼��ȯ�����ޤ�����<br /><br /><br />��" . $err_detail, true);
    }
    // ��ۤ������������å�
    gfPrintLog("\tpayment total check", REMISE_LOG_PATH_CONVENI_RET);
    if ($arrOrderTemp["payment_total"] != $arrForm["X-TOTAL"]) {
        $xtotal = $arrForm["X-TOTAL"];
        $paytotal = $arrOrderTemp["payment_total"];
        gfPrintLog("\t payment total check result: X-TOTAL($xtotal) != payment_total($paytotal)", REMISE_LOG_PATH_CONVENI_RET);
        mb_http_output(REMISE_SEND_ENCODE);
        sfDispSiteError(FREE_ERROR_MSG, "", true, "����������˰ʲ��Υ��顼��ȯ�����ޤ�����<br /><br /><br />�������ۤȻ�ʧ����ۤ��㤤�ޤ���", true);
    }

    gfPrintLog("\tdtb_order_temp update...", REMISE_LOG_PATH_CONVENI_RET);
    // ��ߡ���������ͤμ���
    $job_id = lfSetConvMSG("�����ID(REMISE)", $arrForm["X-JOB_ID"]);
    $payment_limit = lfSetConvMSG("��ʧ������", $arrForm["X-PAYDATE"]);
    global $arrConvenience;
    $conveni_type = lfSetConvMSG("��ʧ������ӥ�", $arrConvenience[$arrForm["X-PAY_CSV"]]);
    $payment_total = lfSetConvMSG("��׶��", $arrForm["X-TOTAL"]);
    $receipt_no = lfSetConvMSG("����ӥ�ʧ���Ф��ֹ�", $arrForm["X-PAY_NO1"]);

    // �ե��ߥ꡼�ޡ��ȤΤ�URL���ʤ�
    if ($arrForm["X-PAY_CSV"] != "D030") {
        $payment_url = lfSetConvMSG("����ӥ�ʧ���Ф�URL", $arrForm["X-PAY_NO2"]);
    } else {
        $payment_url = lfSetConvMSG("��ʸ�ֹ�", $arrForm["X-PAY_NO2"]);
    }

    $arrRet['cv_type'] = $conveni_type;             // ����ӥˤμ���
    $arrRet['cv_payment_url'] = $payment_url;       // ʧ��ɼURL(PC)
    $arrRet['cv_receipt_no'] = $receipt_no;         // ʧ��ɼ�ֹ�
    $arrRet['cv_payment_limit'] = $payment_limit;   // ��ʧ������
    $arrRet['title'] = lfSetConvMSG("����ӥ˷��", true);

    // ��������ǡ�������
    $arrModule['module_id'] = MDL_REMISE_ID;
    $arrModule['payment_total'] = $arrOrderTemp["payment_total"];
    $arrModule['payment_id'] = PAYMENT_CONVENIENCE_ID;

    // ���ơ�������̤����ˤ���
    $sqlval['status'] = 2;

    // ����ӥ˷�Ѿ�����Ǽ
    $sqlval['conveni_data'] = serialize($arrRet);
    $sqlval['memo01'] = PAYMENT_CONVENIENCE_ID;
    $sqlval['memo02'] = serialize($arrRet);
    $sqlval['memo03'] = MDL_REMISE_ID;
    $sqlval['memo04'] = $arrForm["X-JOB_ID"];
    $sqlval['memo05'] = serialize($arrModule);

    // �������ơ��֥�˹���
    sfRegistTempOrder($arrForm['OPT'], $sqlval);
    gfPrintLog("\tdtb_order_temp update done", REMISE_LOG_PATH_CONVENI_RET);

    gfPrintLog("Mobile Complete Start", REMISE_LOG_PATH_CONVENI_RET);
    if (lfMobileComplete(REMISE_PAY_TYPE_CONVENI)) {
        gfPrintLog("Mobile Complete Success", REMISE_LOG_PATH_CONVENI_RET);
    } else {
        gfPrintLog("Mobile Complete Error", REMISE_LOG_PATH_CONVENI_RET);
        mb_http_output(REMISE_SEND_ENCODE);
        sfDispSiteError(FREE_ERROR_MSG, "", true, "����������˥��顼��ȯ�����ޤ�����<br>������Ǥ��������ȴ����ԤޤǤ��䤤��碌������", true);
    }
    gfPrintLog("Mobile Complete End", $log_path);


}

// ����ӥ������ǧ����
function lfRemiseConveniCheck(){
    $objQuery = new SC_Query;

    $log_path = DATA_PATH . "logs/remise_cv_charge.log";
    gfPrintLog("remise conveni result : ".$_POST["JOB_ID"] , $log_path);

    // ɬ�פʥǡ�������������Ƥ��ơ���Ǽ���Τμ�ư��������Ĥ��Ƥ�����
    if(isset($_POST["JOB_ID"]) && isset($_POST["REC_FLG"]) && REMISE_CONVENIENCE_RECIVE == 1){

        $errFlg = FALSE;

        // ��Ǽ�Ѥߤξ��
        if ($_POST["REC_FLG"] == REMISE_CONVENIENCE_CHARGE) {
            // POST�����Ƥ����ƥ���¸
            gfPrintLog("remise conveni charge start----------", $log_path);
            foreach($_POST as $key => $val){
                gfPrintLog( "\t" . $key . " => " . $val, $log_path);
            }
            gfPrintLog("remise conveni charge end  ----------", $log_path);

            // IP���ɥ쥹���椹����
            if (REMISE_IP_ADDRESS_DENY == 1) {
                gfPrintLog("remise remoto ip address : ".$_SERVER["REMOTE_HOST"]."-".$_SERVER["REMOTE_ADDR"], $log_path);
                if (!isset($_SERVER["REMOTE_ADDR"]) || !lfIpAddressDenyCheck($_SERVER["REMOTE_ADDR"])) {
                    print("NOT REMISE SERVER");
                    exit;
                }
            }

            // �����ֹ�ȶ�ۤμ���
            $order_id = 0;
            $payment_total = 0;

            if (isset($_POST["S_TORIHIKI_NO"])) {
                $order_id = $_POST["S_TORIHIKI_NO"];
            }

            if (isset($_POST["TOTAL"])) {
                $payment_total = $_POST["TOTAL"];
            }

            gfPrintLog("order_id : ".$order_id, $log_path);
            gfPrintLog("payment_total : ".$payment_total, $log_path);

            // ��ʸ�ǡ�������
            $arrTempOrder = $objQuery->getall("SELECT payment_total FROM dtb_order_temp WHERE order_id = ? ", array($order_id));

            // ��ۤ����
            if (count($arrTempOrder) > 0) {
                gfPrintLog("ORDER payment_total : ".$arrTempOrder[0]['payment_total'], $log_path);
                if ($arrTempOrder[0]['payment_total'] == $payment_total) {
                    $errFlg = TRUE;
                }
            }

            // JOB_ID�������ֹ档�����ۤ����פ�����Τߡ����ơ�����������Ѥߤ��ѹ�����
            if ($errFlg) {
                $sql = "UPDATE dtb_order SET status = 6, update_date = now() ".
                    "WHERE order_id = ? AND memo04 = ? ";
                $objQuery->query($sql, array($order_id, $_POST["JOB_ID"]));

                //������̤�ɽ��
                print(REMISE_CONVENIENCE_CHARGE_OK);
                exit;
            }
        }
        print("ERROR");
        exit;
    }
}

/**
 * IP���ɥ쥹�Ӱ�����å�
 * @param $ip IP���ɥ쥹
 * @return boolean
 */
function lfIpAddressDenyCheck($ip) {

    // IP���ɥ쥹�ϰϤ����äƤʤ����
    if (ip2long(REMISE_IP_ADDRESS_S) > ip2long($ip) ||
        ip2long(REMISE_IP_ADDRESS_E) < ip2long($ip)) {
        return FALSE;
    }
    return TRUE;
}

/**
 * ���ʹ�����λ����(��Х���)
 *
 * @param string $type ���쥸�åȤ�����ӥˤ�
 * @return boolean
 */
function lfMobileComplete($type) {
    $logPath = ($type == REMISE_PAY_TYPE_CONVENI)
        ? REMISE_LOG_PATH_CONVENI_RET
        : REMISE_LOG_PATH_CARD_RET;
    $objForm = ($type == REMISE_PAY_TYPE_CONVENI)
        ? lfInitParamMobileCompleteConveni()
        : lfInitParamMobileCompleteCredit();
    $objSiteSess     = new SC_SiteSession();
    $objCartSess     = new SC_CartSession();
    $objCampaignSess = new SC_CampaignSession();
    $objCustomer     = new SC_Customer();
    $objQuery        = new SC_Query();
    $arrInfo         = sf_getBasisData();

    if ($arrErr = $objForm->checkError()) {
        gfPrintLog("\tParam Invalid", $logPath);
        foreach ($arrErr as $k => $v) {
            gfPrintLog("\t$k => $v", $logPath);
        }
        return false;
    }

    $order_id = $objForm->getValue('X-S_TORIHIKI_NO');

    // �������ơ��֥�μ���
    $getOrderTempFucntion = ($type == REMISE_PAY_TYPE_CONVENI)
        ? 'lfGetOrderTempConveni'
        : 'lfUpdateOrderTemp';
    $arrOrderTemp = $getOrderTempFucntion($objForm->getHashArray(), $objQuery);
    if (empty($arrOrderTemp[0])) {
        gfPrintLog("\tOrder Temp Not Found: $order_id", $logPath);
        return false;
    }
    $arrOrderTemp = $arrOrderTemp[0];
    gfPrintLog("\tOrder Temp Found: $order_id", $logPath);

    // ���å���������
    $_SESSION = unserialize($arrOrderTemp['session']);

    $uniqid = $arrOrderTemp['order_temp_id'];
    $customer_id = $objCustomer->getValue('customer_id');
    $execSetCustomerPurchase = false;
    $preCustomer = false; // �������Ͽ�ե饰��true�ʤ鲾�����Ͽ�᡼�����������

    gfPrintLog("\tBegin Transaction...", $logPath);
    $objQuery = new SC_Query();
    $objQuery->begin();

    // ���������Ͽ����
    if ($objCustomer->isLoginSuccess()) {
        // �����Ϥ������Ͽ
        gfPrintLog("\tlfSetNewAddr() Start.", $logPath);
        lfSetNewAddr($uniqid, $customer_id, $objQuery);
        $execSetCustomerPurchase = true;
    } else {
        //���������������Ͽ
        switch(PURCHASE_CUSTOMER_REGIST) {
        //̵��
        case '0':
            // �����������Ͽ
            if($arrOrderTemp['member_check'] == '1') {
                // �������Ͽ
                gfPrintLog("\t0: lfRegistPreCustomer() Start.", $logPath);
                $customer_id = lfRegistPreCustomer($arrOrderTemp, $arrInfo, $objQuery);
                $execSetCustomerPurchase = true;
                $preCustomer = true;
            }
            break;
        //ͭ��
        case '1':
            // �������Ͽ
            gfPrintLog("\t1: lfRegistPreCustomer() Start.", $logPath);
            $customer_id = lfRegistPreCustomer($arrOrderTemp, $arrInfo, $objQuery);
            $execSetCustomerPurchase = true;
            $preCustomer = true;
            break;
        }
    }

    // �������פ�ܵҥơ��֥��ȿ��
    gfPrintLog("\tlfSetCustomerPurchase() Start.", $logPath);
    if ($execSetCustomerPurchase && !lfSetCustomerPurchase($customer_id, $arrOrderTemp, $objQuery)) {
        gfPrintLog("\tFailed lfSetCustomerPurchase();", $logPath);
        $objQuery->rollback();
        return false;
    }
    // ����ơ��֥�����ơ��֥�˳�Ǽ����
    gfPrintLog("\tlfRegistOrder() Start.", $logPath);
    if (!lfRegistOrder($objQuery, $arrOrderTemp)) {
        gfPrintLog("\t" . 'Failed lfRegistOrder();', $logPath);
        $objQuery->rollback();
        return false;
    }
    // �����Ⱦ��ʤ����ܺ٥ơ��֥�˳�Ǽ����
    gfPrintLog("\tlfRegistOrderDetail() Start.", $logPath);
    if (!lfRegistOrderDetail($objQuery, $order_id, $objCartSess)) {
        gfPrintLog("\t" . 'Failed lfRegistOrderDetail();', $logPath);
        $objQuery->rollback();
        return false;
    }
    // �������ơ��֥�ξ���������롣
    gfPrintLog("\tlfDeleteTempOrder() Start.", $logPath);
    if (!lfDeleteTempOrder($objQuery, $uniqid)) {
        gfPrintLog("\t" . 'Failed lfDeleteTempOrder();', $logPath);
        $objQuery->rollback();
        return false;
    }
    // �����ڡ��󤫤�����ܤξ����Ͽ���롣
    if ($objCampaignSess->getIsCampaign()) {
        gfPrintLog("\tlfRegistCampaignOrder() Start.", $logPath);
        if (!lfRegistCampaignOrder($objQuery, $objCampaignSess, $order_id)) {
            gfPrintLog("\t" . 'Failed lfRegistCampaignOrder();', $logPath);
            $objQuery->rollback();
            return false;
        }
    }

    // sfSendOrderMail(), sfMakeSubject()��ǡ�LC_Page���饹����Ѥ��Ƥ��뤿�ᡢ������LC_Page���饹���������.
    // ������������ʤ���LC_Page���饹��̤����ʤΤ�Fatal Error�ˤʤ�.
    if (!class_exists('LC_Page')) {
        gfPrintLog("\t" . 'define LC_Page Class.', $logPath);
        class LC_Page {}
    }

    gfPrintLog("\t" . 'Send Mail Start.', $logPath);
    lfSendMail($order_id, $preCustomer, $customer_id); // �᡼������

    gfPrintLog("\t" . 'Commit Transaction.', $logPath);
    $objQuery->commit();

    gfPrintLog("\t" . 'Success lfMobileComplete();', $logPath);
    return true;
}
/**
 * ��Х��륯�쥸�åȴ�λ�ѥѥ�᡼���ν����
 *
 * @return SC_FormParam
 */
function lfInitParamMobileCompleteCredit() {
/**
X-TRANID => 0802242008300000873041892525 from 211.0.149.169
X-S_TORIHIKI_NO => 50 from 211.0.149.169
X-REFAPPROVED => 2008224 from 211.0.149.169
X-REFFORWARDED => 15250 from 211.0.149.169
X-ERRCODE =>     from 211.0.149.169
X-ERRINFO => 000000000 from 211.0.149.169
X-ERRLEVEL => 0 from 211.0.149.169
X-R_CODE => 0:0000 from 211.0.149.169
CARIER_TYPE => imode from 211.0.149.169
REC_TYPE => RET from 211.0.149.169
X-REFGATEWAYNO => 1 from 211.0.149.169
 X-AMOUNT => 2733 from 211.0.149.169
X-TAX => 0 from 211.0.149.169
X-TOTAL => 2733 from 211.0.149.169
X-PAYQUICKID =>  from 211.0.149.169
X-PARTOFCARD => 1234 from 211.0.149.169
X-EXPIRE => 1122 from 211.0.149.169
X-NAME => LOCKON from 211.0.149.169
*/
    $objForm = new SC_FormParam();
    $objForm->addParam('�ȥ�󥶥������ID', 'X-TRANID',        28, '', array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('�����ֹ�',          'X-S_TORIHIKI_NO', 17, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('���',             'X-AMOUNT',        8, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('������',            'X-TAX',           7, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('��׶��',          'X-TOTAL',         8, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('��ǧ�ֹ�',          'X-REFAPPROVED',   7, '',  array('EXIST_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('�Ÿ��襳����',      'X-REFFORWARDED',  7, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('���顼������',      'X-ERRCODE',       3, '',  array('MAX_LENGTH_CHECK'));
    $objForm->addParam('���顼�ܺ٥�����',   'X-ERRINFO',        9, '',   array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('���顼��٥�',       'X-ERRLEVEL',      1, '',  array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('��ꥳ����',        'X-R_CODE',        6, '',  array('MAX_LENGTH_CHECK'));
    $objForm->addParam('����ʬ',          'REC_TYPE',        3,'',  array('EXIST_CHECK', 'ALNUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('�����ȥ������ֹ�',   'X-REFGATEWAYNO',  2, '',  array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('�ڥ������å�ID',     'X-PAYQUICKID',    20, '', array('ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����ꥢ',          'CARIER_TYPE',      5, '', array('EXIST_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('�������ֹ�',        'X-PARTOFCARD',     4, '', array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('ͭ������',          'X-EXPIRE',         4, '', array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));

    $objForm->setParam($_POST);
    return $objForm;
}

/**
 * ��Х��륳��ӥ˴�λ�ѥѥ�᡼���ν����
 *
 * @return SC_FormParam
 */
function lfInitParamMobileCompleteConveni() {
    $objForm = new SC_FormParam();
    $objForm->addParam('�����ID',        'X-JOB_ID',        17, '', array('EXIST_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('�����ֹ�',        'X-S_TORIHIKI_NO', 17, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('��ꥳ����',      'X-R_CODE',         6, '',  array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('������',        'X-TOTAL',          6, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����ʬ������',     'X-TAX',            6, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('��ʧ����',        'X-PAYDATE',        8, '',  array('ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('��ʧ����ˡ������', 'X-PAY_WAY',        3, '',  array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����ӥ˥�����',   'X-PAY_CSV',        4, '',  array('EXIST_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('ʧ���Ф��ֹ�1',    'X-PAY_NO1',        20, '',  array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('ʧ���Ф��ֹ�2',    'X-PAY_NO2',        120, '',   array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('���ץ����',       'OPT',              100, '',  array('EXIST_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����ʬ',         'REC_TYPE',        3,'',  array('EXIST_CHECK', 'ALNUM_CHECK', 'NUM_COUNT_CHECK'));
    $objForm->addParam('����ꥢ',         'CARIER_TYPE',      5, '', array('EXIST_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->setParam($_POST);

    return $objForm;
}
/**
 * �������ơ��֥�򹹿�����
 *
 * @param array $arrForm
 * @param SC_Query $objQuery
 * @return array|null
 */
function lfUpdateOrderTemp($arrForm, $objQuery) {
    $order_id = $arrForm['X-S_TORIHIKI_NO'];

    // POST�ǡ�������¸
    $arrVal["credit_result"] = $arrForm["X-TRANID"];
    $arrVal["memo01"] = PAYMENT_CREDIT_ID;
    $arrVal["memo03"] = MDL_REMISE_ID;
    $arrVal["memo04"] = $arrForm["X-TRANID"];

    // �ȥ�󥶥�����󥳡���
    $arrMemo["trans_code"] = array("name"=>"Remise�ȥ�󥶥�����󥳡���", "value" => $arrForm["X-TRANID"]);
    $arrVal["memo02"] = serialize($arrMemo);

    // ��������ǡ�������
    $arrModule['module_id'] = MDL_REMISE_ID;
    $arrModule['payment_total'] = $arrForm["X-TOTAL"];
    $arrModule['payment_id'] = PAYMENT_CREDIT_ID;
    $arrVal['memo05'] = serialize($arrModule);

    $objQuery->update('dtb_order_temp', $arrVal, 'order_id = ?', array($order_id));
    return $objQuery->select('*', 'dtb_order_temp', 'order_id = ? AND del_flg = 0', array($order_id));
}

/**
 * �������ơ��֥�ν��꤬��Ͽ�Ѥߥơ��֥�Ȱۤʤ���ϡ��̤Τ��Ϥ�����ɲä���
 *
 * @param string $uniqid
 * @param integer $customer_id
 */
function lfSetNewAddr($uniqid, $customer_id, $objQuery) {
    $diff = false;
    $find_same = false;

    $col = "deliv_name01,deliv_name02,deliv_kana01,deliv_kana02,deliv_tel01,deliv_tel02,deliv_tel03,deliv_zip01,deliv_zip02,deliv_pref,deliv_addr01,deliv_addr02";
    $where = "order_temp_id = ?";
    $arrRet = $objQuery->select($col, "dtb_order_temp", $where, array($uniqid));

    // ����̾��deliv_�������롣
    foreach($arrRet[0] as $key => $val) {
        $keyname = ereg_replace("^deliv_", "", $key);
        $arrNew[$keyname] = $val;
    }

    // �������ơ��֥�Ȥ����
    $col = "name01,name02,kana01,kana02,tel01,tel02,tel03,zip01,zip02,pref,addr01,addr02";
    $where = "customer_id = ?";
    $arrCustomerAddr = $objQuery->select($col, "dtb_customer", $where, array($customer_id));

    // �������ν���Ȱۤʤ���
    if($arrNew != $arrCustomerAddr[0]) {
        // �̤Τ��Ϥ���ơ��֥�ν������Ӥ���
        $col = "name01,name02,kana01,kana02,tel01,tel02,tel03,zip01,zip02,pref,addr01,addr02";
        $where = "customer_id = ?";
        $arrOtherAddr = $objQuery->select($col, "dtb_other_deliv", $where, array($customer_id));

        foreach($arrOtherAddr as $arrval) {
            if($arrNew == $arrval) {
                // ���Ǥ�Ʊ�����꤬��Ͽ����Ƥ���
                $find_same = true;
            }
        }

        if(!$find_same) {
            $diff = true;
        }
    }

    // ���������Ϥ��褬��Ͽ�ѤߤΤ�ΤȰۤʤ�����̤Τ��Ϥ���ơ��֥����Ͽ����
    if($diff) {
        $sqlval = $arrNew;
        $sqlval['customer_id'] = $customer_id;
        $objQuery->insert("dtb_other_deliv", $sqlval);
    }
}

/**
 * ������������ơ��֥����Ͽ����
 *
 * @param integer $customer_id
 * @param array $arrData �������ơ��֥����
 * @param SC_Query $objQuery
 * @return booean
 */
function lfSetCustomerPurchase($customer_id, $arrData, $objQuery) {
    $col = "first_buy_date, last_buy_date, buy_times, buy_total, point";
    $where = "customer_id = ?";
    $arrRet = $objQuery->select($col, "dtb_customer", $where, array($customer_id));
    $sqlval = $arrRet[0];

    if($sqlval['first_buy_date'] == "") {
        $sqlval['first_buy_date'] = "Now()";
    }
    $sqlval['last_buy_date'] = "Now()";
    $sqlval['buy_times']++;
    $sqlval['buy_total']+= $arrData['total'];
    $sqlval['point'] = ($sqlval['point'] + $arrData['add_point'] - $arrData['use_point']);

    // �ݥ���Ȥ���­���Ƥ�����
    if($sqlval['point'] < 0) {
        return false;
    }
    $objQuery->update("dtb_customer", $sqlval, $where, array($customer_id));
    return true;
}
/**
 * �����Ͽ�ʲ���Ͽ�ˤ�¹Ԥ���
 *
 * @param array $arrData �������ơ��֥����
 * @param array $arrInfo �����Ⱦ���
 * @return integer customer_id �ܵ�ID
 */
function lfRegistPreCustomer($arrData, $arrInfo, $objQuery) {
    foreach ($arrData as $k => $v) {
        gfPrintLog("$k -> $v",  REMISE_LOG_PATH_CARD_RET);
    }
    // �������β����Ͽ
    $sqlval['name01'] = $arrData['order_name01'];
    $sqlval['name02'] = $arrData['order_name02'];
    $sqlval['kana01'] = $arrData['order_kana01'];
    $sqlval['kana02'] = $arrData['order_kana02'];
    $sqlval['zip01'] = $arrData['order_zip01'];
    $sqlval['zip02'] = $arrData['order_zip02'];
    $sqlval['pref'] = $arrData['order_pref'];
    $sqlval['addr01'] = $arrData['order_addr01'];
    $sqlval['addr02'] = $arrData['order_addr02'];
    $sqlval['email'] = $arrData['order_email'];
    $sqlval['tel01'] = $arrData['order_tel01'];
    $sqlval['tel02'] = $arrData['order_tel02'];
    $sqlval['tel03'] = $arrData['order_tel03'];
    $sqlval['fax01'] = $arrData['order_fax01'];
    $sqlval['fax02'] = $arrData['order_fax02'];
    $sqlval['fax03'] = $arrData['order_fax03'];
    $sqlval['sex'] = $arrData['order_sex'];
    $sqlval['password'] = $arrData['password'];
    $sqlval['reminder'] = $arrData['reminder'];
    $sqlval['reminder_answer'] = $arrData['reminder_answer'];

    // ���ޥ��ۿ��ѥե饰��Ƚ��
    switch($arrData['mail_flag']) {
    case '1':   // HTML�᡼��
        $mail_flag = 4;
        break;
    case '2':   // TEXT�᡼��
        $mail_flag = 5;
        break;
    case '3':   // ��˾�ʤ�
        $mail_flag = 6;
        break;
    default:
        $mail_flag = 6;
        break;
    }
    // ���ޥ��ե饰
    $sqlval['mailmaga_flg'] = $mail_flag;

    // �������Ͽ
    $sqlval['status'] = 1;
    // URLȽ���ѥ���
    $sqlval['secret_key'] = sfGetUniqRandomId("t");

    $objQuery = new SC_Query();
    $sqlval['create_date'] = "now()";
    $sqlval['update_date'] = "now()";
    $objQuery->insert("dtb_customer", $sqlval);

    // �ܵ�ID�μ���
    $arrRet = $objQuery->select("customer_id", "dtb_customer", "secret_key = ?", array($sqlval['secret_key']));
    $customer_id = $arrRet[0]['customer_id'];

    return $customer_id;
}
/**
 * ����ơ��֥����Ͽ
 *
 * @param SC_Query $objQuery
 * @param array $arrData
 * @return $order_id
 */
function lfRegistOrder($objQuery, $arrData) {
    $objCampaignSess = new SC_CampaignSession();
    $sqlval = $arrData;

    // ��ʸ���ơ�����:���̵꤬����п������դ�����
    if(!isset($sqlval["status"])) {
        $sqlval['status'] = '1';
    }

    // �̤Τ��Ϥ������ꤷ�Ƥ��ʤ���硢���������Ͽ����򥳥ԡ����롣
    if(empty($arrData["deliv_check"]) || $arrData["deliv_check"] == "-1") {
        $sqlval['deliv_name01'] = $arrData['order_name01'];
        $sqlval['deliv_name02'] = $arrData['order_name02'];
        $sqlval['deliv_kana01'] = $arrData['order_kana01'];
        $sqlval['deliv_kana02'] = $arrData['order_kana02'];
        $sqlval['deliv_pref'] = $arrData['order_pref'];
        $sqlval['deliv_zip01'] = $arrData['order_zip01'];
        $sqlval['deliv_zip02'] = $arrData['order_zip02'];
        $sqlval['deliv_addr01'] = $arrData['order_addr01'];
        $sqlval['deliv_addr02'] = $arrData['order_addr02'];
        $sqlval['deliv_tel01'] = $arrData['order_tel01'];
        $sqlval['deliv_tel02'] = $arrData['order_tel02'];
        $sqlval['deliv_tel03'] = $arrData['order_tel03'];
    }

    $order_id = $arrData['order_id'];       // ��������ID
    $sqlval['create_date'] = 'now()';       // ������

    // �����ڡ���ID
    if($objCampaignSess->getIsCampaign()) $sqlval['campaign_id'] = $objCampaignSess->getCampaignId();

    // ����ơ��֥�˽񤭹��ޤʤ�������
    unset($sqlval['mailmaga_flg']);     // ���ޥ������å�
    unset($sqlval['deliv_check']);      // �̤Τ��Ϥ�������å�
    unset($sqlval['point_check']);      // �ݥ�������ѥ����å�
    unset($sqlval['member_check']);     // ��������������å�
    unset($sqlval['password']);         // ������ѥ����
    unset($sqlval['reminder']);         // ��ޥ����������
    unset($sqlval['reminder_answer']);  // ��ޥ����������
    unset($sqlval['mail_flag']);        // �᡼��ե饰
    unset($sqlval['session']);          // ���å�������

    // INSERT�μ¹�
    $objQuery->insert("dtb_order", $sqlval);

    return true;
}
/**
 * ����ܺ٥ơ��֥����Ͽ
 *
 * @param SC_Query $objQuery
 * @param integer $order_id
 * @param boolean
 */
function lfRegistOrderDetail($objQuery, $order_id, $objCartSess) {
    // �����������μ���
    $arrCart = $objCartSess->getCartList();
    $max = count($arrCart);

    // ����¸�ߤ���ܺ٥쥳���ɤ�ä��Ƥ�����
    $objQuery->delete("dtb_order_detail", "order_id = ?", array($order_id));

    // ����̾����
    $arrClassName = sfGetIDValueList("dtb_class", "class_id", "name");
    // ����ʬ��̾����
    $arrClassCatName = sfGetIDValueList("dtb_classcategory", "classcategory_id", "name");

    for ($i = 0; $i < $max; $i++) {
        // ���ʵ��ʾ���μ���
        $arrData = sfGetProductsClass($arrCart[$i]['id']);

        // ¸�ߤ��뾦�ʤΤ�ɽ�����롣
        if($arrData != "") {
            $sqlval['order_id'] = $order_id;
            $sqlval['product_id'] = $arrCart[$i]['id'][0];
            $sqlval['classcategory_id1'] = $arrCart[$i]['id'][1];
            $sqlval['classcategory_id2'] = $arrCart[$i]['id'][2];
            $sqlval['product_name'] = $arrData['name'];
            $sqlval['product_code'] = $arrData['product_code'];
            $sqlval['classcategory_name1'] = $arrClassCatName[$arrData['classcategory_id1']];
            $sqlval['classcategory_name2'] = $arrClassCatName[$arrData['classcategory_id2']];
            $sqlval['point_rate'] = $arrCart[$i]['point_rate'];
            $sqlval['price'] = $arrCart[$i]['price'];
            $sqlval['quantity'] = $arrCart[$i]['quantity'];
            // �߸ˤθ�������
            if (!lfReduceStock($objQuery, $arrCart[$i]['id'], $arrCart[$i]['quantity'])) {
                return false;
            }
            // INSERT�μ¹�
            $objQuery->insert("dtb_order_detail", $sqlval);
        } else {
            return false;
        }
    }
    return true;
}
/**
 * �������ʤκ߸ˤ򸺤餹.
 *
 * @param SC_Query $objQuery
 * @param array $arrID ����ID
 * @param integer $quantity ���ʿ�
 * @return boolean
 */
function lfReduceStock($objQuery, $arrID, $quantity) {
    $where = "product_id = ? AND classcategory_id1 = ? AND classcategory_id2 = ?";
    $arrRet = $objQuery->select("stock, stock_unlimited", "dtb_products_class", $where, $arrID);

    // ����ڤ쥨�顼
    if(($arrRet[0]['stock_unlimited'] != '1' && $arrRet[0]['stock'] < $quantity) || $quantity == 0) {
        return false;

    // ̵���¤ξ�硢�߸ˤ�NULL
    } elseif($arrRet[0]['stock_unlimited'] == '1') {
        $sqlval['stock'] = null;
        $objQuery->update("dtb_products_class", $sqlval, $where, $arrID);
    // �߸ˤ򸺤餹
    } else {
        $sqlval['stock'] = ($arrRet[0]['stock'] - $quantity);
        if($sqlval['stock'] == "") {
            $sqlval['stock'] = '0';
        }
        $objQuery->update("dtb_products_class", $sqlval, $where, $arrID);
    }
    return true;
}
/**
 * �����ڡ������ơ��֥����Ͽ
 *
 * @param SC_Query $objQuery
 * @param SC_CampaignSession $objCampaignSess
 * @param integer $order_id
 */
function lfRegistCampaignOrder($objQuery, $objCampaignSess, $order_id) {

    // ����ǡ��������
    $cols = "order_id, campaign_id, customer_id, message, order_name01, order_name02,".
            "order_kana01, order_kana02, order_email, order_tel01, order_tel02, order_tel03,".
            "order_fax01, order_fax02, order_fax03, order_zip01, order_zip02, order_pref, order_addr01,".
            "order_addr02, order_sex, order_birth, order_job, deliv_name01, deliv_name02, deliv_kana01,".
            "deliv_kana02, deliv_tel01, deliv_tel02, deliv_tel03, deliv_fax01, deliv_fax02, deliv_fax03,".
            "deliv_zip01, deliv_zip02, deliv_pref, deliv_addr01, deliv_addr02, payment_total";

    $arrOrder = $objQuery->select($cols, "dtb_order", "order_id = ?", array($order_id));

    $sqlval = $arrOrder[0];
    $sqlval['create_date'] = 'now()';

    // INSERT�μ¹�
    $objQuery->insert("dtb_campaign_order", $sqlval);

    // �������߿��ι���
    $total_count = $objQuery->get("dtb_campaign", "total_count", "campaign_id = ?", array($sqlval['campaign_id']));
    $arrCampaign['total_count'] = $total_count += 1;
    $objQuery->update("dtb_campaign", $arrCampaign, "campaign_id = ?", array($sqlval['campaign_id']));

    return true;
}
/**
 * �������ơ��֥�κ��
 *
 * @param SC_Query $objQuery
 * @param string $uniqid
 */
function lfDeleteTempOrder($objQuery, $uniqid) {
    $where = "order_temp_id = ?";
    $sqlval['del_flg'] = 1;
    $objQuery->update("dtb_order_temp", $sqlval, $where, array($uniqid));
    return true;
}
/**
 * �᡼����������
 *
 * @param integer $order_id
 * @param boolean $preCustomer
 * @param integer $customer_id
 */
function lfSendMail($order_id, $preCustomer = false, $customer_id = null) {
    $objQuery = new SC_Query;
    $arrOrder = $objQuery->select("*", "dtb_order", "order_id = ?", array($order_id));
    $arrOrder = $arrOrder[0];

    $secret_key = $objQuery->get('dtb_customer', 'secret_key', 'customer_id=?', array($customer_id));

    // ��Х��벾��Ͽ��λ�᡼������
    if ($preCustomer && $customer_id) {

        gfPrintLog("\tPre Customer Mail Send.", REMISE_LOG_PATH_CARD_RET);
        $arrInfo = sf_getBasisData();
        $objMailPage = new StdClass();
        $objMailPage->to_name01 = $arrOrder['order_name01'];
        $objMailPage->to_name02 = $arrOrder['order_name02'];
        $objMailPage->CONF = $arrInfo;
        $objMailPage->uniqid = $secret_key;
        $objMailView = new SC_SiteView;
        $objMailView->assignobj($objMailPage);
        $body = $objMailView->fetch("mobile/mail_templates/customer_mail.tpl");

        $objMail = new GC_SendMail();
        $objMail->setItem(
                            ''                                      //������
                            , sfMakeSubject("�����Ͽ�Τ���ǧ")     //�����֥�������
                            , $body                                 //����ʸ
                            , $arrInfo['email03']                   //�����������ɥ쥹
                            , $arrInfo['shop_name']                 //����������̾��
                            , $arrInfo["email03"]                   //��reply_to
                            , $arrInfo["email04"]                   //��return_path
                            , $arrInfo["email04"]                   //  Errors_to
                            , $arrInfo["email01"]                   //  Bcc
                                                            );
        // ���������
        $name = $arrOrder['order_name01'] . $arrOrder['order_name02'] ." ��";
        $objMail->setTo($arrOrder['order_email'], $name);
        $objMail->sendMail();
    }

    // ��Х��������λ�᡼�����������
    sfSendOrderMail($order_id, '2');
}

/**
 * �������ǡ������������
 *
 * @param array $arrForm
 * @param SC_Query $objQuery
 * @return array|null
 */
function lfGetOrderTempConveni($arrForm, $objQuery) {
    $order_id = $arrForm['X-S_TORIHIKI_NO'];
    $uniqid   = $arrForm['OPT'];
    $where    = 'order_id = ? AND order_temp_id = ? AND del_flg = 0';
    return $objQuery->select('*', 'dtb_order_temp', $where, array($order_id, $uniqid));
}

function lfSetConvMSG($name, $value){
    return array("name" => $name, "value" => $value);
}
?>
