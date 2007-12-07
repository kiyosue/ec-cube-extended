<?php
/**
 * 
 * @copyright    2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 * @version CVS: $Id$ 
 * @link        http://www.lockon.co.jp/
 *
 */
require_once(MODULE_PATH . "mdl_gmo-pg/mdl_gmo-pg.inc");

//�ڡ����������饹
class LC_Page {
    //���󥹥ȥ饯��
    function LC_Page() {
        //�ᥤ��ƥ�ץ졼�Ȥλ���
        $this->tpl_mainpage = MODULE_PATH . 'mdl_gmo-pg/mdl_gmo-pg.tpl';
        $this->tpl_subtitle = 'GMO�ڥ����ȥ����ȥ�������ѥ⥸�塼��';
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
	
    // ���顼�ʤ��ξ��ˤϥǡ����򹹿�    
    if(count($objPage->arrErr) == 0) {
        // �ǡ�������
        lfUpdPaymentDB();
        
        // javascript�¹�
        $objPage->tpl_onload = 'alert("��Ͽ��λ���ޤ�����\n���ܾ�����ʧ��ˡ������ܺ�����򤷤Ƥ���������"); window.close();';
    }
    break;
case 'module_del':
    // ���ѹ��ܤ�¸�ߥ����å�
    if(sfColumnExists("dtb_payment", "memo01")){
        // �ǡ����κ���ե饰�򤿤Ƥ�
        $objQuery->query("UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ?", array(MDL_GMOPG_ID));
    }
    break;
default:
    // �ǡ����Υ���
    lfLoadData();    
    break;
}

$objPage->arrForm = $objFormParam->getFormParamList();

$objView->assignobj($objPage);                    //�ѿ���ƥ�ץ졼�Ȥ˥������󤹤�
$objView->display($objPage->tpl_mainpage);        //�ƥ�ץ졼�Ȥν���
//-------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam($objFormParam) {
	/* Ⱦ�ѱѿ���13 ����� */
    $objFormParam->addParam("����å�IP", "gmo_shopid", 13, "KVa", array("EXIST_CHECK", "ALNUM_CHECK", "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
	/* Ⱦ�ѱѿ���10 ����� */
    $objFormParam->addParam("����åץѥ���� ", "gmo_shoppass", 10, "KVa", array("EXIST_CHECK", "ALNUM_CHECK",  "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
	/* Ⱦ�ѱѿ���10 ����� */
    $objFormParam->addParam("Ź�޴����ֹ�", "gmo_tenantno", 10, "KVa", array("EXIST_CHECK", "ALNUM_CHECK",  "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
    return $objFormParam;
}

// ���顼�����å���Ԥ�
function lfCheckError(){
    global $objFormParam;
    
    $arrErr = $objFormParam->checkError();
    
    return $arrErr;
}

// ��Ͽ�ǡ������ɤ߹���
function lfLoadData(){
    global $objFormParam;
    
    //�ǡ��������
    $arrRet = sfGetPaymentDB("AND del_flg = '0'");
    
    // �ͤ򥻥å�
    $objFormParam->setParam($arrRet[0]);

    // ����ɽ���Ѥ˥ǡ������Ѵ�
    $arrDisp = array();
    $arrDisp = $arrRet[0];
    if (!empty($arrDisp["pc_send"])) $arrDisp["pc"] = 1;
    if (!empty($arrDisp["mobile_send"])) $arrDisp["mobile"] = 1;
    $objFormParam->setParam($arrDisp);
}

// �ǡ����ι�������
function lfUpdPaymentDB(){
    global $objQuery;
    global $objSess;

    // del_flg�����ˤ��Ƥ���
    $del_sql = "UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ? ";
    $objQuery->query($del_sql, array(MDL_GMOPG_ID));

    // �ǡ�����Ͽ
    $arrData = array();    
    $arrData["payment_method"] = "�ڥ����ȥ����ȥ��������쥸�å�";
	$arrData["fix"] = 3;
	$arrData["module_id"] = MDL_GMOPG_ID;
	$arrData["module_path"] = MODULE_PATH . "mdl_gmo-pg/gmo-pg_credit.php";
	$arrData["memo01"] = $_POST["gmo_shopid"];
	$arrData["memo02"] = $_POST["gmo_shoppass"];
	$arrData["memo03"] = $_POST["gmo_tenantno"];
	$arrData["memo04"] = "";
	$arrData["memo05"] = "";
	$arrData["del_flg"] = "0";
	$arrData["creator_id"] = $objSess->member_id;
	$arrData["update_date"] = "now()";
    
    // ��󥯤κ����ͤ��������
    $max_rank = $objQuery->getone("SELECT max(rank) FROM dtb_payment");
	$arrData['rank'] = $max_rank;
    
    // �����ǡ���������й������롣
    if(count($arrData) > 0){
	    // ��ʧ��ˡ�ǡ��������
	    $arrPaymentData = sfGetPaymentDB();	    
	    // �ǡ�����¸�ߤ��Ƥ����UPDATE��̵�����INSERT
	    if(count($arrPaymentData) > 0){
 	        $objQuery->update("dtb_payment", $arrData, " module_id = '" . MDL_GMOPG_ID . "'");
	    }else{
		    $objQuery->insert("dtb_payment", $arrData);
	    }
    }
}
?>