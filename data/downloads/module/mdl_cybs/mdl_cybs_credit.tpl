<script type="text/javascript">
<!--
function next(now, next) {
	if (now.value.length >= now.getAttribute('maxlength')) {
		next.focus();
	}
}
var send = true;

function fnCheckSubmit() {
	if(send) {
		send = false;
		return true;
	} else {
		alert("������������Ǥ������Ф餯���Ԥ���������");
		return false;
	}
}

//-->
</script>

<!--��CONTENTS-->
<table width="760" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<!--������³����ή��-->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/flow03.gif" width="700" height="36" alt="������³����ή��"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��-->

		<!--��MAIN CONTENTS-->
		<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_top.gif" width="666" height="7" alt=""></td>
			</tr>
			<tr>
				<td background="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_left_bg.gif"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_left.gif" width="22" height="12" alt=""></td>
				<td bgcolor="#636469" width="638" class="fs16n"><strong><span class="white"><!--{$tpl_payment_method}--></span><strong></td>
				<td background="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_right_bg.gif"><img src="<!--{$smarty.const.URL_DIR}-->img/common/_.gif" width="18" height="1" alt=""></td>
			</tr>
			<tr>
				<td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/contents_title_bottom.gif" width="666" height="7" alt=""></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>

		<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td bgcolor="#ffffff">

				<!--{if $tpl_error != ""}-->
				<!-- ���顼��å����� -->
				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr>
						<td bgcolor="#cccccc">
						<table width="666" border="0" cellspacing="1" cellpadding="10" summary=" ">
							<tr>
								<td width="666" class="fs12" bgcolor="#ffffff">
								<span class="redst"><!--{$tpl_error|escape|nl2br}--></span>
								</td>
							</tr>
						</table>
					</tr>
					<tr><td height="15"></td></tr>
				</table>
				<!--{/if}-->

				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
				<form name="form1" id="form1" method="post" action="./load_payment_module.php" autocomplete="off">
				<input type="hidden" name="mode" value="register">
					<tr><td height="5" class="fs12"></td></tr>
					<tr>
						<td bgcolor="#cccccc">
						<table width="666" border="0" cellspacing="1" cellpadding="10" summary=" ">
							<!--{if $tpl_payment_image != ""}-->
							<tr>
								<td width="170" class="fs12" bgcolor="#f3f3f3">�����Ѥ��������륫���ɤμ���</td>
								<td width="453" bgcolor="#ffffff">
								<img src="<!--{$smarty.const.IMAGE_SAVE_URL}--><!--{$tpl_payment_image}-->">
								</td>
							</tr>
							<!--{/if}-->
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">�������ֹ�</td>
								<td class="fs12" bgcolor="#ffffff">
								<table border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<!--{assign var=key1 value="card_no01"}-->
										<!--{assign var=key2 value="card_no02"}-->
										<!--{assign var=key3 value="card_no03"}-->
										<!--{assign var=key4 value="card_no04"}-->
										<td class="fs12">
										<span class="red"><!--{$arrErr[$key1]}--></span>
										<span class="red"><!--{$arrErr[$key2]}--></span>
										<span class="red"><!--{$arrErr[$key3]}--></span>
										<span class="red"><!--{$arrErr[$key4]}--></span>
										<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="ime-mode: disabled; <!--{$arrErr[$key1]|sfGetErrorColor}-->"  size="6" onkeyup="next(this, this.form.<!--{$key2}-->)" >&nbsp;-&nbsp;
										<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="ime-mode: disabled; <!--{$arrErr[$key2]|sfGetErrorColor}-->"  size="6" onkeyup="next(this, this.form.<!--{$key3}-->)" >&nbsp;-&nbsp;
										<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|escape}-->" maxlength="<!--{$arrForm[$key3].length}-->" style="ime-mode: disabled; <!--{$arrErr[$key3]|sfGetErrorColor}-->"  size="6" onkeyup="next(this, this.form.<!--{$key4}-->)" >&nbsp;-&nbsp;
										<input type="text" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|escape}-->" maxlength="<!--{$arrForm[$key4].length}-->" style="ime-mode: disabled; <!--{$arrErr[$key4]|sfGetErrorColor}-->"  size="6">
										</td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs10"><span class="orange">���ܿ�̾���Υ����ɤ򤴻��Ѥ���������</span><br>
										Ⱦ�����ϡ��㡧1234-5678-9012-3456��</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">�����ɲ��</td>
								<!--{assign var=key value="card_company"}-->
								<td  bgcolor="#ffffff" class="fs12">
								<span class="red"><!--{$arrErr[$key]}--></span>
								<select name="<!--{$key}-->" value="<!--{$arrForm[$key].value|escape}-->" maxlength="<!--{$arrForm[$key].length}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" >
								<option value="">--</option>
								<!--{html_options options=$arrCardCompany selected=$arrForm[$key].value}-->
								</select>
								</td>
							</tr>
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">ͭ������</td>
								<!--{assign var=key1 value="card_month"}-->
								<!--{assign var=key2 value="card_year"}-->
								<td  bgcolor="#ffffff" class="fs12">
								<span class="red"><!--{$arrErr[$key1]}--></span>
								<span class="red"><!--{$arrErr[$key2]}--></span>
								<select name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" >
								<option value="">--</option>
								<!--{html_options options=$arrMonth selected=$arrForm[$key1].value}-->
								</select>��/
								<select name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" >
								<option value="">--</option>
								<!--{html_options options=$arrYear selected=$arrForm[$key2].value}-->
								</select>ǯ</td>
							</tr>
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">������̾���ʥ��޻���̾��</td>
								<td bgcolor="#ffffff">
								<table border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<!--{assign var=key2 value="card_name01"}-->
										<!--{assign var=key1 value="card_name02"}-->
										<td class="fs12">
										<span class="red"><!--{$arrErr[$key1]}--></span>
										<span class="red"><!--{$arrErr[$key2]}--></span>
										̾&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="20" class="bo20">&nbsp;&nbsp;��&nbsp;
										<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" size="20" class="bo20"></td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs10">Ⱦ�����ϡ��㡧TARO YAMADA��</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">����ʧ����ˡ</td>
								<td bgcolor="#ffffff">
								<table cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<!--{assign var=key value="paymethod"}-->
										<td class="fs12n">
										<select name="<!--{$key}-->" value="<!--{$arrForm[$key].value|escape}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" >
										<!--{html_options options=$arrPayMethod selected=$arrForm[$key].value}-->
										</select></td>
									</tr>
								</table>
								</td>
							</tr>
							<!--{if $enable_ondemand}-->
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">���Υ����ɾ������Ͽ����</td>
								<td bgcolor="#ffffff">
								<table cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<!--{assign var=key value="register_ondemand"}-->
										<td class="fs12n">
										<span class="red"><!--{$arrErr[$key]}--></span>
										<input type="checkbox"
											   name="<!--{$key}-->"
											   value="1"
											   maxlength="<!--{$arrForm[$key].length}-->"
											   style="<!--{$arrErr[$key]|sfGetErrorColor}-->" <!--{if $arrForm[$key].value}-->checked=checked<!--{/if}-->>�����ɾ������Ͽ����<br>
											   �������ɤ���Ͽ����ȡ�����ʹ���Ͽ���������ɤ���Ѥ��뤳�Ȥ�����ޤ���
										</select></td>
									</tr>
								</table>
								</td>
							</tr>
							<!--{/if}-->
						</table>
						</td>
					</tr>
				</table>

				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr><td height="5"></td></tr>
					<tr>
						<td align="center" bgcolor="#f7f5f4">
						<table width="666" border="0" cellspacing="0" cellpadding="6" summary=" ">
							<tr>
								<td class="fs12st" align="center">�ʾ�����ƤǴְ㤤�ʤ���С���������ʸ��λ�ڡ����ءץܥ���򥯥�å����Ƥ���������<br>
								<span class="orange">�����̤��ڤ��ؤ�ޤǾ������֤��������礬�������ޤ��������Τޤޤ��Ԥ�����������</span></td>
							</tr>
							<tr>
								<td align="center" height="40" bgcolor="#f7f5f4">
									<a href="#" onclick="document.form2.submit(); return false;" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back_on.gif',back03)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif',back03)"><img src="<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03"/></a><img src="<!--{$smarty.const.URL_DIR}-->img/_.gif" width="12" height="" alt="" />
									<input type="image" onclick="return fnCheckSubmit();" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_next.gif',this)" src="<!--{$smarty.const.URL_DIR}-->img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</table>

				<!--{if $enable_ondemand && $cardCount > 0}-->
				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr><td height="5" class="fs12"></td></tr>
					<tr>
						<td bgcolor="#cccccc">
						<table width="666" border="0" cellspacing="1" cellpadding="10" summary=" ">
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">��Ͽ�ѤߤΥ����ɤ���Ѥ�����ϡ����Ѥ��륫���ɤ����򤷤Ʋ�������</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr><td height="5" class="fs12"></td></tr>
					<tr>
						<td bgcolor="#cccccc">
						<table width="666" border="0" cellspacing="1" cellpadding="10" summary=" ">
							<tr>
								<td class="fs12" bgcolor="#f3f3f3">����</td>
								<td class="fs12" bgcolor="#f3f3f3">�������ֹ�</td>
								<td class="fs12" bgcolor="#f3f3f3">ͭ������</td>
							</tr>
							<!--{if $arrErr.subs_id}-->
                            <tr>
                                <td class="fs12" bgcolor="#ffffff" colspan="3"><span class="red"><!--{$arrErr.subs_id}--></span></td>
                            </tr>
                            <!--{/if}-->
							<!--{foreach from=$arrCard item=card}-->
							<tr>
								<td class="fs12" bgcolor="#ffffff"><input type="radio" name="subs_id" value="<!--{$card.pay_subscription_retrieve_subscription_id}-->"></td>
								<td class="fs12" bgcolor="#ffffff"><!--{$card.pay_subscription_retrieve_customer_cc_number}--></td>
								<td class="fs12" bgcolor="#ffffff">
									<!--{$card.pay_subscription_retrieve_customer_cc_expmo}-->��/<!--{$card.pay_subscription_retrieve_customer_cc_expyr}-->
								</td>
							</tr>
							<!--{/foreach}-->
						</table>
						</td>
					</tr>
				</table>

				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr><td height="5"></td></tr>
					<tr>
						<td align="center" bgcolor="#f7f5f4">
						<table width="666" border="0" cellspacing="0" cellpadding="6" summary=" ">
							<tr>
								<td class="fs12st" align="center">�ʾ�����ƤǴְ㤤�ʤ���С���������ʸ��λ�ڡ����ءץܥ���򥯥�å����Ƥ���������<br>
								<span class="orange">�����̤��ڤ��ؤ�ޤǾ������֤��������礬�������ޤ��������Τޤޤ��Ԥ�����������</span></td>
							</tr>
							<tr>
								<td align="center" height="40" bgcolor="#f7f5f4">
									<a href="#" onclick="document.form2.submit(); return false;" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back_on.gif',back03)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif',back03)"><img src="<!--{$smarty.const.URL_DIR}-->img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03"/></a><img src="<!--{$smarty.const.URL_DIR}-->img/_.gif" width="12" height="" alt="" />
									<input type="image" onclick="document.form1['mode'].value = 'ondemand'; return fnCheckSubmit();" onmouseover="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('<!--{$smarty.const.URL_DIR}-->img/common/b_next.gif',this)" src="<!--{$smarty.const.URL_DIR}-->img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
								</td>
							</tr>
						</table>

						</td>
					</tr>
				</table>
				<!--{/if}-->

				</td>
			</tr>
		</table>
		</form>
		<form name="form2" id="form2" method="post" action="./load_payment_module.php" autocomplete="off">
		<input type="hidden" name="mode" value="return">
		</form>
		<!--��MAIN CONTENTS-->
		</td>
	</tr>

</table>
<!--��CONTENTS-->