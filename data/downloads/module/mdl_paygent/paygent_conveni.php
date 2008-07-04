<?php
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
require_once(MODULE_PATH . "mdl_paygent/mdl_paygent.inc");

class LC_Page {
	function LC_Page() {
		/** 必ず指定する **/
		if (GC_MobileUserAgent::isMobile()) {
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_conveni_mobile.tpl";
		} else {
			$this->tpl_mainpage = MODULE_PATH . "mdl_paygent/paygent_conveni.tpl";
		}
		/*
		 session_start時のno-cacheヘッダーを抑制することで
		 「戻る」ボタン使用時の有効期限切れ表示を抑制する。
		 private-no-expire:クライアントのキャッシュを許可する。
		*/
		session_cache_limiter('private-no-expire');		
	}
}

$objPage = new LC_Page();
if (GC_MobileUserAgent::isMobile()) {
	$objView = new SC_MobileView();
} else {
	$objView = new SC_SiteView();
}
$objCampaignSess = new SC_CampaignSession();
$objSiteInfo = $objView->objSiteInfo;
$arrInfo = $objSiteInfo->data;

// パラメータ管理クラス
$objFormParam = new SC_FormParam();

// 一時受注テーブルの読込
$arrData = sfGetOrderTemp($uniqid);

// パラメータ情報の初期化
lfInitParam($arrData);
// POST値の取得
$objFormParam->setParam($_POST);

// カート集計処理
$objPage = sfTotalCart($objPage, $objCartSess, $arrInfo);

// カート集計を元に最終計算
$arrData = sfTotalConfirm($arrData, $objPage, $objCartSess, $arrInfo);

switch($_POST['mode']) {
// 前のページに戻る
case 'return':
	// 正常な推移であることを記録しておく
	$objSiteSess->setRegistFlag();
	if (GC_MobileUserAgent::isMobile()) {
		header("Location: " . gfAddSessionId(MOBILE_URL_SHOP_CONFIRM));
	} else {
		header("Location: " . URL_SHOP_CONFIRM);
	}
	break;
// 次へ
case 'next':
	// 入力値の変換
	$objFormParam->convParam();
	$objPage->arrErr = lfCheckError();
	// 入力エラーなしの場合
	if(count($objPage->arrErr) == 0) {
		 // 入力データの取得を行う
    	$arrInput = $objFormParam->getHashArray();
		// クレジット電文送信
		$arrRet = sfSendPaygentConveni($arrData, $arrInput, $uniqid);
		
		// 成功
		if($arrRet['result'] === "0") {
            // 正常に登録されたことを記録しておく
            $objSiteSess->setRegistFlag();
            LC_Helper_Send_Payment::sendPaymentData(MDL_PAYGENT_CODE, $arrData['payment_total']);
			if (GC_MobileUserAgent::isMobile()) {
				header("Location: " . gfAddSessionId(MOBILE_URL_SHOP_COMPLETE));
			} else {
				header("Location: " . URL_SHOP_COMPLETE);
			}
		} else {
			// 失敗
			$objPage->tpl_error = "決済に失敗しました。". $arrRet['response'];
		}
	}
	break;
}


// 共通の表示準備
$objPage = sfPaygentDisp($objPage, $payment_id);

$objPage->arrConvenience = $arrConvenience;
$objPage->arrForm = $objFormParam->getFormParamList();
$objView->assignobj($objPage);
// フレームを選択(キャンペーンページから遷移なら変更)
$objCampaignSess->pageView($objView);

//---------------------------------------------------------------------------------------------

/* パラメータ情報の初期化 */
function lfInitParam($arrData) {
	global $objFormParam;
	$objFormParam->addParam("コンビニ", "cvs_company_id", STEXT_LEN, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"));	
	$objFormParam->addParam("利用者姓", "customer_family_name", PAYGENT_CONVENI_MTEXT_LEN / 2, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name01']);
	$objFormParam->addParam("利用者名", "customer_name", PAYGENT_CONVENI_MTEXT_LEN / 2, "KVa", array("EXIST_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_name02']);
	$objFormParam->addParam("利用者姓カナ", "customer_family_name_kana", PAYGENT_CONVENI_STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana01']);
	$objFormParam->addParam("利用者名カナ", "customer_name_kana", PAYGENT_CONVENI_STEXT_LEN, "CKVa", array("EXIST_CHECK", "KANA_CHECK", "MAX_LENGTH_CHECK"), $arrData['order_kana02']);
	$objFormParam->addParam("お電話番号", "customer_tel", 11, "n", array("EXIST_CHECK", "MAX_LENGTH_CHECK" ,"NUM_CHECK"), $arrData['order_tel01'].$arrData['order_tel02'].$arrData['order_tel03']);
}

/* 入力内容のチェック */
function lfCheckError() {
	global $objFormParam;
	// 入力データを渡す。
	$arrRet =  $objFormParam->getHashArray();
	$objErr = new SC_CheckError($arrRet);
	$objErr->arrErr = $objFormParam->checkError();
	
	return $objErr->arrErr;
}
?>