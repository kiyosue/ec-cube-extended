<?php
/*
 * Copyright(c) 2000-2006 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */

require_once("../require.php");

class LC_Page {
    function LC_Page() {
        $this->tpl_mainpage = 'shopping/nonmember.tpl';        // �ᥤ��ƥ�ץ졼��
        $this->tpl_title .= '�����;�������(1/3)';            //���ڡ��������ȥ�
    }
}

//---- �ڡ����������
$CONF = sf_getBasisData();                  // Ź�޴��ܾ���
$objConn = new SC_DbConn();
$objPage = new LC_Page();
$objView = new SC_MobileView();
$objDate = new SC_Date(START_BIRTH_YEAR, date("Y",strtotime("now")));
$objPage->arrPref = $arrPref;
$objPage->arrJob = $arrJob;
$objPage->arrReminder = $arrReminder;
$objPage->arrYear = $objDate->getYear('', 1950);    //�����եץ����������
$objPage->arrMonth = $objDate->getMonth();
$objPage->arrDay = $objDate->getDay();

//SSLURLȽ��
if (SSLURL_CHECK == 1){
    $ssl_url= sfRmDupSlash(MOBILE_SSL_URL.$_SERVER['REQUEST_URI']);
    if (!ereg("^https://", $non_ssl_url)){
        sfDispSiteError(URL_ERROR, "", false, "", true);
    }
}

// �쥤�����ȥǥ���������
$objPage = sfGetPageLayout($objPage, false, DEF_LAYOUT);

//---- ��Ͽ�ѥ��������
$arrRegistColumn = array(
                             array(  "column" => "name01", "convert" => "aKV" ),
                             array(  "column" => "name02", "convert" => "aKV" ),
                             array(  "column" => "kana01", "convert" => "CKV" ),
                             array(  "column" => "kana02", "convert" => "CKV" ),
                             array(  "column" => "zip01", "convert" => "n" ),
                             array(  "column" => "zip02", "convert" => "n" ),
                             array(  "column" => "pref", "convert" => "n" ),
                             array(  "column" => "addr01", "convert" => "aKV" ),
                             array(  "column" => "addr02", "convert" => "aKV" ),
                             array(  "column" => "email", "convert" => "a" ),
                             array(  "column" => "email2", "convert" => "a" ),
                             array(  "column" => "email_mobile", "convert" => "a" ),
                             array(  "column" => "email_mobile2", "convert" => "a" ),
                             array(  "column" => "tel01", "convert" => "n" ),
                             array(  "column" => "tel02", "convert" => "n" ),
                             array(  "column" => "tel03", "convert" => "n" ),
                             array(  "column" => "fax01", "convert" => "n" ),
                             array(  "column" => "fax02", "convert" => "n" ),
                             array(  "column" => "fax03", "convert" => "n" ),
                             array(  "column" => "sex", "convert" => "n" ),
                             array(  "column" => "job", "convert" => "n" ),
                             array(  "column" => "birth", "convert" => "n" ),
                             array(  "column" => "reminder", "convert" => "n" ),
                             array(  "column" => "reminder_answer", "convert" => "aKV"),
                             array(  "column" => "password", "convert" => "a" ),
                             array(  "column" => "password02", "convert" => "a" ),
                             array(  "column" => "mailmaga_flg", "convert" => "n" ),
                         );

