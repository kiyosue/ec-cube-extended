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
<!--��CONTENTS-->
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
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/convenience_title.jpg" width="700" height="40" alt="����ӥ˷��"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">ɬ�׻�����ǧ�������ֲ��Ρ֤���ʸ��λ�ڡ����ءץܥ���򥯥�å����Ƥ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<form name="form2" id="form2" method="post" action="<!--{$smarty.server.PHP_SELF|escape}-->">
			<input type="hidden" name="mode" value="">
			</form>
			<form name="form1" id="form1" method="post" action="<!--{$arrSendData.SEND_URL|escape}-->">
			<!--{foreach from=$arrSendData key=key item=value}-->
			<!--{if $key != 'SEND_URL'}-->
			<input type="hidden" name="<!--{$key|escape}-->" value="<!--{$value|escape}-->">
			<!--{/if}-->
			<!--{/foreach}-->
			<tr><td height="20"></td></tr>
			
			<tr>
				<td bgcolor="#cccccc">
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌��������-->		
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="20%" bgcolor="#f0f0f0" class="fs12n">��̾��</td>
						<td width="80%" bgcolor="#ffffff" class="fs12n"><!--{$arrSendData.NAME1|escape}--><!--{$arrSendData.NAME2|escape}--></td>
					</tr>
					<tr>
						<td width="20%" bgcolor="#f0f0f0" class="fs12n">��̾��(����)</td>
						<td width="80%" bgcolor="#ffffff" class="fs12n"><!--{$arrSendData.KANA1|escape}--><!--{$arrSendData.KANA2|escape}--></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">�����ֹ�</td>
						<td bgcolor="#ffffff" class="fs12n"><!--{$arrSendData.TEL|escape}--></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��׶��</td>
						<td bgcolor="#ffffff" class="fs12n"><!--{$arrSendData.TOTAL|escape}-->��</td>
					</tr>
				</table>
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌�����ޤ�-->
				</td>
			</tr>
			
			<tr><td height="20"></td></tr>
			<tr>
				<td align="center">
					<a href="<!--{$smarty.const.URL_DIR}-->" onclick="fnFormModeSubmit('form2', 'return', '', '');return false;" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back_on.gif',back03)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif',back03)"><img src="<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03"/></a>
					<img src="<!--{$smarty.const.URL_DIR}-->img/_.gif" width="20" height="" alt="" />
					<input type="image" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp_on.gif',this)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp.gif',this)" src="<!--{$smarty.const.URL_DIR}-->img/shopping/b_ordercomp.gif" width="150" height="30" alt="����ʸ��λ�ڡ�����" border="0" name="next" id="next" />
				</td>
			</tr>
			</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->
