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

$arrList[] = sfCheckDataPath();

$objPage->arrList = $arrList;

$objView->assignobj($objPage);					//�ѿ���ƥ�ץ졼�Ȥ˥������󤹤�
$objView->display($objPage->tpl_mainpage);		//�ƥ�ץ졼�Ȥν���
//-------------------------------------------------------------------------------------------------------
// ����ե�����(data)�Υѥ��������ѥ��Ǥʤ�����ǧ����
function sfCheckDataPath() {
    // �ɥ�����ȥ롼�ȤΥѥ����¬���롣
    $doc_root = ereg_replace(URL_DIR . "$","/",HTML_PATH);
    $arrResult['title'] = "����ե��������¸�ѥ�";
    
    $data_path = realpath(DATA_PATH);
    
    $arrResult['result'] = $data_path;
    
    
    return $arrResult;
}

?>