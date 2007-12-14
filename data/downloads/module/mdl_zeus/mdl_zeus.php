<?php
/**
 * 
 * @copyright    2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 * @version CVS: $Id: 1.0 2006-06-04 06:38:01Z kakinaka $ 
 * @link        http://www.lockon.co.jp/
 *
 */
require_once(MODULE_PATH . "mdl_zeus/mdl_zeus.inc");

//�ڡ����������饹
class LC_Page {
    //���󥹥ȥ饯��
    function LC_Page() {
        //�ᥤ��ƥ�ץ졼�Ȥλ���
        $this->tpl_mainpage = MODULE_PATH . 'mdl_zeus/mdl_zeus.tpl';
        $this->tpl_subtitle = '��������ѥ⥸�塼��';
    }
}
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objQuery = new SC_Query();

// ���쥸�åȥ����å�
lfZeroCheck();

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
        $objQuery->query("UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ?", array(MDL_ZERO_ID));
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
    $objFormParam->addParam("����ŹIP������", "clientip", CLIENTIP_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "SPTAB_CHECK"));
    return $objFormParam;
}

// ���顼�����å���Ԥ�
function lfCheckError(){
    global $objFormParam;
    
    $arrErr = $objFormParam->checkError();
    
    // ��³�����å���Ԥ�
    //if(count($arrErr) == 0) $arrErr = lfChkConnect();
    
    return $arrErr;
}

// ��³�����å���Ԥ�
function lfChkConnect(){
    $arrRet = array();
    
    // PC�Ǥ���³��ǧ
    if($_POST["pc"]){
        // �����ǡ�������
        $arrSendData = array(
            'clientip' => $_POST["pc_clientip"],    // ���ȥ�����
            'custom' => SEND_PARAM_CUSTOM,            // yes����
            'send' => $_POST["pc_send"],            // ����Ź������
            'money' => 0                            // ���
        );
/*
        // �ǡ�������
        $arrResponse = sfPostPaymentData(SEND_PARAM_PC_URL, $arrSendData, false);
        
        // ���顼�����뤫�����å�����
        if(!ereg("^<HTML>",$arrResponse )){
            $arrRet["pc_clientip"] = "���ϥǡ���������������ޤ���<br>";
        }
*/
    }

    // �����Ǥ���³��ǧ
    if($_POST["mobile"]){
        // �����ǡ�������
        $arrSendData = array(
            'clientip' => $_POST["mobile_clientip"],    // ���ȥ�����
            'act' => SEND_PARAM_ACT,                    // imode����
            'money' => 0                                // ���
        );
/*        
        // �ǡ�������
        $arrResponse = sfPostPaymentData(SEND_PARAM_MOBILE_URL, $arrSendData, false);
        
        // ���顼�����뤫�����å�����
        if(!ereg("^<HTML>",$arrResponse )){
            $arrRet["mobile_clientip"] = "���ϥǡ���������������ޤ���<br>";
        }
*/
    }
    
    return $arrRet;    
}

// ��Ͽ�ǡ������ɤ߹���
function lfLoadData(){
    global $objFormParam;
    
    //�ǡ��������
    $arrRet = lfGetPaymentDB(" AND del_flg = '0'");
    
    // �ͤ򥻥å�
    $objFormParam->setParam($arrRet[0]);

    // ����ɽ���Ѥ˥ǡ������Ѵ�
    $arrDisp = array();
    $arrDisp = $arrRet[0];
    if (!empty($arrDisp["pc_send"])) $arrDisp["pc"] = 1;
    if (!empty($arrDisp["mobile_send"])) $arrDisp["mobile"] = 1;
    $objFormParam->setParam($arrDisp);
}

// DB����ǡ������������
function lfGetPaymentDB($where = "", $arrWhereVal = array()){
    global $objQuery;
    
    $arrVal = array(MDL_ZEUS_ID);
    $arrVal = array_merge($arrVal, $arrWhereVal);
    
    $arrRet = array();
    $sql = "SELECT 
                module_id, 
                memo01 as clientip
            FROM dtb_payment WHERE module_id = ? " . $where;
    $arrRet = $objQuery->getall($sql, $arrVal);

    return $arrRet;
}


// �ǡ����ι�������
function lfUpdPaymentDB(){
    global $objQuery;
    global $objSess;
    $arrData = array();

    // del_flg�����ˤ��Ƥ���
    $del_sql = "UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ? ";
    $arrDel = array(MDL_ZEUS_ID);
    $objQuery->query($del_sql, $arrDel);

    // �ǡ�����Ͽ
	$arrData["payment_method"] = "Zeus���쥸�å�";
	$arrData["fix"] = 3;
	$arrData["creator_id"] = $objSess->member_id;
	$arrData["update_date"] = "now()";
	$arrData["module_id"] = MDL_ZEUS_ID;
	$arrData["module_path"] = MODULE_PATH . "mdl_zeus/zeus_credit.php";
	$arrData["memo01"] = $_POST["clientip"];
	$arrData["memo03"] = MDL_ZEUS_ID;
	$arrData["del_flg"] = "0";
    
    // �����ǡ���������й������롣
    if(count($arrData) > 0){
	    // ��󥯤κ����ͤ��������
	    $max_rank = $objQuery->getone("SELECT max(rank) FROM dtb_payment");
	    
	    // ��ʧ��ˡ�ǡ��������
	    $arrPaymentData = lfGetPaymentDB();
	    
	    // �ǡ�����¸�ߤ��Ƥ����UPDATE��̵�����INSERT
	    if(count($arrPaymentData) > 0){
            $objQuery->update("dtb_payment", array("memo01"=>"","memo02"=>"","memo03"=>"","memo04"=>"","memo05"=>""), " module_id = '" . MDL_ZEUS_ID . "'");
	        $objQuery->update("dtb_payment", $arrData, " module_id = '" . MDL_ZEUS_ID . "'");
	    }else{
	        $arrData["rank"] = $max_rank + 1;
	        $objQuery->insert("dtb_payment", $arrData);
	    }
    }
}


function lfZeroCheck(){
    if(!empty($_GET["clientip"])){
        global $objPage;
        global $objView;
        global $objQuery;
        require_once(MODULE_PATH . "mdl_zero/recv.php");
        exit();
    }
}


?>