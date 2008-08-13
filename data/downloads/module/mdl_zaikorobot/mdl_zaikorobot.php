<?php
/**
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2008 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
/*
 * �⥸�塼��С������ɽ��
 * @version ### ### 1.0
 */
require_once(MODULE_PATH . "mdl_zaikorobot/mdl_zaikorobot.inc");

//�ڡ����������饹
class LC_Page {
    //���󥹥ȥ饯��
    function LC_Page() {
        //�ᥤ��ƥ�ץ졼�Ȥλ���
        $this->tpl_mainpage = MODULE_PATH . 'mdl_zaikorobot/mdl_zaikorobot.tpl';
        $this->tpl_subtitle = 'zaiko robotϢ�ȥ⥸�塼��';
    }
}
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objQuery = new SC_Query();

// ǧ�ڳ�ǧ
$objSess = new SC_Session();
sfIsSuccess($objSess);

// �ѥ�᡼���������饹
$objFormParam = new SC_FormParam();
$objFormParam = lfInitParam($objFormParam);
// POST�ͤμ���
$objFormParam->setParam($_POST);

// ���ѹ��ܤ��ɲ�(ɬ�ܡ���)
sfAlterMemo();

switch($_POST['mode']) {
case 'edit':
    // ���ϥ��顼Ƚ��
    $objPage->arrErr = lfCheckError();
    // ���顼�ʤ��ξ��
    if(count($objPage->arrErr) == 0) {
        // �ǡ�������
        sfZaikoSetModuleDB(MDL_ZAIKOROBOT_ID, $objFormParam);
        // ��ѷ�̼��եե�����Υ��ԡ�
        copy(MODULE_PATH. "mdl_zaikorobot/hunglead_stock.php", HTML_PATH. "user_data/hunglead_stock.php");
        // ��λ����
        $objPage->tpl_onload = 'alert("��Ͽ��λ���ޤ�����");window.close();';
    }
    break;
default:
    // �ǡ����Υ���
    lfLoadData();	
    break;
}

$objPage->arrForm = $objFormParam->getFormParamList();

$objView->assignobj($objPage);
$objView->display($objPage->tpl_mainpage);

//-----------------------------------------------------------------------

/**
 * �ѥ�᡼������ν����
 */ 
function lfInitParam($objFormParam) {
    $objFormParam->addParam("ID", "id", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�ѥ����", "pass", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));	
    return $objFormParam;
}

/**
 * ���顼�����å�
 */
function lfCheckError() {
    global $objFormParam;
    $arrErr = $objFormParam->checkError();
    return $arrErr;
}

/**
 * ��Ͽ�ǡ����μ���
 */
function lfLoadData() {
    global $objFormParam;
    //�ǡ��������
    $arrRet = sfZaikoGetModuleDB(MDL_ZAIKOROBOT_ID);
    // �ͤ򥻥å�
    $objFormParam->setParam($arrRet);
}

?>