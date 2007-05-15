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
?>