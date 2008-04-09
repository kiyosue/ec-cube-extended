<?php
/**
 * �⥸�塼��С������ɽ��
 * @version CVS: $Id$
 */
require_once 'mdl_cybs.inc';
require_once 'class/mdl_cybs_config.php';

class LC_Page {
    //���󥹥ȥ饯��
    function LC_Page() {
        //�ᥤ��ƥ�ץ졼�Ȥλ���
        $this->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs.tpl';
        $this->tpl_subtitle = '�����С���������ѥ⥸�塼��';
        $this->extension_installed = sfCybsLoadModCybs();
    }
}

$objPage = new LC_Page;
$objView = new SC_AdminView;

$objForm = lfInitParam($_POST);
$objPage->arrForm = $objForm->getFormParamList();

sfAlterMemo(); // dtb_memo��memo�������ɲä���

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
switch($mode) {
// ���Ϲ��ܤ���Ͽ
case 'edit':
    if ($arrErr = lfCheckError($objForm)) {
        $objPage->arrErr = $arrErr;
        break;
    }

    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $objConfig->registerConfig($objConfig->createSqlArray($objForm));
    lfCreateBatchIdTable();
    $objPage->tpl_onload = 'alert("��Ͽ��λ���ޤ�����\n���ܾ�����ʧ��ˡ������ܺ�����򤷤Ƥ���������"); window.close();';
    break;

// �̾�ɽ��
default:
    // DB����Ͽ�ͤ��������.
    $objConfig =& Mdl_Cybs_Config::getInstanse();
    $arrConfig = $objConfig->getConfig();

    // DB���ͤ���Ͽ����Ƥ���Ф����ͤ�ɽ��������
    if (!empty($arrConfig)) {
        $objForm = lfInitParam($arrConfig);
        $objPage->arrForm = $objForm->getFormParamList();
    }
}

$objView->assignObj($objPage);
$objView->display($objPage->tpl_mainpage);
//sfPrintR($objView->_smarty->get_template_vars());

/**
 * �ѥ�᡼���ν����
 *
 * @param array
 * @return SC_FormParam
 */
function lfInitParam($arrParam) {
    $objForm = new SC_FormParam;
    $objForm->addParam('�ꥯ��������', 'cybs_request_url', INT_LEN, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('�ޡ�������ID', 'cybs_merchant_id', MTEXT_LEN, '', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����ǥޥ�ɲݶ�', 'cybs_ondemand_use', 1, '', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('3D�����奢ǧ��', 'cybs_3d_use', 1, '', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->setParam($arrParam);
    $objForm->convParam();
    return $objForm;
}
/**
 * ���顼�����å���Ԥ�
 *
 * @param SC_FormParam $objForm
 * @return array|null
 */
function lfCheckError($objForm) {
    $arrErr = $objForm->checkError();
    if ($arrErr) return $arrErr;

    return null;
}

/**
 * �Хå�ID�����ѤΥơ��֥���������
 *
 */
function lfCreateBatchIdTable() {
    $objQuery = new SC_Query();
    if (sfTabaleExists('dtb_cybs_batch_id')) {
        return;
    }
    $sql_mysql = "create table dtb_cybs_batch_id(batch_id int auto_increment primary key NOT NULL) TYPE=InnoDB;";
    $sql_pgsql = "create table dtb_cybs_batch_id(batch_id serial NOT NULL);";

    $sql = '';
    if (DB_TYPE == 'pgsql') {
        $sql = $sql_pgsql;
    } elseif (DB_TYPE == 'mysql') {
        $sql = $sql_mysql;
    }
    $objQuery->query($sql);
}

?>
