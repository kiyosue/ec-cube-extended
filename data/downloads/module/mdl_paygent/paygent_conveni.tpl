<script type="text/javascript">
<!--
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

function next(now, next) {
	if (now.value.length >= now.getAttribute('maxlength')) {
	next.focus();
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
				<td><img src="/img/shopping/flow03.gif" width="700" height="36" alt="������³����ή��"></td>

			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��-->
		
		<!--��MAIN CONTENTS-->				
				<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr>
						<td colspan="3"><img src="/img/contents/contents_title_top.gif" width="666" height="7" alt=""></td>
					</tr>
					<tr>
						<td background="/img/contents/contents_title_left_bg.gif"><img src="/img/contents/contents_title_left.gif" width="22" height="12" alt=""></td>
						<td bgcolor="#636469" width="638" class="fs16n"><strong><span class="white"><!--{$tpl_payment_method}--></span><strong></td>
						<td background="/img/contents/contents_title_right_bg.gif"><img src="/img/common/_.gif" width="18" height="1" alt=""></td>
					</tr>
					<tr>
						<td colspan="3"><img src="/img/contents/contents_title_bottom.gif" width="666" height="7" alt=""></td>
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
										<span class="redst"><!--{$tpl_error}--></span>
										</td>
									</tr>
								</table>
							</tr>
							<tr><td height="15"></td></tr>
						</table>
						<!--{/if}-->
						<table width="666" border="0" cellspacing="0" cellpadding="0" summary=" ">
						<form name="form1" id="form1" method="post" action="./load_payment_module.php" autocomplete="off">
						<input type="hidden" name="mode" value="next">
						<input type="hidden" name="uniqid" value="">
							<tr>
								<td bgcolor="#cccccc">
								<table width="666" border="0" cellspacing="1" cellpadding="10" summary=" ">
									<!--{if $tpl_payment_image != ""}-->
									<tr>
										<td width="170" class="fs12" bgcolor="#f3f3f3">�����Ѥ��������륳��ӥˤμ���</td>
										<td width="453" bgcolor="#ffffff">
										<img src="<!--{$smarty.const.IMAGE_SAVE_URL}--><!--{$tpl_payment_image}-->">
										</td>
									</tr>
									<!--{/if}-->
									<tr>
										<td class="fs12" bgcolor="#f3f3f3">����ӥ�����</td>
										<td bgcolor="#ffffff">
										<table border="0" cellspacing="0" cellpadding="0" summary=" ">
											<tr>
												<!--{assign var=key1 value="cvs_company_id"}-->
												<td class="fs12"><span class="red"><!--{$arrErr[$key1]}--></span>
												<select name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" >
												<option value="">�����򤯤�����</option>
												<!--{html_options options=$arrConvenience selected=$arrForm[$key1].value}-->
												</select></td>
											</tr>
										</table>
										</td>
									</tr>																			
									<tr>
										<td class="fs12" bgcolor="#f3f3f3">���Ѽ�</td>
										<td bgcolor="#ffffff">
										<table border="0" cellspacing="0" cellpadding="0" summary=" ">
											<tr>
												<!--{assign var=key1 value="customer_family_name"}-->
												<!--{assign var=key2 value="customer_name"}-->								
												<td class="fs12">
												<span class="red"><!--{$arrErr[$key1]}--></span>
												<span class="red"><!--{$arrErr[$key2]}--></span>
												��&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="20" class="bo20">&nbsp;&nbsp;
												̾&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" size="20" class="bo20"></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td class="fs12" bgcolor="#f3f3f3">���Ѽ�(����)</td>
										<td bgcolor="#ffffff">
										<table border="0" cellspacing="0" cellpadding="0" summary=" ">
											<tr>
												<!--{assign var=key1 value="customer_family_name_kana"}-->
												<!--{assign var=key2 value="customer_name_kana"}-->								
												<td class="fs12">
												<span class="red"><!--{$arrErr[$key1]}--></span>
												<span class="red"><!--{$arrErr[$key2]}--></span>
												����&nbsp;<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" size="20" class="bo20">&nbsp;&nbsp;
												�ᥤ&nbsp;<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" style="<!--{$arrErr[$key2]|sfGetErrorColor}-->" size="20" class="bo20"></td>
											</tr>
											<tr><td height="5"></td></tr>
											<tr>
												<td class="fs10">�����ʤ������ʡ��ˤ�Ⱦ�����ʡ��ˤ������硢��������Τ߽�������ޤ���ͽ�ᤴλ������������</td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td class="fs12" bgcolor="#f3f3f3">�������ֹ�</td>
										<td bgcolor="#ffffff">
										<table border="0" cellspacing="0" cellpadding="0" summary=" ">
											<tr>
												<!--{assign var=key1 value="customer_tel"}-->
												<td class="fs12">
												<span class="red"><!--{$arrErr[$key1]}--></span>
												<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="ime-mode: disabled; <!--{$arrErr[$key1]|sfGetErrorColor}-->" size="20" class="bo20">&nbsp;&nbsp;
											</tr>
										</table>
										</td>
									</tr>
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
										<td class="fs12st" align="center">�ʾ�����ƤǴְ㤤�ʤ���С������ּ��ءץܥ���򥯥�å����Ƥ���������<br>
										<span class="orange">�����̤��ڤ��ؤ�ޤǾ������֤��������礬�������ޤ��������Τޤޤ��Ԥ�����������</span></td>
									</tr>
									<tr>
										<td align="center" height="40" bgcolor="#f7f5f4">
											<a href="#" onclick="document.form2.submit(); return false;" onmouseover="chgImgImageSubmit('/img/common/b_back_on.gif',back03)" onmouseout="chgImgImageSubmit('/img/common/b_back.gif',back03)"><img src="/img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03"/></a><img src="/img/_.gif" width="12" height="" alt="" />
											<input type="image" onclick="return fnCheckSubmit();" onmouseover="chgImgImageSubmit('/img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('/img/common/b_next.gif',this)" src="/img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
										</td>
									</tr>
								</table>

								</td>
							</tr>
						</table>
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