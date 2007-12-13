<?php
/**
 * 
 * @copyright	2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 * @version	CVS: $Id: mdl_epsilon.php 1.3 2007-12-13 11:50:00Z satou $
 * @link		http://www.lockon.co.jp/
 *
 */

require_once(MODULE_PATH . "mdl_paygent/mdl_paygent.inc");

$arrPayment = array(
	1 => '���쥸�å�',
	2 => '����ӥ�',
	3 => 'ATM���',
	4 => '��ԥͥå�'
);

$arrCredit = array(
	1 => 'VISA, MASTER, Diners',
	2 => 'JCB, AMEX'
);
	
//�ڡ����������饹
class LC_Page {
	//���󥹥ȥ饯��
	function LC_Page() {
		//�ᥤ��ƥ�ץ졼�Ȥλ���
		$this->tpl_mainpage = MODULE_PATH . 'mdl_paygent/mdl_paygent.tpl';
		$this->tpl_subtitle = '�ڥ�������ȷ�ѥ⥸�塼��';
		global $arrPayment;
		$this->arrPayment = $arrPayment;
		global $arrCredit;
		$this->arrCredit = $arrCredit;
		global $arrConvenience;
		$this->arrConvenience = $arrConvenience;
	}
}
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objQuery = new SC_Query();

// ����ӥ���������å�
lfEpsilonCheck();

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
		lfUpdPaymentDB(MDL_PAYGENT_ID);
		
		// javascript�¹�
		$objPage->tpl_onload = 'alert("��Ͽ��λ���ޤ�����\n���ܾ�����ʧ��ˡ������ܺ�����򤷤Ƥ���������"); window.close();';
	}
	break;
case 'module_del':
	// ���ѹ��ܤ�¸�ߥ����å�
	if(sfColumnExists("dtb_payment", "memo01")){
		// �ǡ����κ���ե饰�򤿤Ƥ�
		$objQuery->query("UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ?", array(MDL_EPSILON_ID));
	}
	break;
default:
	// �ǡ����Υ���
	lfLoadData();	
	break;
}

$objPage->arrForm = $objFormParam->getFormParamList();

