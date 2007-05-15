<?php 

require_once("../require.php");

class LC_Page {
    var $arrSession;
    var $tpl_mode;
    var $tpl_login_email;
    function LC_Page() {
        $this->tpl_mainpage = 'nonmember/index.tpl';
        global $arrPref;
        $this->arrPref = $arrPref;
        global $arrSex;
        $this->arrSex = $arrSex;
        global $arrJob;
        $this->arrJob = $arrJob;
        $this->tpl_onload = 'fnCheckInputDeliv();';
        
        /*
         session_start����no-cache�إå������������뤳�Ȥ�
         �����ץܥ�����ѻ���ͭ�������ڤ�ɽ�����������롣
         private-no-expire:���饤����ȤΥ���å������Ĥ��롣
        */
        session_cache_limiter('private-no-expire');             
    }
}

$conn = new SC_DBConn();
$objPage = new LC_Page();
$objView = new SC_MobileView();
$objSiteSess = new SC_SiteSession();
$objCartSess = new SC_CartSession();
$objCustomer = new SC_Customer();
$objCookie = new SC_Cookie();
$objFormParam = new SC_FormParam();         // �ե�������
lfInitParam();                              // �ѥ�᡼������ν����
$objFormParam->setParam($_POST);            // POST�ͤμ���
print_r($_POST);

if ($_POST["mode2"] == "deliv") {
            
            $objFormParam = new SC_FormParam();
            // �ѥ�᡼������ν����
           
            // POST�ͤμ���
            $objFormParam->setParam($_POST);
            $arrRet = $objFormParam->getHashArray();
            $sqlval = $objFormParam->getDbArray();
            
            // �����ͤμ���
            $objPage->arrForm = $objFormParam->getFormParamList();
            $objPage->arrErr = $arrErr;
           
           foreach($_POST as $key => $value){
               $objPage->arrAddr[0][$key] = $value;
           }
            lfRegistDataTemp($objPage->tpl_uniqid,$objPage->arrAddr[0]); 
            
            print("test-------------------------------------------<BR>");
            lfCopyDeliv($objPage->tpl_uniqid, $_POST);
           
            $objPage->tpl_mainpage = 'nonmember/nonmember_deliv.tpl';
            $objPage->tpl_title = '���Ϥ������';
        }
        
         if ($_POST["mode2"] == "customer_addr") {
            //print_r($_POST);
            if ($_POST['deli'] != "") {
           
           header("Location:" . gfAddSessionId("./payment.php"));
            exit;
    }else{
        // ���顼���֤�
        $arrErr['deli'] = '�� ���Ϥ�������򤷤Ƥ���������';
    }
         }
         
         function lfRegistData($uniqid) {
    global $objFormParam;
    $arrRet = $objFormParam->getHashArray();
    $sqlval = $objFormParam->getDbArray();
    
    // ��Ͽ�ǡ����κ���
    $sqlval['order_temp_id'] = $uniqid;
    $sqlval['order_birth'] = sfGetTimestamp($arrRet['year'], $arrRet['month'], $arrRet['day']);
    $sqlval['update_date'] = 'Now()';
    $sqlval['customer_id'] = '0';
    $sqlval['order_name01'] = $objPage->arrAddr[0]['name01'];
          
    // ��¸�ǡ����Υ����å�
    $objQuery = new SC_Query();
    $where = "order_temp_id = ?";
    $cnt = $objQuery->count("dtb_order_temp", $where, array($uniqid));
    // ��¸�ǡ������ʤ����
    if ($cnt == 0) {
        $sqlval['create_date'] = 'Now()';
        $objQuery->insert("dtb_order_temp", $sqlval);
    } else {
        $objQuery->update("dtb_order_temp", $sqlval, $where, array($uniqid));
    }
}

