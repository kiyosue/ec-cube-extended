<?php 
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