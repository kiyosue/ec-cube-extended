<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../require.php");

class LC_Page {
	var $arrSession;
	var $body;
	var $list_data;

	function LC_Page() {
		$this->tpl_mainpage = 'basis/preview.tpl';
	}
}

//---- �ڡ����������
$conn = new SC_DBConn();
$objPage = new LC_Page();
$objView = new SC_AdminView();
$objSess = new SC_Session();
$objDate = new SC_Date();

// ǧ�ڲ��ݤ�Ƚ��
sfIsSuccess($objSess);


if ( $_POST['preview'] ){
		$sql = "SELECT header, footer,send_type FROM dtb_mailtemplate WHERE template_id = ?";
		$id = $_GET['id'];
        $result = $conn->getAll($sql, array($id));
	
        if ( $result ){
                if ( $result[0]["mail_method"] == 2 ){
                // �ƥ����ȷ����λ��ϥ���ʸ���򥨥�������
                    $objPage->escape_flag = 1;
                }
            $objPage->body = $result[0]["body"];
        }
    
    }
	
	
	

	
$objView->assignobj($objPage);
$objView->display($objPage->tpl_mainpage);

?>