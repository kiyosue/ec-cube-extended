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

// ��ߡ��������ɥ��쥸�åȷ�ѷ�����ν���
lfRemiseCreditResultCheck();

// ����ӥ���������å�
lfRemiseConveniCheck();

//-------------------------------------------------------------------------------------------------------

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
            print(REMISE_PAYMENT_CHARGE_OK);
            exit;
        }
        print("ERROR");
        exit;
    }
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

?>
