<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once("../require.php");
require_once("./index_csv.php");

session_start();

class LC_Page {
	var $arrSession;
	function LC_Page() {
		global $arrPageMax;
		$this->arrPageMax = $arrPageMax;
		$this->tpl_mainpage = 'products/trackback.tpl';
		$this->tpl_subnavi = 'products/subnavi.tpl';
		$this->tpl_mainno = 'products';
		$this->tpl_subno = 'trackback';
		$this->tpl_pager = DATA_PATH . 'Smarty/templates/admin/pager.tpl';
		$this->tpl_subtitle = '�ȥ�å��Хå�����';
	}
}

$objPage = new LC_Page();
$objView = new SC_AdminView();
$objSess = new SC_Session();
$objDate = new SC_Date();
$objQuery = new SC_Query();

// ���֤�����
$objPage->arrTrackBackStatus = $arrTrackBackStatus;

// ��Ͽ��������������ǯ
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(DATE("Y"));
$objPage->arrStartYear = $objDate->getYear();
$objPage->arrStartMonth = $objDate->getMonth();
$objPage->arrStartDay = $objDate->getDay();
// ��Ͽ������������λǯ
$objDate->setStartYear(RELEASE_YEAR);
$objDate->setEndYear(DATE("Y"));
$objPage->arrEndYear = $objDate->getYear();
$objPage->arrEndMonth = $objDate->getMonth();
$objPage->arrEndDay = $objDate->getDay();

// ǧ�ڲ��ݤ�Ƚ��
sfIsSuccess($objSess);

// �ȥ�å��Хå�����Υ����μ���
$select="trackback_id, tra.product_id, tra.blog_name, tra.title, tra.url, ";
$select.="tra.excerpt, tra.status, tra.create_date, tra.update_date, pro.name";
$from = "dtb_trackback AS tra LEFT JOIN dtb_products AS pro ON tra.product_id = pro.product_id ";

// ������ɤΰ����Ѥ�
foreach ($_POST as $key => $val) {
	if (ereg("^search_", $key)) {
		$objPage->arrHidden[$key] = $val;
	}
}

// �ȥ�å��Хå��κ��
if ($_POST['mode'] == "delete") {
	$objQuery->exec("UPDATE dtb_trackback SET del_flg = 1 WHERE trackback_id=?", array($_POST['trackback_id']));
}
	