//---- ��Ͽ�����ѥ��������
//$arrRejectRegistColumn = array("year", "month", "day", "email02", "email_mobile02","password","password02","reminder","reminder_answer");
$arrRejectRegistColumn = array("year", "month", "day");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //-- POST�ǡ����ΰ����Ѥ�
    $objPage->arrForm = $_POST;
    
    if($objPage->arrForm['year'] == '----') {
        $objPage->arrForm['year'] = '';
    }
    
    //$objPage->arrForm['email'] = strtolower($objPage->arrForm['email']);        // email�Ϥ��٤ƾ�ʸ���ǽ���
    
    //-- ���ϥǡ������Ѵ�
    $objPage->arrForm = lfConvertParam($objPage->arrForm, $arrRegistColumn);

    // ���ܥ����ѽ���
    if (!empty($_POST["return"])) {
        switch ($_POST["mode"]) {
        case "complete":
            $_POST["mode"] = "set3";
            break;
        case "confirm":
            $_POST["mode"] = "set2";
            break;
        default:
            $_POST["mode"] = "set1";
            break;
        }
    }

    //--�����ϥ��顼�����å�
    if (!empty($_POST["mode"])) {
            if ($_POST["mode"] == "set1") {
            $objPage->arrErr = lfErrorCheck1($objPage->arrForm);
            $objPage->tpl_mainpage = 'shopping/nonmember.tpl';
            $objPage->tpl_title = '�����;�������(1/3)';
        } elseif ($_POST["mode"] == "set2") {
            $objPage->arrErr = lfErrorCheck2($objPage->arrForm);
            $objPage->tpl_mainpage = 'shopping/nonmember_set1.tpl';
            $objPage->tpl_title = '�����;�������(2/3)';
        } elseif ($_POST["mode"] == "deliv"){
            $objPage->arrErr = lfErrorCheck3($objPage->arrForm);
            $objPage->tpl_mainpage = 'shopping/nonmember_set2.tpl';
            $objPage->tpl_title = '�����;�������(3/3)';
        }
    
   foreach($objPage->arrForm as $key => $val) {
        $objPage->$key = $val;
        }
 
    }


    if ($objPage->arrErr || !empty($_POST["return"])) {     // ���ϥ��顼�Υ����å�

        //-- �ǡ���������
        if ($_POST["mode"] == "set1") {
            $checkVal = array("email", "name01", "name02", "kana01", "kana02");
        } elseif ($_POST["mode"] == "set2") {
            $checkVal = array("sex", "year", "month", "day", "zip01", "zip02");
        } else {
            $checkVal = array("pref", "addr01", "addr02", "tel01", "tel02", "tel03", "mail_flag");
        }

        foreach($objPage->arrForm as $key => $val) {
            if ($key != "mode" && $key != "submit" && $key != "return" && $key != session_name() && !in_array($key, $checkVal))
                $objPage->list_data[ $key ] = $val;
        }



    } else {

        //--���ƥ�ץ졼������
        if ($_POST["mode"] == "set1") {
            $objPage->tpl_mainpage = 'shopping/nonmember_set1.tpl';
            $objPage->tpl_title = '�����;�������(2/3)';
        } elseif ($_POST["mode"] == "set2") {
            $objPage->tpl_mainpage = 'shopping/nonmember_set2.tpl';
            $objPage->tpl_title = '�����;�������(3/3)';

            if (@$objPage->arrForm['pref'] == "" && @$objPage->arrForm['addr01'] == "" && @$objPage->arrForm['addr02'] == "") {
                $address = lfGetAddress($_REQUEST['zip01'].$_REQUEST['zip02']);
                $objPage->pref = @$address[0]['state'];
                $objPage->addr01 = @$address[0]['city'] . @$address[0]['town'];
            }
        } /*elseif ($_POST["mode"] == "deliv") {
            //�ѥ����ɽ��
            
            //�᡼��������
            if (strtolower($objPage->arrForm['mail_flag']) == "on") {
                $objPage->arrForm['mail_flag']  = "2";
            } else {
                $objPage->arrForm['mail_flag']  = "3";
            }

            $objPage->tpl_mainpage = 'shopping/deliv.tpl';
            $objPage->tpl_title = '�����;���(��ǧ�ڡ���)';

        }*/

        //-- �ǡ�������
        unset($objPage->list_data);
        if ($_POST["mode"] == "set1") {
            $checkVal = array("sex", "year", "month", "day", "zip01", "zip02");
        } elseif ($_POST["mode"] == "set2") {
            $checkVal = array("pref", "addr01", "addr02", "tel01", "tel02", "tel03", "mail_flag");
        } else {
            $checkVal = array();
        }

        foreach($objPage->arrForm as $key => $val) {
            if ($key != "mode" && $key != "submit" && $key != "confirm" && $key != "return" && $key != session_name() && !in_array($key, $checkVal)) {
                $objPage->list_data[ $key ] = $val;
            }
        }

//        if ($_POST["mode"] == "deliv") {
//            
//            $objFormParam = new SC_FormParam();
//            // �ѥ�᡼������ν����
//           
//            // POST�ͤμ���
//            $objFormParam->setParam($_POST);
//            
//            // �����ͤμ���
//            $objPage->arrForm = $objFormParam->getFormParamList();
//            $objPage->arrErr = $arrErr;
//            
////            $cnt = 1;
////            foreach($objOtherAddr as $val) {
////                $objPage->arrAddr[$cnt] = $val;
////                $cnt++;
////            }
//            
//           $objPage->arrAddr[0]['zip01'] = $objPage->zip01;
//           $objPage->arrAddr[0]['zip02'] = $objPage->zip02;
//           $objPage->arrAddr[0]['pref'] = $objPage->pref;
//           $objPage->arrAddr[0]['addr01'] = $objPage->addr01;
//           $objPage->arrAddr[0]['addr02'] = $objPage->addr02;
//           
//            $objPage->tpl_mainpage = 'shopping/deliv.tpl';
//            $objPage->tpl_title = '���Ϥ������';
//        }
        
         if ($_POST["mode"] == "customer_addr") {
           lfRegistData ($uniqid); 
           header("Location:" . gfAddSessionId("./payment.php"));
        print($_POST);
        }
        
        //--������Ͽ�ȴ�λ����
        if ($_POST["mode"] == "complete") {
            $objPage->uniqid = lfRegistData ($objPage->arrForm, $arrRegistColumn, $arrRejectRegistColumn);

            // ���᡼�������Ѥߤξ��Ϥ���������Ͽ��λ�ˤ��롣
//            if (isset($_SESSION['mobile']['kara_mail_from'])) {
//                header("Location:" . gfAddSessionId(MOBILE_URL_DIR . "regist/index.php?mode=regist&id=" . $objPage->uniqid));
//                exit;
//            }

            $objPage->tpl_mainpage = 'shopping/complete.tpl';
            $objPage->tpl_title = '�����;�������(��λ�ڡ���)';

            /*sfMobileSetExtSessionId('id', $objPage->uniqid, 'regist/index.php');

            //������Ͽ��λ�᡼������
            $objPage->CONF = $CONF;
            $objPage->to_name01 = $_POST['name01'];
            $objPage->to_name02 = $_POST['name02'];
            $objMailText = new SC_MobileView();
            $objMailText->assignobj($objPage);
            $subject = sfMakesubject('�����;���Τ���ǧ');
            $toCustomerMail = $objMailText->fetch("mail_templates/customer_mail.tpl");
            $objMail = new GC_SendMail();
            $objMail->setItem(
                                ''                                  //������
                                , $subject                          //�����֥�������
                                , $toCustomerMail                   //����ʸ
                                , $CONF["email03"]                  //�����������ɥ쥹
                                , $CONF["shop_name"]                //����������̾��
                                , $CONF["email03"]                  //��reply_to
                                , $CONF["email04"]                  //��return_path
                                , $CONF["email04"]                  //  Errors_to
                                , $CONF["email01"]                  //  Bcc
                                                                );
            // ���������
            $name = $_POST["name01"] . $_POST["name02"] ." ��";
            $objMail->setTo($_POST["email"], $name);
            $objMail->sendMail();
*/
            // ��λ�ڡ����˰�ư�����롣
            header("Location:" . gfAddSessionId("./complete.php"));
            exit;
        }
    }
}

//----���ڡ���ɽ��
$objView->assignobj($objPage);
$objView->display(SITE_FRAME);

//----------------------------------------------------------------------------------------------------------------------

//---- function��
function lfRegistData($uniqid) {
    global $objFormParam;
    $arrRet = $objFormParam->getHashArray();
    $sqlval = $objFormParam->getDbArray();
    // ��Ͽ�ǡ����κ���
    $sqlval['order_temp_id'] = $uniqid;
    $sqlval['order_birth'] = sfGetTimestamp($arrRet['year'], $arrRet['month'], $arrRet['day']);
    $sqlval['update_date'] = 'Now()';
    $sqlval['customer_id'] = '0';
    
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

    //�������Ƚ�� ����������⤷���ϲ���Ͽ��ϡ��ᥢ�ɰ�դ�����ˤʤäƤ�Τ�Ʊ���ᥢ�ɤ���Ͽ�Բ�

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

//��ǧ�ڡ����ѥѥ����ɽ����

function lfPassLen($passlen){
    $ret = "";
    for ($i=0;$i<$passlen;true){
    $ret.="*";
    $i++;
    }
    return $ret;
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

//-----------------------------------------------------------------------------------------------------------------------------------
?>