<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

  // {{{ requires
require_once(CLASS_PATH . "pages/LC_Page.php");
require_once(DATA_PATH . "module/Tar.php");
require_once(CLASS_EX_PATH . "helper_extends/SC_Helper_FileManager_Ex.php");

/**
 * テンプレート設定 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Design_Template extends LC_Page {

    // }}}
    // {{{ functions

    /** テンプレートデータ種別 */
    var $arrSubnavi = array(
                     'title' => array(
                                1 => 'top',
                                2 => 'product',
                                3 => 'detail',
                                4 => 'mypage'
                                             ),
                     'name' =>array(
                                1 => 'TOPページ',
                                2 => '商品一覧ページ',
                                3 => '商品詳細ページ',
                                4 => 'MYページ'
                              )
                     );

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
	    $this->tpl_mainpage = 'design/template.tpl';
	    $this->tpl_subnavi  = 'design/subnavi.tpl';
	    $this->tpl_subno    = 'template';
	    $this->tpl_mainno   = "design";
	    $this->tpl_subtitle = 'テンプレート設定';
	    $this->arrErr  = array();
	    $this->arrForm = array();
	    $this->tpl_select = DEFAULT_TEMPLATE_NAME;
	   	ini_set("max_execution_time", 300);
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
    	// 認証可否の判定
		$objSession = new SC_Session();
		SC_Utils::sfIsSuccess($objSession);

		// uniqidをテンプレートへ埋め込み
		$this->uniqid = $objSession->getUniqId();

		$objView = new SC_AdminView();

		switch($this->lfGetMode()) {

		// 登録ボタン押下時
		case 'register':
		    // 画面遷移の正当性チェック
		    if (!SC_Utils::sfIsValidTransition($objSession)) {
		        sfDispError('');
		    }
		    // パラメータ検証
		    $objForm = $this->lfInitRegister();
		    if ($objForm->checkError()) {
		        SC_Utils_Ex::sfDispError('');
		    }

		    $template_code = $objForm->getValue('template_code');
            $this->tpl_select = $template_code;

		    if($template_code == "") {
		    	$template_code = "default";
		    }

		    // DBへ使用するテンプレートを登録
		    $this->lfRegisterTemplate($template_code);

		    // XXX コンパイルファイルのクリア処理を行う
		    $objView->_smarty->clear_compiled_tpl();

		    // common.cssの内容を更新
		    $this->lfChangeCommonCss($template_code);

		    // ブロック位置を更新
		    $this->lfChangeBloc($template_code);

		    // 完了メッセージ
		    $this->tpl_onload="alert('登録が完了しました。');";
		    break;

		// 削除ボタン押下時
		case 'delete':
		    // 画面遷移の正当性チェック
		    if (!SC_Utils::sfIsValidTransition($objSession)) {
		        SC_Utils::sfDispError('');
		    }
		    // パラメータ検証
		    $objForm = $this->lfInitDelete();
		    if ($objForm->checkError()) {
		        SC_Utils::sfDispError('');
		    }

		    $template_code = $objForm->getValue('template_code_temp');
		    if ($template_code == DEFAULT_TEMPLATE_NAME) {
		        $this->tpl_onload = "alert('選択中のテンプレートは削除出来ません');";
		        break;
		    }

		    $this->lfDeleteTemplate($template_code);
		    break;

		// downloadボタン押下時
		case 'download':
		    // 画面遷移の正当性チェック
		    if (!SC_Utils::sfIsValidTransition($objSession)) {
		        SC_Utils::sfDispError('');
		    }
			// パラメータ検証
		    $objForm = $this->lfInitDownload();
		    $template_code = $objForm->getValue('template_code_temp');
		    // ユーザデータの下のファイルも保存する。
		    $from_dir = USER_TEMPLATE_PATH . $template_code . "/";
		    $to_dir = SMARTY_TEMPLATES_DIR . $template_code . "/_packages/";
		    SC_Utils::sfMakeDir($to_dir);
			SC_Utils::sfCopyDir($from_dir, $to_dir);
		    SC_Helper_FileManager::downloadArchiveFiles(SMARTY_TEMPLATES_DIR . $template_code);
		    break;

		// プレビューボタン押下時
		case 'preview':
		    break;

		default:
		    break;
		}

		// defaultパラメータのセット
		$this->templates = $this->lfGetAllTemplates();
		$this->now_template = DEFAULT_TEMPLATE_NAME;

		// 画面の表示
		$objView->assignobj($this);
		$objView->display(MAIN_FRAME);
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

	function lfGetMode(){
	    if (isset($_POST['mode'])) return $_POST['mode'];
	}

	function lfInitRegister() {
	    $objForm = new SC_FormParam();
	    $objForm->addParam(
	        'template_code', 'template_code', STEXT_LEN, '',
	        array("EXIST_CHECK","SPTAB_CHECK","MAX_LENGTH_CHECK", "ALNUM_CHECK")
	    );
	    $objForm->setParam($_POST);

	    return $objForm;
	}

	function lfInitDelete() {
	    $objForm = new SC_FormParam();
	    $objForm->addParam(
	        'template_code_temp', 'template_code_temp', STEXT_LEN, '',
	        array("EXIST_CHECK","SPTAB_CHECK","MAX_LENGTH_CHECK", "ALNUM_CHECK")
	    );
	    $objForm->setParam($_POST);

	    return $objForm;
	}

	function lfInitDownload() {
	    $objForm = new SC_FormParam();
	    $objForm->addParam(
	        'template_code_temp', 'template_code_temp', STEXT_LEN, '',
	        array("EXIST_CHECK","SPTAB_CHECK","MAX_LENGTH_CHECK", "ALNUM_CHECK")
	    );
	    $objForm->setParam($_POST);

	    return $objForm;
	}

	/**
	 * 使用するテンプレートをDBへ登録する
	 */
	function lfRegisterTemplate($template_code) {
	    $objQuery = new SC_Query();
	    $sqlval['name'] = "\"" . $template_code . "\"";
		$objQuery->update("mtb_constants", $sqlval, "id = ?", array('DEFAULT_TEMPLATE_NAME'));
		// キャッシュを生成
		$masterData = new SC_DB_MasterData_Ex();
		// 更新したデータを取得
        $mtb_constants = $masterData->getDBMasterData("mtb_constants");
        $masterData->clearCache("mtb_constants");
        $masterData->createCache("mtb_constants", $mtb_constants, true,
                                 array("id", "remarks", "rank"));
	}

	/**
	 * common.cssの更新
	 */
    function lfChangeCommonCss($template_code) {
        $css_path = USER_PATH . "css/common.css";
        
        // ファイル内容取得
        $css_data = file_get_contents($css_path);
        
        // ファイル内容更新
        $pt = '/(@import url\("\.\.\/packages\/.+\/css\/import\.css"\);)/';
        $rp = '@import url("../packages/'. $template_code. '/css/import.css");';
        $css = preg_replace($pt, $rp, $css_data);
        
        // ファイル更新
        $fp = fopen($css_path,"w");
        fwrite($fp, $css);
        fclose($fp);
    }
	
	/**
	 * ブロック位置の更新
	 */
	function lfChangeBloc($template_code) {
	    $objQuery = new SC_Query();
	    $filepath = USER_TEMPLATE_PATH. $template_code. "/sql/update_bloc.sql";
	    
	    // ブロック位置更新SQLファイル有
	    if(file_exists($filepath)) {
	        if($fp = fopen($filepath, "r")) {
	            $sql = fread($fp, filesize($filepath));
	            fclose($fp);
	        }
	        // 改行、タブを1スペースに変換
	        $sql = preg_replace("/[\r\n\t]/", " " ,$sql);
	        $sql_split = split(";", $sql);
	        foreach($sql_split as $key => $val){
	            if (trim($val) != "") {
	                $objQuery->query($val);
	            }
	        }
	    }
	}

	/**
	 * テンプレートパッケージの削除
	 */
	function lfDeleteTemplate($template_code) {
	    // DB更新
	    $objQuery = new SC_Query();
	    $objQuery->delete('dtb_templates', 'template_code = ?', array($template_code));
	    // テンプレート削除
	    $templates_dir = SMARTY_TEMPLATES_DIR. $template_code. "/";
	    SC_Utils_Ex::sfDelFile($templates_dir);
	    // コンパイル削除
	    $templates_c_dir = DATA_PATH. "Smarty/templates_c/". $template_code. "/";
	    SC_Utils_Ex::sfDelFile($templates_c_dir);
	    // ユーザーデータ削除
	    $user_dir = USER_TEMPLATE_PATH. $template_code. "/";
	    SC_Utils_Ex::sfDelFile($user_dir);
	}

	function lfGetAllTemplates() {
	    $objQuery = new SC_Query();
	    $arrRet = $objQuery->select('*', 'dtb_templates');
	    if (empty($arrRet)) return array();

	    return $arrRet;
	}
}
?>
