<!--{*
 * Copyright(c) 2000-2006 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *}-->
<!--��CONTENTS-->
<script type="text/javascript">
<!--
function preLoadImg(URL){
	arrImgList = new Array (
		URL+"img/header/basis_on.jpg",URL+"img/header/product_on.jpg",URL+"img/header/customer_on.jpg",URL+"img/header/order_on.jpg",
		URL+"img/header/sales_on.jpg",URL+"img/header/mail_on.jpg",URL+"img/header/contents_on.jpg",
		URL+"img/header/mainpage_on.gif",URL+"img/header/sitecheck_on.gif",URL+"img/header/logout.gif",
		URL+"img/contents/btn_search_on.jpg",URL+"img/contents/btn_regist_on.jpg",
		URL+"img/contents/btn_csv_on.jpg",URL+"img/contents/arrow_left.jpg",URL+"img/contents/arrow_right.jpg"
	);
	arrPreLoad = new Array();
	for (i in arrImgList) {
		arrPreLoad[i] = new Image();
		arrPreLoad[i].src = arrImgList[i];
	}
	preLoadFlag = "true";
}

function chgImg(fileName,imgName){
	if (preLoadFlag == "true") {
		document.images[imgName].src = fileName;
	}
}

function chgImgImageSubmit(fileName,imgObj){
	imgObj.src = fileName;
}
function fnFormModeSubmit(form, mode, keyname, keyid) {
	document.forms[form]['mode'].value = mode;
	if(keyname != "" && keyid != "") {
		document.forms[form][keyname].value = keyid;
	}
	document.forms[form].submit();
}
// ��ʧ����ˡ�����򤵤�Ƥ��뤫��Ƚ�ꤹ��
function lfMethodChecked() {
	var methods = document.form1.METHOD;
	var checked = false;

	var max = methods.length;
	for (var i = 0; i < max; i++) {
		if (methods[i].checked) {
			checked = true;
		}
	}
	if (checked) {
		document.form1.submit();
	} else {
		alert('��ʧ����ˡ�����򤷤Ƥ���������');
	}
}
//-->
</script>
<table width="760" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<!--{*������³����ή��-->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/flow03.gif" width="700" height="36" alt="������³����ή��"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��*}-->

		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/credit_title.jpg" width="700" height="40" alt="���쥸�åȷ��"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">�������顢��ʧ����ˡ�����򤷤Ƥ���������<br />
				���ʧ������ܥ�ӥ�ʧ�������򤷤����ϡ�ʬ���������򤹤�ɬ�פϤ���ޤ���<br />
				ʬ��ʧ�������򤷤����ϡ�ʬ���������򤷡����ֲ��Ρ֤���ʸ��λ�ڡ����ءץܥ���򥯥�å����Ƥ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<form name="form2" id="form2" method="post" action="<!--{$smarty.server.PHP_SELF|escape}-->">
			<input type="hidden" name="mode" value="">
			</form>
			<form name="form1" id="form1" method="post" action="<!--{$arrSendData.SEND_URL|escape}-->">
			<input type="hidden" name="SHOPCO" value="<!--{$arrSendData.SHOPCO|escape}-->">
			<input type="hidden" name="HOSTID" value="<!--{$arrSendData.HOSTID|escape}-->">
			<input type="hidden" name="S_TORIHIKI_NO" value="<!--{$arrSendData.S_TORIHIKI_NO|escape}-->">
			<input type="hidden" name="MAIL" value="<!--{$arrSendData.MAIL|escape}-->">
			<input type="hidden" name="AMOUNT" value="<!--{$arrSendData.AMOUNT|escape}-->">
			<input type="hidden" name="TAX" value="<!--{$arrSendData.TAX|escape}-->">
			<input type="hidden" name="TOTAL" value="<!--{$arrSendData.TOTAL|escape}-->">
			<input type="hidden" name="JOB" value="<!--{$arrSendData.JOB|escape}-->">
			<input type="hidden" name="ITEM" value="<!--{$arrSendData.ITEM|escape}-->">
			<input type="hidden" name="RETURL" value="<!--{$arrSendData.RETURL|escape}-->">
			<input type="hidden" name="NG_RETURL" value="<!--{$arrSendData.NG_RETURL|escape}-->">
			<input type="hidden" name="EXITURL" value="<!--{$arrSendData.EXITURL|escape}-->">
			<input type="hidden" name="REMARKS3" value="<!--{$arrSendData.REMARKS3|escape}-->">

			<tr>
				<td bgcolor="#cccccc">
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌��������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="10%" align="center" bgcolor="#f0f0f0" class="fs12">����</td>
						<td width="90%" bgcolor="#f0f0f0" class="fs12">��ʧ����ˡ</td>
					</tr>
					<!--{foreach key=key item=item from=$arrCreMet name=method_loop}-->
					<tr>
						<td align="center" bgcolor="#ffffff" class="fs12">
							<input type="radio"
								   name="METHOD"
								   id="<!--{$key}-->"
								   value="<!--{$key}-->"
								   style="<!--{$arrErr.arrCreMet|sfGetErrorColor}-->" <!--{if $smarty.foreach.method_loop.first}-->checked<!--{/if}--> />
						</td>
						<td bgcolor="#ffffff" class="fs12"><label for="<!--{$key}-->"><!--{$item|escape}--></label></td>
					</tr>
					<!--{/foreach}-->
				</table>
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌�����ޤ�-->
				</td>
			</tr>

			<tr><td height="20"></td></tr>

			<tr>
				<td bgcolor="#cccccc">
				<!--ʬ������������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="20%" bgcolor="#f0f0f0" class="fs12n">ʬ����</td>
						<td width="80%" bgcolor="#ffffff" class="fs12n">
						<!--{assign var=key value="PTIMES"}-->
						<span class="red"><!--{$arrErr[$key]}--></span>
						<select name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
						<option value="1" selected="">����ʤ�</option>
						<!--{html_options options=$arrCreDiv selected=$arrForm[$key].value}-->
						</select></td>
					</tr>
				</table>
				<!--ʬ���������ޤ�-->
				</td>
			</tr>

			<tr><td height="20"></td></tr>

			<tr>
				<td bgcolor="#cccccc">
				<!--eLIO��Ѥ�������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="20%" bgcolor="#f0f0f0" class="fs12n">eLIO��Ѥ���Ѥ���</td>
						<td width="80%" bgcolor="#ffffff" class="fs12n">
							<!--{assign var=key value="ELIO"}-->
							<span class="red"><!--{$arrErr[$key]}--></span>
							<input type="checkbox"
								   name="<!--{$key}-->"
								   value="<!--{$arrSendData.ELIO|escape}-->">���ܲ��̸��ɽ��������eLIO��ѡײ��̤��顢eLIO�����ɤ򤫤����Ƥ���������
						</td>
					</tr>
				</table>
				<!--eLIO��Ѥ����ޤ�-->
				</td>
			</tr>

			<tr><td height="20"></td></tr>
			<tr>
				<td align="center">
					<a href=""
					   onclick="fnFormModeSubmit('form2', 'return', '', '');return false;"
					   onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back_on.gif',back03)"
					   onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif',back03)">
					   <img src="<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif"
							width="150"
							height="30"
							alt="���"
							border="0"
							name="back03"
							id="back03" />
					</a>
					<img src="<!--{$smarty.const.URL_DIR}-->img/_.gif" width="20" height="" alt="" />
					<input type="image"
						   onClick="lfMethodChecked();return false;"
						   onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp_on.gif',this)"
						   onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp.gif',this)"
						   src="<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp.gif"
						   width="150"
						   height="30"
						   alt="����ʸ��λ�ڡ�����"
						   border="0"
						   name="next"
						   id="next" />
				</td>
			</tr>
			</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->