$objView->assignobj($objPage);					//�ѿ���ƥ�ץ졼�Ȥ˥������󤹤�
$objView->display($objPage->tpl_mainpage);		//�ƥ�ץ졼�Ȥν���
//-------------------------------------------------------------------------------------------------------
/* �ѥ�᡼������ν���� */
function lfInitParam($objFormParam) {
    $arrSiteInfo = sf_getBasisData();
    // �ǥե������
    $arrDefault  = array(
        'conveni_limit_date' => 15,
        'atm_limit_date'     => 30,
        'payment_detail' => $arrSiteInfo['shop_kana'],
        'claim_kanji'    => $arrSiteInfo['shop_kana'],
        'claim_kana'     => $arrSiteInfo['shop_kana'],
        'asp_payment_term' => 7,
    );
	$objFormParam->addParam("�ޡ�������ID", "merchant_id", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
	$objFormParam->addParam("��³ID", "connect_id", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
	$objFormParam->addParam("��³�ѥ����", "connect_password", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));
	$objFormParam->addParam("��ʧ������", "conveni_limit_date", 2, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"), $arrDefault['conveni_limit_date']);
	$objFormParam->addParam("��ʧ������", "atm_limit_date", 2, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"), $arrDefault['atm_limit_date']);
	$objFormParam->addParam("ɽ��Ź��̾(����)", "payment_detail", 12, "KVa", array("MAX_LENGTH_CHECK", "KANA_CHECK"), $arrDefault['payment_detail']);
	$objFormParam->addParam("��ʧ������", "asp_payment_term", 2, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"), $arrDefault['asp_payment_term']);
	$objFormParam->addParam("ɽ��Ź��̾(����)", "claim_kanji", 12, "KVa", array("MAX_LENGTH_CHECK"), $arrDefault['claim_kanji']);
	$objFormParam->addParam("ɽ��Ź��̾(����)", "claim_kana", 12, "KVa", array("MAX_LENGTH_CHECK", "KANA_CHECK"), $arrDefault['claim_kana']);
	$objFormParam->addParam("���ѷ��", "payment", "", "", array("EXIST_CHECK"));
	$objFormParam->addParam("��ѥڡ����ѥ��ԡ��饤��(Ⱦ�ѱѿ�)", "copy_right", 64, "KVa", array("MAX_LENGTH_CHECK"));
	$objFormParam->addParam("��ѥڡ���������ʸ(����)", "free_memo", 128, "KVa", array("MAX_LENGTH_CHECK"));	
	return $objFormParam;
}
	
// ���顼�����å���Ԥ�
function lfCheckError(){
	global $objFormParam;
	$arrErr = $objFormParam->checkError();
		
	if($_POST['conveni_limit_date'] != "" && !($_POST['conveni_limit_date'] >= 1 &&  $_POST['conveni_limit_date'] <= 60)) {
			$arrErr['conveni_limit_date'] = "�� ��ʧ�������ϡ�1��60���ޤǤδ֤����ꤷ�Ƥ���������<br>";
	}
	if($_POST['atm_limit_date'] != "" && !($_POST['atm_limit_date'] >= 0 &&  $_POST['atm_limit_date'] <= 60)) {
			$arrErr['atm_limit_date'] = "�� ��ʧ�������ϡ�0��60���ޤǤδ֤����ꤷ�Ƥ���������<br>";
	}
    if(isset($_POST['payment_detail']) && $_POST['payment_detail'] == '') {
            $arrErr['payment_detail'] = "�� ɽ��Ź��̾(����)�����Ϥ��Ƥ���������<br>";
    }
    if(isset($_POST['claim_kanji']) && $_POST['claim_kanji'] == '') {
            $arrErr['claim_kanji'] = "�� ɽ��Ź��̾�ʴ����ˤ����Ϥ��Ƥ���������<br>";
    }
    if(isset($_POST['claim_kana']) && $_POST['claim_kana'] == '') {
            $arrErr['claim_kana'] = "�� ɽ��Ź��̾�ʥ��ʡˤ����Ϥ��Ƥ���������<br>";
    }
	
    
    
    /** ������ʸ **/	
	// �ޡ�������ID
	$arrParam['merchant_id'] = $objFormParam->getValue('merchant_id');
	// ��³ID
	$arrParam['connect_id'] = $objFormParam->getValue('connect_id');
	// ��³�ѥ����
	$arrParam['connect_password'] = $objFormParam->getValue('connect_password');

	// ��³�ƥ��Ȥ�¹Ԥ��롣
	if(!sfPaygentTest($arrParam)) {
		$arrErr['err'] = "�� ��³��˼��Ԥ��ޤ�����";
	}	
	
	return $arrErr;
}

// ��Ͽ�ǡ������ɤ߹���
function lfLoadData(){
	global $objFormParam;
	
	//�ǡ��������
	$arrRet = sfGetPaymentDB(MDL_PAYGENT_ID, "AND del_flg = '0'");
	$objFormParam->setParam($arrRet[0]);
	
	
	// ����ɽ���Ѥ˥ǡ������Ѵ�
	$arrDisp = array();
	
	foreach($arrRet as $key => $val){
		// ���ѷ�Ѥ�ɽ���Ѥ��Ѵ�
		$arrDisp["payment"][$key] = $val["payment"];
		
		switch($val['payment']) {
		// ���쥸�å�
		case '1':
			break;
		// ����ӥ�
		case '2':
			$arrParam = unserialize($val['other_param']);
			$arrDisp['conveni_limit_date'] = $arrParam['payment_limit_date'];
			break;
		// ATM���
		case '3':
			$arrParam = unserialize($val['other_param']);
			$arrDisp['payment_detail'] = $arrParam['payment_detail'];
			$arrDisp['atm_limit_date'] = $arrParam['payment_limit_date'];
			break;
		// �ͥåȥХ�
		case '4':
			$arrParam = unserialize($val['other_param']);
			$arrDisp['claim_kana'] = $arrParam['claim_kana'];
			$arrDisp['claim_kanji'] = $arrParam['claim_kanji'];
			$arrDisp['asp_payment_term'] = $arrParam['asp_payment_term'];
			$arrDisp['copy_right'] = $arrParam['copy_right'];
			$arrDisp['free_memo'] = $arrParam['free_memo'];
			break;					
		}
	}	
	
	$objFormParam->setParam($arrDisp);
}

// �ǡ����ι�������
function lfUpdPaymentDB($module_id){
	global $objQuery;
	global $objSess;
		
	// ��Ϣ�����ʧ����ˡ��del_flg�����ˤ��Ƥ���
	$del_sql = "UPDATE dtb_payment SET del_flg = 1 WHERE module_id = ? ";
	$arrDel = array($module_id);
	$objQuery->query($del_sql, $arrDel);
	
	// �ǡ�����Ͽ
	foreach($_POST["payment"] as $key => $val){
		// ��󥯤κ����ͤ��������
		$max_rank = $objQuery->getone("SELECT max(rank) FROM dtb_payment");

		// ��ʧ��ˡ�ǡ��������			
		$arrPaymentData = sfGetPaymentDB(MDL_PAYGENT_ID, "AND memo03 = ?", array($val));
		
		// ���쥸�åȤ˥����å������äƤ���Х��쥸�åȤ���Ͽ����
		if($val == 1){
			$arrData = array(			
				"payment_method" => "PAYGENT���쥸�å�"
				,"fix" => 3
				,"creator_id" => $objSess->member_id
				,"create_date" => "now()"
				,"update_date" => "now()"
				,"upper_rule" => 500000
				,"module_id" => $module_id
				,"module_path" => MODULE_PATH . "mdl_paygent/paygent_credit.php"
				,"memo01" => $_POST["merchant_id"]
				,"memo02" => $_POST["connect_id"]
				,"memo03" => $val
				,"memo04" => $_POST["connect_password"]
				,"memo05" => ""
				,"del_flg" => "0"
				,"charge_flg" => "2"
				,"upper_rule_max" => CHARGE_MAX
				
			);
		}
		
		// ����ӥˤ˥����å������äƤ���Х���ӥˤ���Ͽ����
		if($val == 2){
			$arrParam = array();
			$arrParam['payment_limit_date'] = $_POST['conveni_limit_date'];
			
			$arrData = array(
				"payment_method" => "PAYGENT����ӥ�"
				,"fix" => 3
				,"creator_id" => $objSess->member_id
				,"create_date" => "now()"
				,"update_date" => "now()"
				,"upper_rule" => $upper_rule
				,"module_id" => $module_id
				,"module_path" => MODULE_PATH . "mdl_paygent/paygent_conveni.php"
				,"memo01" => $_POST["merchant_id"]
				,"memo02" => $_POST["connect_id"]
				,"memo03" => $val
				,"memo04" => $_POST["connect_password"]
				,"memo05" => serialize($arrParam)
				,"del_flg" => "0"
				,"charge_flg" => "1"
				,"upper_rule_max" => $upper_rule_max
			);
		}
		
		// ATM��Ѥ˥����å������äƤ����ATM��Ѥ���Ͽ����
		if($val == 3){
			$arrParam = array();
			$arrParam['payment_detail'] = $_POST['payment_detail'];
			$arrParam['payment_limit_date'] = $_POST['atm_limit_date'];
			
			$arrData = array(
				"payment_method" => "PAYGENTATM���"
				,"fix" => 3
				,"creator_id" => $objSess->member_id
				,"create_date" => "now()"
				,"update_date" => "now()"
				,"upper_rule" => $upper_rule
				,"module_id" => $module_id
				,"module_path" => MODULE_PATH . "mdl_paygent/paygent_atm.php"
				,"memo01" => $_POST["merchant_id"]
				,"memo02" => $_POST["connect_id"]
				,"memo03" => $val
				,"memo04" => $_POST["connect_password"]
				,"memo05" => serialize($arrParam)
				,"del_flg" => "0"
				,"charge_flg" => "1"
				,"upper_rule_max" => $upper_rule_max
			);
		}
		
		// ���NET�˥����å������äƤ����ATM��Ѥ���Ͽ����
		if($val == 4){
			$arrParam = array();
			$arrParam['claim_kana'] = $_POST['claim_kana'];
			$arrParam['claim_kanji'] = $_POST['claim_kanji'];
			$arrParam['asp_payment_term'] = $_POST['asp_payment_term'];
			$arrParam['copy_right'] = $_POST['copy_right'];
			$arrParam['free_memo'] = $_POST['free_memo'];
			$arrData = array(
				"payment_method" => "PAYGENT��ԥͥå�"
				,"fix" => 3
				,"creator_id" => $objSess->member_id
				,"create_date" => "now()"
				,"update_date" => "now()"
				,"upper_rule" => $upper_rule
				,"module_id" => $module_id
				,"module_path" => MODULE_PATH . "mdl_paygent/paygent_bank.php"
				,"memo01" => $_POST["merchant_id"]
				,"memo02" => $_POST["connect_id"]
				,"memo03" => $val
				,"memo04" => $_POST["connect_password"]
				,"memo05" => serialize($arrParam)
				,"del_flg" => "0"
				,"charge_flg" => "1"
				,"upper_rule_max" => $upper_rule_max
			);
		}
		
		
		// �ǡ�����¸�ߤ��Ƥ����UPDATE��̵�����INSERT
		if(count($arrPaymentData) > 0){
			$objQuery->update("dtb_payment", $arrData, " module_id = '" . $module_id . "' AND memo03 = '" . $val ."'");
		}else{
			$arrData["rank"] = $max_rank + 1;
			$objQuery->insert("dtb_payment", $arrData);
		}
	}
}

// ����ӥ������ǧ����
function lfEpsilonCheck(){
	global $objQuery;
	
	// trans_code ����ꤵ��Ƥ��Ƴ�ġ�����Ѥߤξ��
	if($_POST["trans_code"] != "" and $_POST["paid"] == 1 and $_POST["order_number"] != ""){
		// ���ơ�����������Ѥߤ��ѹ�����
		$sql = "UPDATE dtb_order SET status = 6, update_date = now() WHERE order_id = ? AND memo04 = ? ";
		$objQuery->query($sql, array($_POST["order_number"], $_POST["trans_code"]));
		
		// POST�����Ƥ����ƥ���¸
		$log_path = DATA_PATH . "logs/epsilon.log";
		gfPrintLog("epsilon conveni start---------------------------------------------------------", $log_path);
		foreach($_POST as $key => $val){
			gfPrintLog( "\t" . $key . " => " . $val, $log_path);
		}
		gfPrintLog("epsilon conveni end-----------------------------------------------------------", $log_path);
		
		//������̤�ɽ��
		echo "1";
	}
}

?>