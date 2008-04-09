<?php
/**
 * �⥸�塼������μ�����������Ԥ�
 *
 */
class Mdl_Cybs_Config {
    var $arrConfig;

    /**
     * dtb_payment��memo**����Ͽ������ܤ����䤹���ϡ�
     * ���������memo���б����륭��̾���ɲä���
     * �ƥ�ץ졼��¦���ɲä�������̾����Ѥ���
     *
     * @see $this->_getConfig()
     * @see $this->createSqlArray()
     * @var array
     */
    var $arrPaymentMemoCols = array(
        'memo01' => 'cybs_request_url',
        'memo02' => 'cybs_merchant_id',
        'memo03' => 'cybs_ondemand_use',
        'memo04' => 'cybs_3d_use'
    );

    /**
     * Mdl_Cybs_Config�Υ��󥹥��󥹤��������.
     * ���󥹥���������new�黻�Ҥ���Ѥ���getInstanse()����Ѥ���
     *
     * @return Mdl_Cybs_Config
     */
    function &getInstanse() {
        static $_CybsConfigObj;

        if ($_CybsConfigObj == null) {
            $_CybsConfigObj = new Mdl_Cybs_Config();
        }
        return $_CybsConfigObj;
    }

    /**
     * ������������
     *
     * @param string $key
     * @return array|null
     */
    function getConfig($key = null) {
        if (empty($this->arrConfig)) {
            $this->arrConfig = $this->_getConfig();
        }

        // ������̵���������ƤΥǡ������֤�
        if (empty($key)) {
            return $this->arrConfig;
        }

        // $key���������Ϥ��줿����$key���б������ͤ��֤�
        return isset($this->arrConfig[$key])
            ? $this->arrConfig[$key]
            : null;
    }

    /**
     * DB����������������
     *
     * @return array
     */
    function _getConfig() {
        // memo01���memo10
        $arrMemo = array();
        foreach ($this->arrPaymentMemoCols as $k => $v) {
            $arrMemo[] = "$k as $v";
        }
        $memoCols = implode(',', $arrMemo);
        $sql =<<<END
SELECT
    module_id,
    $memoCols
FROM
    dtb_payment
WHERE
    module_id = ?
END;
        $objQuery = new SC_Query;
        $arrRet = $objQuery->getAll($sql, array(MDL_CYBS_ID));
        return isset($arrRet[0]) ? $arrRet[0] : array();
    }

    /**
     * DB���������Ͽ����.
     *
     * @param array $arrConfig
     */
    function registerConfig($arrConfig) {
        $table = 'dtb_payment';
        $where = 'module_id = ' . MDL_CYBS_ID;

        $objQuery = new SC_Query;
        $count = $objQuery->count($table, $where);

        if ($count) {
            $objQuery->update($table, $arrConfig, $where);
        } else {
            $objQuery->insert($table, $arrConfig);
        }
    }

    /**
     * Insert/Update�Ѥ�Ϣ���������������
     *
     * @param SC_FormParam $objForm
     * @return array
     */
    function createSqlArray($objForm) {
        $objSess = new SC_Session;

        $arrData = array();
        $arrData["payment_method"] = "�����С����������쥸�å�";
        $arrData["fix"] = 3;
        $arrData["module_id"] = MDL_CYBS_ID;
        $arrData["module_path"] = MODULE_PATH . "mdl_cybs/mdl_cybs_credit.php";
        // memo01���memo10
        foreach ($this->arrPaymentMemoCols as $k => $v) {
            $arrData[$k] = $objForm->getValue($v);
        }
        $arrData["del_flg"] = "0";
        $arrData["creator_id"] = $objSess->member_id;
        $arrData["update_date"] = "NOW()";

        return $arrData;
    }

    /**
     * 3D�����奢�����Ѥ��뤫�ɤ���
     *
     * @return boolean
     */
    function use3D() {
        $use3D = $this->getConfig('cybs_3d_use');

        return $use3D
            ? true
            : false;
    }

    /**
     * ����ǥޥ�ɲݶ⤬ͭ�����ɤ���
     *
     * @return boolean
     */
    function enableOndemand() {
        // ������̵��
        $objCustomer = new SC_Customer;
        if (!$objCustomer->isLoginSuccess()) return false;

        $useOndemand = $this->getConfig('cybs_ondemand_use');

        return $useOndemand ? true : false;
    }

    /**
     * ����Υ��֥�����ץ����ID���֤�.
     *
     * array(
     *    'subs_id' => '***',
     *    'merchant_ref_number' => '***',
     * ),
     * array(
     *    'subs_id' => '***',
     *    'merchant_ref_number' => '***',
     * ),
     * ...
     *
     * @return array
     */
    function getSubsIds() {
        $objCustomer = new SC_Customer;
        $objCustomer->updateSession();
        $subsDataString = $objCustomer->getValue('cybs_subs_id');

        if (is_null($subsDataString)) {
            return array();
        }

        $subsData = unserialize($subsDataString);

        return is_array($subsData) ? $subsData : array();
    }

    /**
     * ���֥�����ץ����ID��ܵҥơ��֥����Ͽ����.
     *
     * @param string $subsId
     * @param integer $merchant_ref_number
     * @param array $arrSubsResults
     */
    function addSubsId($subsId, $merchant_ref_number) {
        if (!$this->canAddSubsId()) {
            return;
        }
        $objCustomer = new SC_Customer;
        $customerId = $objCustomer->getValue('customer_id');

        $arrSubsId = $this->getSubsIds();

        $arrSubsId[] = array(
            'subs_id' => $subsId,
            'merchant_ref_number' => $merchant_ref_number);
        $arrUpdate = array('cybs_subs_id' => serialize($arrSubsId));

        $objQuery = new SC_Query;
        $objQuery->update('dtb_customer', $arrUpdate, 'customer_id = ?', array($customerId));
    }

    /**
     * ���֥�����ץ�������Ͽ����Max���ɤ�����Ƚ�ꤹ��
     *
     * @return boolean
     */
    function canAddSubsId() {
        $arrSubsData = $this->getSubsIds();
        if (is_array($arrSubsData) && count($arrSubsData) < MDL_CYBS_SUBS_ID_MAX) {
            return true;
        }
        return false;
    }
}
?>