if ($_POST['mode'] == 'search' || $_POST['mode'] == 'csv' || $_POST['mode'] == 'delete'){
	
	//�������Ƥ��ʤ����ʤ򸡺�
	$where="tra.del_flg = 0 AND pro.del_flg = 0";
	$objPage->arrForm = $_POST;

	//���顼�����å�
	$objPage->arrErr = lfCheckError();

	if (!$objPage->arrErr) {
		foreach ($_POST as $key => $val) {

			$val = sfManualEscape($val);
			
			if ($val == "") {
				continue;
			}
			
			switch ($key) {

				case 'search_blog_name':
					$val = ereg_replace(" ", "%", $val);
					$val = ereg_replace("��", "%", $val);
					$where.= " AND tra.blog_name ILIKE ? ";
					$arrval[] = "%$val%";
					break;
			
				case 'search_blog_title':
					$val = ereg_replace(" ", "%", $val);
					$val = ereg_replace("��", "%", $val);
					$where.= " AND tra.title ILIKE ? ";
					$arrval[] = "%$val%";
					break;
			
				case 'search_blog_url':
					$val = ereg_replace(" ", "%", $val);
					$val = ereg_replace("��", "%", $val);
					$where.= " AND tra.url ILIKE ? ";
					$arrval[] = "%$val%";
					break;
					
				case 'search_status':
					if (isset($_POST['search_status'])) {
						$where.= " AND tra.status = ? ";
						$arrval[] = $val;
					}
					break;
							
				case 'search_name':
					$val = ereg_replace(" ", "%", $val);
					$val = ereg_replace("��", "%", $val);
					$where.= " AND pro.name ILIKE ? ";
					$arrval[] = "%$val%";
					break;
					
				case 'search_product_code':
					$val = ereg_replace(" ", "%", $val);
					$val = ereg_replace("��", "%", $val);
					$where.= " AND pro.product_id IN (SELECT product_id FROM dtb_products_class WHERE product_code ILIKE ? )";
					$arrval[] = "%$val%";
					break;
					
				case 'search_startyear':
					if (isset($_POST['search_startyear']) && isset($_POST['search_startmonth']) && isset($_POST['search_startday'])) {
						$date = sfGetTimestamp($_POST['search_startyear'], $_POST['search_startmonth'], $_POST['search_startday']);
						$where.= " AND tra.create_date >= ? ";
						$arrval[] = $date;
					}
					break;
	
				case 'search_endyear':
					if (isset($_POST['search_startyear']) && isset($_POST['search_startmonth']) && isset($_POST['search_startday'])) {
						$date = sfGetTimestamp($_POST['search_endyear'], $_POST['search_endmonth'], $_POST['search_endday']);
						
						$end_date = date("Y/m/d",strtotime("1 day" ,strtotime($date)));
						
						$where.= " AND tra.create_date <= cast('$end_date' as date) ";
					}
					break;
			}
		
		}
			
	}
	
	$order = "tra.create_date DESC";
	
	// �ڡ�������ν���
	if(is_numeric($_POST['search_page_max'])) {	
		$page_max = $_POST['search_page_max'];
	} else {
		$page_max = SEARCH_PMAX;
	}
	
	$linemax = $objQuery->count($from, $where, $arrval);
	$objPage->tpl_linemax = $linemax;
	
	// �ڡ�������μ���
	$objNavi = new SC_PageNavi($_POST['search_pageno'], $linemax, $page_max, "fnNaviSearchPage", NAVI_PMAX);
	$objPage->arrPagenavi = $objNavi->arrPagenavi;
	$startno = $objNavi->start_row;

	$objPage->tpl_pageno = $_POST['search_pageno'];
	
	// �����ϰϤλ���(���Ϲ��ֹ桢�Կ��Υ��å�)
	$objQuery->setlimitoffset($page_max, $startno);

	// ɽ�����
	$objQuery->setorder($order);
	
	//������̤μ���
	$objPage->arrTrackback = $objQuery->select($select, $from, $where, $arrval);
	
	//CSV���������
	if ($_POST['mode'] == 'csv'){
		// ���ץ����λ���
		$option = "ORDER BY trackback_id";
		// CSV���ϥ����ȥ�Ԥκ���
		$head = sfGetCSVList($arrREVIEW_CVSTITLE);
		$data = lfGetReviewCSV($where, '', $arrval);
		// CSV���������롣
		sfCSVDownload($head.$data);
		exit;
	}	
}

$objView->assignobj($objPage);
$objView->display(MAIN_FRAME);

//-------------------------------------------------------------------------------------

// ���ϥ��顼�����å�
function lfCheckError() {
	$objErr = new SC_CheckError();
	switch ($_POST['mode']){
		case 'search':
		$objErr->doFunc(array("��Ƽ�", "search_startyear", "search_startmonth", "search_startday"), array("CHECK_DATE"));
		$objErr->doFunc(array("������", "search_startyear", "search_startmonth", "search_startday"), array("CHECK_DATE"));
		$objErr->doFunc(array("��λ��", "search_endyear", "search_endmonth", "search_endday"), array("CHECK_DATE"));
		$objErr->doFunc(array("������", "��λ��", "search_startyear", "search_startmonth", "search_startday", "search_endyear", "search_endmonth", "search_endday"), array("CHECK_SET_TERM"));
		break;
		
		case 'complete':
		$objErr->doFunc(array("���������٥�", "recommend_level"), array("SELECT_CHECK"));
		$objErr->doFunc(array("�����ȥ�", "title", STEXT_LEN), array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
		$objErr->doFunc(array("������", "comment", LTEXT_LEN), array("EXIST_CHECK", "SPTAB_CHECK", "MAX_LENGTH_CHECK"));
		break;
	}
	return $objErr->arrErr;
}

?>