//���Ϥ��줿�����ǡ����١���dtb_order_temp�˳�Ǽ����
function lfRegistDataTemp($uniqid,$array) {
    global $objFormParam;
    $arrRet = $objFormParam->getHashArray();
    $sqlval = $objFormParam->getDbArray();
        
    // ��Ͽ�ǡ����κ���
    $sqlval['order_temp_id'] = $uniqid;
    $sqlval['order_birth'] = sfGetTimestamp($arrRet['year'], $arrRet['month'], $arrRet['day']);
    $sqlval['update_date'] = 'Now()';
    $sqlval['customer_id'] = '0';
    
    $sqlval['order_name01'] = $array['name01'];
    $sqlval['order_name02'] = $array['name02'];
    $sqlval['order_kana01'] = $array['kana01'];
    $sqlval['order_kana02'] = $array['kana02'];
    $sqlval['order_zip01'] = $array['zip01'];
    $sqlval['order_zip02'] = $array['zip02'];
    $sqlval['order_pref'] = $array['pref'];
    $sqlval['order_addr01'] = $array['addr01'];
    $sqlval['order_addr02'] = $array['addr02'];
    $sqlval['order_tel01'] = $array['tel01'];
    $sqlval['order_tel02'] = $array['tel02'];
    $sqlval['order_tel03'] = $array['tel03'];
    $sqlval['order_email'] = $array['email'];
    $sqlval['order_sex'] = $array['sex'];
          
    // ��¸�ǡ����Υ����å�
    $objQuery = new SC_Query();
    $where = "order_temp_id = ?";
    $cnt = $objQuery->count("dtb_order_temp", $where, array($uniqid));
    // ��¸�ǡ������ʤ����
    if ($cnt == 0) {
        $sqlval['create_date'] = 'Now()';
        $objQuery->insert("dtb_order_temp", $sqlval);
    } else {
        $objQuery->update("dtb_order_temp", $sqlval, $where, array($uniqid));
    }
}

