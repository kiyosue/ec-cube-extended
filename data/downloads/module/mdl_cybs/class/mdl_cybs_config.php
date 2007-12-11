<?php
/**
 * �⥸�塼������μ�����������Ԥ�
 *
 */
class Mdl_Cybs_Config {
    var $arrConfig;

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
        $sql =<<<END
SELECT
    module_id,
    memo01 as cybs_request_url,
    memo02 as cybs_merchant_id,
    memo03 as cybs_key_path,
    memo04 as cybs_subs_use
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
        $arrData["memo01"] = $objForm->getValue('cybs_request_url');
        $arrData["memo02"] = $objForm->getValue('cybs_merchant_id');
        $arrData["memo03"] = $objForm->getValue('cybs_key_path');
        $arrData["memo04"] = $objForm->getValue('cybs_subs_use');
        $arrData["del_flg"] = "0";
        $arrData["creator_id"] = $objSess->member_id;
        $arrData["update_date"] = "NOW()";

        return $arrData;
    }
}
?>
