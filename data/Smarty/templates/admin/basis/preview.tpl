<!--{*
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
*}-->
<script language="JavaScript">
<!--
var flag = 0;

function setFlag(){
	flag = 1;
}
function checkFlagAndSubmit(){
	if ( flag == 1 ){
		if( confirm('���Ƥ��ѹ�����Ƥ��ޤ���³�Ԥ�����ѹ����Ƥ��˴�����ޤ���\n�������Ǥ��礦����' )){
			fnSetvalAndSubmit( 'form1', 'mode', 'edit' );
		} else {
			return false;
		}
	} else {
		fnSetvalAndSubmit( 'form1', 'mode', 'edit' );
	}
}

//-->
</script>

<!--�����ᥤ�󥳥�ƥ�ġ���-->
			<table width="737" border="0" cellspacing="0" cellpadding="0" summary=" ">
				<!--�ᥤ�󥨥ꥢ-->
				<tr>
					<td align="center">
						<table width="706" border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr><td height="14"></td></tr>
							<tr>
								<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/main_top.jpg" width="706" height="14" alt=""></td>
							</tr>
							<tr>
								<td background="<!--{$smarty.const.URL_DIR}-->img/contents/main_left.jpg"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="14" height="1" alt=""></td>
								<td bgcolor="#cccccc">
								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_top.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td background="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_left_bg.gif"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_left.gif" width="22" height="12" alt=""></td>
										<td bgcolor="#636469" width="638" class="fs14n"><span style="color:#ffffff;"><!--����ƥ�ĥ����ȥ�-->�᡼��ƥ�ץ졼�ȥץ�ӥ塼</span></td>
										<td background="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_right_bg.gif"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="18" height="1" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_bottom.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/main_bar.jpg" width="678" height="10" alt=""></td>
									</tr>
								</table>

								<table width="678" border="0" cellspacing="1" cellpadding="8" summary=" ">
									<tr class="fs12n">
										<td bgcolor="#f2f1ec">�᡼�����<span class="red"> *</span></td>
										<td bgcolor="#ffffff">
										<!--{if $list_data[data].send_type eq 0}-->�ѥ�����<!--{else}-->����<!--{/if}-->
										</td>
									</tr>
									<tr>
										<td bgcolor="#f2f1ec" width="160" class="fs12n">�ƥ�ץ졼��<span class="red"> *</span></td>
										<td bgcolor="#ffffff" width="557" class="fs10n">
										<!--{$list_data.template_name|escape}-->
										</td>
									</tr>
									<tr>
										<td bgcolor="#f2f1ec" width="160" class="fs12n">�᡼�륿���ȥ�<span class="red"> *</span></td>
										<td bgcolor="#ffffff" width="557" class="fs10n">
										<!--{$list_data.subject|escape}-->
										</td>
									</tr>
									<tr>
										<td bgcolor="#f2f1ec" width="160" class="fs12">�᡼�������</td>
										<td bgcolor="#ffffff" width="557" class="fs10">
										<textarea  name="body" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" cols="75" rows="12" class="area75" disabled="true"><!--{$list_data.body|escape}--></textarea></td>
									</tr>						
								</table>

								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td bgcolor="#cccccc"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="1" height="5" alt=""></td>
										<td><img src="<!--{$smarty.const.URL_DIR}-->img/contents/tbl_top.gif" width="676" height="7" alt=""></td>
										<td bgcolor="#cccccc"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="1" height="5" alt=""></td>
									</tr>
									<tr>
										<td bgcolor="#cccccc"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="1" height="10" alt=""></td>
										<td bgcolor="#e9e7de" align="center">
										</td>
										<td bgcolor="#cccccc"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="1" height="10" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/tbl_bottom.gif" width="678" height="8" alt=""></td>
									</tr>
								</table>
								</td>
								<td background="<!--{$smarty.const.URL_DIR}-->img/contents/main_right.jpg"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="14" height="1" alt=""></td>
							</tr>
							<tr>
								<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/main_bottom.jpg" width="706" height="14" alt=""></td>
							</tr>
							<tr><td height="30"></td></tr>
						</table>
					</td>
				</tr>
				<!--�ᥤ�󥨥ꥢ-->
			</table>
<!--�����ᥤ�󥳥�ƥ�ġ���-->