/* �ѥ�᡼������ν���� */
function lfInitParam() {
    global $objFormParam;
    $objFormParam->addParam("��̾��������", "order_name01", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("��̾����̾��", "order_name02", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�եꥬ�ʡʥ�����", "order_kana01", STEXT_LEN, "KVCa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�եꥬ�ʡʥᥤ��", "order_kana02", STEXT_LEN, "KVCa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("͹���ֹ�1", "order_zip01", ZIP01_LEN, "n", array("EXIST_CHECK", "NUM_CHECK", "NUM_COUNT_CHECK"));
    $objFormParam->addParam("͹���ֹ�2", "order_zip02", ZIP02_LEN, "n", array("EXIST_CHECK", "NUM_CHECK", "NUM_COUNT_CHECK"));
    $objFormParam->addParam("��ƻ�ܸ�", "order_pref", INT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("����1", "order_addr01", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("����2", "order_addr02", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�����ֹ�1", "order_tel01", TEL_ITEM_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�����ֹ�2", "order_tel02", TEL_ITEM_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�����ֹ�3", "order_tel03", TEL_ITEM_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("FAX�ֹ�1", "order_fax01", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("FAX�ֹ�2", "order_fax02", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("FAX�ֹ�3", "order_fax03", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�᡼�륢�ɥ쥹", "order_email", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "NO_SPTAB", "MAX_LENGTH_CHECK", "EMAIL_CHECK", "EMAIL_CHAR_CHECK"));
    $objFormParam->addParam("�᡼�륢�ɥ쥹�ʳ�ǧ��", "order_email_check", STEXT_LEN, "KVa", array("EXIST_CHECK", "SPTAB_CHECK", "NO_SPTAB", "MAX_LENGTH_CHECK", "EMAIL_CHECK", "EMAIL_CHAR_CHECK"), "", false);
    $objFormParam->addParam("ǯ", "year", INT_LEN, "n", array("MAX_LENGTH_CHECK"), "", false);
    $objFormParam->addParam("��", "month", INT_LEN, "n", array("MAX_LENGTH_CHECK"), "", false);
    $objFormParam->addParam("��", "day", INT_LEN, "n", array("MAX_LENGTH_CHECK"), "", false);
    $objFormParam->addParam("����", "order_sex", INT_LEN, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("����", "order_job", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("�̤Τ��Ϥ���", "deliv_check", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("��̾��������", "deliv_name01", STEXT_LEN, "KVa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("��̾����̾��", "deliv_name02", STEXT_LEN, "KVa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�եꥬ�ʡʥ�����", "deliv_kana01", STEXT_LEN, "KVCa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�եꥬ�ʡʥᥤ��", "deliv_kana02", STEXT_LEN, "KVCa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("͹���ֹ�1", "deliv_zip01", ZIP01_LEN, "n", array("NUM_CHECK", "NUM_COUNT_CHECK"));
    $objFormParam->addParam("͹���ֹ�2", "deliv_zip02", ZIP02_LEN, "n", array("NUM_CHECK", "NUM_COUNT_CHECK"));
    $objFormParam->addParam("��ƻ�ܸ�", "deliv_pref", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"));
    $objFormParam->addParam("����1", "deliv_addr01", STEXT_LEN, "KVa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("����2", "deliv_addr02", STEXT_LEN, "KVa", array("SPTAB_CHECK", "MAX_LENGTH_CHECK"));
    $objFormParam->addParam("�����ֹ�1", "deliv_tel01", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�����ֹ�2", "deliv_tel02", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�����ֹ�3", "deliv_tel03", TEL_ITEM_LEN, "n", array("MAX_LENGTH_CHECK" ,"NUM_CHECK"));
    $objFormParam->addParam("�᡼��ޥ�����", "mail_flag", INT_LEN, "n", array("MAX_LENGTH_CHECK", "NUM_CHECK"), 1);
}

/* DB�إǡ�������Ͽ */

/* �������ƤΥ����å� */
function lfCheckError() {
    global $objFormParam;
    // ���ϥǡ������Ϥ���
    $arrRet =  $objFormParam->getHashArray();
    $objErr = new SC_CheckError($arrRet);
    $objErr->arrErr = $objFormParam->checkError();
        
    // �̤Τ��Ϥ�������å�
    if($_POST['deliv_check'] == "1") { 
        $objErr->doFunc(array("��̾��������", "deliv_name01"), array("EXIST_CHECK"));
        $objErr->doFunc(array("��̾����̾��", "deliv_name02"), array("EXIST_CHECK"));
        $objErr->doFunc(array("�եꥬ�ʡʥ�����", "deliv_kana01"), array("EXIST_CHECK"));
        $objErr->doFunc(array("�եꥬ�ʡʥᥤ��", "deliv_kana02"), array("EXIST_CHECK"));
        $objErr->doFunc(array("͹���ֹ�1", "deliv_zip01"), array("EXIST_CHECK"));
        $objErr->doFunc(array("͹���ֹ�2", "deliv_zip02"), array("EXIST_CHECK"));
        $objErr->doFunc(array("��ƻ�ܸ�", "deliv_pref"), array("EXIST_CHECK"));
        $objErr->doFunc(array("����1", "deliv_addr01"), array("EXIST_CHECK"));
        $objErr->doFunc(array("����2", "deliv_addr02"), array("EXIST_CHECK"));
        $objErr->doFunc(array("�����ֹ�1", "deliv_tel01"), array("EXIST_CHECK"));
        $objErr->doFunc(array("�����ֹ�2", "deliv_tel02"), array("EXIST_CHECK"));
        $objErr->doFunc(array("�����ֹ�3", "deliv_tel03"), array("EXIST_CHECK"));
    }
    
    // ʣ�����ܥ����å�
    $objErr->doFunc(array("TEL", "order_tel01", "order_tel02", "order_tel03", TEL_ITEM_LEN), array("TEL_CHECK"));
    $objErr->doFunc(array("FAX", "order_fax01", "order_fax02", "order_fax03", TEL_ITEM_LEN), array("TEL_CHECK"));
    $objErr->doFunc(array("͹���ֹ�", "order_zip01", "order_zip02"), array("ALL_EXIST_CHECK"));
    $objErr->doFunc(array("TEL", "deliv_tel01", "deliv_tel02", "deliv_tel03", TEL_ITEM_LEN), array("TEL_CHECK"));
    $objErr->doFunc(array("FAX", "deliv_fax01", "deliv_fax02", "deliv_fax03", TEL_ITEM_LEN), array("TEL_CHECK"));
    $objErr->doFunc(array("͹���ֹ�", "deliv_zip01", "deliv_zip02"), array("ALL_EXIST_CHECK"));
    $objErr->doFunc(array("��ǯ����", "year", "month", "day"), array("CHECK_DATE"));
    $objErr->doFunc(array("�᡼�륢�ɥ쥹", "�᡼�륢�ɥ쥹�ʳ�ǧ��", "order_email", "order_email_check"), array("EQUAL_CHECK"));
    
    // ���Ǥ˥��ޥ��ơ��֥�˲���Ȥ��ƥ᡼�륢�ɥ쥹����Ͽ����Ƥ�����
    if(sfCheckCustomerMailMaga($arrRet['order_email'])) {
        $objErr->arrErr['order_email'] = "���Υ᡼�륢�ɥ쥹�Ϥ��Ǥ���Ͽ����Ƥ��ޤ���<br>";
    }
        
    return $objErr->arrErr;
}

// �������ơ��֥�Τ��Ϥ���򥳥ԡ�����
function lfCopyDeliv($uniqid, $arrData) {
    $objQuery = new SC_Query();
    
    // �̤Τ��Ϥ������ꤷ�Ƥ��ʤ���硢���������Ͽ����򥳥ԡ����롣
    if($arrData["deliv_check"] != "1") {
        $sqlval['deliv_name01'] = $arrData['order_name01'];
        $sqlval['deliv_name02'] = $arrData['order_name02'];
        $sqlval['deliv_kana01'] = $arrData['order_kana01'];
        $sqlval['deliv_kana02'] = $arrData['order_kana02'];
        $sqlval['deliv_pref'] = $arrData['order_pref'];
        $sqlval['deliv_zip01'] = $arrData['order_zip01'];
        $sqlval['deliv_zip02'] = $arrData['order_zip02'];
        $sqlval['deliv_addr01'] = $arrData['order_addr01'];
        $sqlval['deliv_addr02'] = $arrData['order_addr02'];
        $sqlval['deliv_tel01'] = $arrData['order_tel01'];
        $sqlval['deliv_tel02'] = $arrData['order_tel02'];
        $sqlval['deliv_tel03'] = $arrData['order_tel03'];
        $where = "order_temp_id = ?";
        $objQuery->update("dtb_order_temp", $sqlval, $where, array($uniqid));
    }
}

//-----------------------------NONMEMBER�ؿ�����------------------------------------------------------------------
//----������ʸ������Ѵ�
function lfConvertParam($array, $arrRegistColumn) {
    /*
     *  ʸ������Ѵ�
     *  K :  ��Ⱦ��(�ʎݎ���)�Ҳ�̾�פ�������Ҳ�̾�פ��Ѵ�
     *  C :  �����ѤҤ鲾̾�פ�����Ѥ�����̾�פ��Ѵ�
     *  V :  �����դ���ʸ�����ʸ�����Ѵ���"K","H"�ȶ��˻��Ѥ��ޤ� 
     *  n :  �����ѡ׿������Ⱦ��(�ʎݎ���)�פ��Ѵ�
     *  a :  ���ѱѿ�����Ⱦ�ѱѿ������Ѵ�����
     */
    // �����̾�ȥ���С��Ⱦ���
    foreach ($arrRegistColumn as $data) {
        $arrConvList[ $data["column"] ] = $data["convert"];
    }
    // ʸ���Ѵ�
    foreach ($arrConvList as $key => $val) {
        // POST����Ƥ����ͤΤ��Ѵ����롣
        if(strlen(($array[$key])) > 0) {
            $array[$key] = mb_convert_kana($array[$key] ,$val);
        }
    }
    return $array;
}

//---- ���ϥ��顼�����å�
function lfErrorCheck1($array) {

    global $objConn;
    $objErr = new SC_CheckError($array);
    
    $objErr->doFunc(array("��̾��������", 'name01', STEXT_LEN), array("EXIST_CHECK", "NO_SPTAB", "SPTAB_CHECK" ,"MAX_LENGTH_CHECK"));
    $objErr->doFunc(array("��̾����̾��", 'name02', STEXT_LEN), array("EXIST_CHECK", "NO_SPTAB", "SPTAB_CHECK" , "MAX_LENGTH_CHECK"));
    $objErr->doFunc(array("��̾���ʥ���/����", 'kana01', STEXT_LEN), array("EXIST_CHECK", "NO_SPTAB", "SPTAB_CHECK" ,"MAX_LENGTH_CHECK", "KANA_CHECK"));
    $objErr->doFunc(array("��̾���ʥ���/̾��", 'kana02', STEXT_LEN), array("EXIST_CHECK", "NO_SPTAB", "SPTAB_CHECK" ,"MAX_LENGTH_CHECK", "KANA_CHECK"));
    $objErr->doFunc(array('�᡼�륢�ɥ쥹', "email", MTEXT_LEN) ,array("NO_SPTAB", "EXIST_CHECK", "EMAIL_CHECK", "SPTAB_CHECK" ,"EMAIL_CHAR_CHECK", "MAX_LENGTH_CHECK", "MOBILE_EMAIL_CHECK"));

    return $objErr->arrErr;
}

//---- ���ϥ��顼�����å�
function lfErrorCheck2($array) {

    global $objConn, $objDate;
    $objErr = new SC_CheckError($array);
    
    $objErr->doFunc(array("͹���ֹ�1", "zip01", ZIP01_LEN ) ,array("EXIST_CHECK", "SPTAB_CHECK" ,"NUM_CHECK", "NUM_COUNT_CHECK"));
    $objErr->doFunc(array("͹���ֹ�2", "zip02", ZIP02_LEN ) ,array("EXIST_CHECK", "SPTAB_CHECK" ,"NUM_CHECK", "NUM_COUNT_CHECK")); 
    $objErr->doFunc(array("͹���ֹ�", "zip01", "zip02"), array("ALL_EXIST_CHECK"));

    $objErr->doFunc(array("����", "sex") ,array("SELECT_CHECK", "NUM_CHECK")); 
    $objErr->doFunc(array("��ǯ���� (ǯ)", "year", 4), array("EXIST_CHECK", "SPTAB_CHECK", "NUM_CHECK", "NUM_COUNT_CHECK"));
    if (!isset($objErr->arrErr['year'])) {
        $objErr->doFunc(array("��ǯ���� (ǯ)", "year", $objDate->getStartYear()), array("MIN_CHECK"));
        $objErr->doFunc(array("��ǯ���� (ǯ)", "year", $objDate->getEndYear()), array("MAX_CHECK"));
    }
    $objErr->doFunc(array("��ǯ���� (����)", "month", "day"), array("SELECT_CHECK"));
    if (!isset($objErr->arrErr['year']) && !isset($objErr->arrErr['month']) && !isset($objErr->arrErr['day'])) {
        $objErr->doFunc(array("��ǯ����", "year", "month", "day"), array("CHECK_DATE"));
    }
    
    return $objErr->arrErr;
}


//---- ���ϥ��顼�����å�
function lfErrorCheck3($array) {

    global $objConn;
    $objErr = new SC_CheckError($array);
    
    $objErr->doFunc(array("��ƻ�ܸ�", 'pref'), array("SELECT_CHECK","NUM_CHECK"));
    $objErr->doFunc(array("�Զ�Į¼", "addr01", MTEXT_LEN), array("EXIST_CHECK","SPTAB_CHECK" ,"MAX_LENGTH_CHECK"));
    $objErr->doFunc(array("����", "addr02", MTEXT_LEN), array("EXIST_CHECK","SPTAB_CHECK" ,"MAX_LENGTH_CHECK"));
    $objErr->doFunc(array("�����ֹ�1", 'tel01'), array("EXIST_CHECK","SPTAB_CHECK" ));
    $objErr->doFunc(array("�����ֹ�2", 'tel02'), array("EXIST_CHECK","SPTAB_CHECK" ));
    $objErr->doFunc(array("�����ֹ�3", 'tel03'), array("EXIST_CHECK","SPTAB_CHECK" ));
    $objErr->doFunc(array("�����ֹ�", "tel01", "tel02", "tel03",TEL_ITEM_LEN) ,array("TEL_CHECK"));
    
    return $objErr->arrErr;
}

// ͹���ֹ椫�齻��μ���
function lfGetAddress($zipcode) {
    global $arrPref;

    $conn = new SC_DBconn(ZIP_DSN);

    // ͹���ֹ渡��ʸ����
    $zipcode = mb_convert_kana($zipcode ,"n");
    $sqlse = "SELECT state, city, town FROM mtb_zip WHERE zipcode = ?";

    $data_list = $conn->getAll($sqlse, array($zipcode));

    // ����ǥå������ͤ�ȿž�����롣
    $arrREV_PREF = array_flip($arrPref);

    /*
        ��̳�ʤ����������ɤ����ǡ����򤽤Τޤޥ���ݡ��Ȥ����
        �ʲ��Τ褦��ʸ�������äƤ���Τ�   �к����롣
        ���ʣ����������ܡ�
        ���ʲ��˷Ǻܤ��ʤ����
    */
    $town =  $data_list[0]['town'];
    $town = ereg_replace("��.*��$","",$town);
    $town = ereg_replace("�ʲ��˷Ǻܤ��ʤ����","",$town);
    $data_list[0]['town'] = $town;
    $data_list[0]['state'] = $arrREV_PREF[$data_list[0]['state']];

    return $data_list;
}
//NONMEMBER_�ؿ���---------------------------------------------------------------------------------------
?>
         
?>