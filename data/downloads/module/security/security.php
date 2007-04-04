<?php
/**
 * 
 * @copyright	2000-2006 LOCKON CO.,LTD. All Rights Reserved.
 * @version	CVS: $Id: ebis_tag.php,v 1.0 2006/10/26 04:02:40 naka Exp $
 * @link		http://www.lockon.co.jp/
 *
 */
 
//�ڡ����������饹
class LC_Page {
	//���󥹥ȥ饯��
	function LC_Page() {
		//�ᥤ��ƥ�ץ졼�Ȥλ���
		$this->tpl_mainpage = MODULE_PATH . 'security/security.tpl';
		$this->tpl_subtitle = '�������ƥ������å�';
	}
}

$objPage = new LC_Page();
$objView = new SC_AdminView();
$objQuery = new SC_Query();

$arrList[] = sfCheckOpenData();
$arrList[] = sfCheckInstall();

$objPage->arrList = $arrList;

$objView->assignobj($objPage);					//�ѿ���ƥ�ץ졼�Ȥ˥������󤹤�
$objView->display($objPage->tpl_mainpage);		//�ƥ�ץ졼�Ȥν���
//-------------------------------------------------------------------------------------------------------
// ����ե�����(data)�Υѥ��������ѥ��Ǥʤ�����ǧ����
function sfCheckOpenData() {
    // �ɥ�����ȥ롼�ȤΥѥ����¬���롣
    $doc_root = ereg_replace(URL_DIR . "$","/",HTML_PATH);
    $data_path = realpath(DATA_PATH);
    
    // data�Υѥ����ɥ�����ȥ롼�Ȱʲ��ˤ��뤫Ƚ��
    if(ereg("^".$doc_root, $data_path)) {
        $arrResult['result'] = "��";
        $arrResult['detail'] = "����ե����뤬����������Ƥ����ǽ��������ޤ���<br>";
        $arrResult['detail'].= "/data/�ǥ��쥯�ȥ�ϡ�������Υѥ������֤��Ʋ�������";
    } else {
        $arrResult['result'] = "��";
        $arrResult['detail'] = "����ե�����ϡ������ѥ��۲���¸�ߤ��ޤ���";        
    }
    
    $arrResult['title'] = "����ե��������¸�ѥ�";
    return $arrResult;
}

// ���󥹥ȡ���ե����뤬¸�ߤ��뤫��ǧ����
function sfCheckInstall() {
    // ���󥹥ȡ���ե������¸�ߥ����å�
    $inst_path = HTML_PATH . "install/index.php";
    
    if(file_exists($inst_path)) {
        $arrResult['result'] = "��";
        $arrResult['detail'] = "/install/index.php�ϡ����󥹥ȡ��봰λ��˥ե�����������Ƥ���������";            
    } else {
        $arrResult['result'] = "��";
        $arrResult['detail'] = "/install/index.php�ϡ����Ĥ���ޤ���Ǥ�����";    
    }
}
?>