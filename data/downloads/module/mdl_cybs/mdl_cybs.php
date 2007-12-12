<?php
require_once 'mdl_cybs.inc';
require_once 'class/mdl_cybs_config.php';

class LC_Page {
    //���󥹥ȥ饯��
    function LC_Page() {
        //�ᥤ��ƥ�ץ졼�Ȥλ���
        $this->tpl_mainpage = MODULE_PATH . 'mdl_cybs/mdl_cybs.tpl';
        $this->tpl_subtitle = '�����С���������ѥ⥸�塼��';
        $this->extension_installed = lfIsInstalledCybsExt();
    }
}

$objPage = new LC_Page;
$objView = new SC_AdminView;

$objForm = lfInitParam();
$objPage->arrForm = $objForm->getFormParamList();

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
    $objPage->tpl_onload = 'alert("��Ͽ��λ���ޤ�����"); window.close();';
    break;

// �⥸�塼��κ��
case 'module_del':
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
function lfInitParam($arrParam = null) {
    $objForm = new SC_FormParam;
    $objForm->addParam('�ꥯ��������', 'cybs_request_url', INT_LEN, '', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('�ޡ�������ID', 'cybs_merchant_id', MTEXT_LEN, '', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objForm->addParam('����������ѥ�', 'cybs_key_path', MTEXT_LEN, '', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'), MDL_CYBS_KEY_PATH);
    $objForm->addParam('���֥�����ץ���󥵡��ӥ�', 'cybs_subs_use', INT_LEN, '', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));

    if (empty($arrParam)) {
        $arrParam = $_POST;
    }
    $objForm->setParam($arrParam);
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

    $mid = $objForm->getValue('cybs_merchant_id');
    $basePath = $objForm->getValue('cybs_key_path');
    $arrFileTypes = array('crt', 'pvt', 'pwd');

    // �����������¸�ߥ����å�
    $notFound = false;
    foreach ($arrFileTypes as $fileType) {
        // /opt/CyberSource/SDK/keys/***.crt
        $path = $basePath . $mid . '.' . $fileType;
        if (!file_exists($path)) {
            $notFound = true;
            break;
        }
    }
    if ($notFound) {
        return array('cybs_key_path' => $path . "�����Ĥ���ޤ���<br>");
    }
    return null;
}

/**
 * mod_cybs�����󥹥ȡ���Ѥߤ������å�����.
 *
 * @return boolean
 */
function lfIsInstalledCybsExt() {
    if (!extension_loaded(MDL_CYBS_EXT)) {
        if (!dl(MDL_CYBS_EXT)) {
            return false;
        }
    }
    return true;
}
?>
