<?php /* Smarty version 2.6.13, created on 2007-01-10 18:45:06
         compiled from /home/web/beta.ec-cube.net/html/user_data/templates/mypage/change.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/web/beta.ec-cube.net/html/user_data/templates/mypage/change.tpl', 24, false),array('modifier', 'sfGetErrorColor', '/home/web/beta.ec-cube.net/html/user_data/templates/mypage/change.tpl', 43, false),array('function', 'html_options', '/home/web/beta.ec-cube.net/html/user_data/templates/mypage/change.tpl', 78, false),)), $this); ?>
<!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/mypage/title.jpg" width="700" height="40" alt="MY�ڡ���"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr valign="top">
				<td>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tpl_navi'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</td>
				<td align="right">
				<table width="515" border="0" cellspacing="0" cellpadding="0" summary=" ">
				<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
				<input type="hidden" name="mode" value="confirm">
				<input type="hidden" name="customer_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['customer_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
					<tr>
						<td><!--�������ȥ�--><img src="<?php echo @URL_DIR; ?>
img/mypage/subtitle02.gif" width="515" height="32" alt="�����Ͽ�����ѹ�"></td>
					</tr>
					<tr><td height="15"></td></tr>
					<tr>
						<td class="fs12">�������ܤˤ����Ϥ�����������<span class="red">��</span>�װ�������ɬ�ܹ��ܤǤ���<br>
						���ϸ塢���ֲ��Ρֳ�ǧ�ڡ����ءץܥ���򥯥�å����Ƥ���������</td>
					</tr>
					<tr><td height="10"></td></tr>
					<tr>
						<td bgcolor="#cccccc" align="center">
						<!--���ϥե����ळ������-->
						<table width="515" border="0" cellspacing="1" cellpadding="10" summary=" ">
							<tr>
								<td width="122" bgcolor="#f0f0f0" class="fs12n">��̾��<span class="red">��</span></td>
								<td width="350" bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['name01'];  echo $this->_tpl_vars['arrErr']['name02']; ?>
</span>
									��&nbsp;<input type="text" name="name01" value="<?php echo $this->_tpl_vars['arrForm']['name01']; ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" size="15" class="box15" />��̾&nbsp;<input type="text" name="name02" value="<?php echo $this->_tpl_vars['arrForm']['name02']; ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" size="15" class="box15" />	
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
								<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['kana01'];  echo $this->_tpl_vars['arrErr']['kana02']; ?>
</span>
								����&nbsp;<input type="text" name="kana01" value="<?php echo $this->_tpl_vars['arrForm']['kana01']; ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" size="15" class="box15" />���ᥤ&nbsp;<input type="text" name="kana02" value="<?php echo $this->_tpl_vars['arrForm']['kana02']; ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" size="15" class="box15" /></td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">͹���ֹ�<span class="red">��</span></td>
								<td bgcolor="#ffffff">
								<table border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<?php $this->assign('key1', 'zip01'); ?>
										<?php $this->assign('key2', 'zip02'); ?>
										<td colspan="2"><span class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
										��&nbsp;<input type="text" name="zip01" value="<?php echo $this->_tpl_vars['arrForm']['zip01']; ?>
" maxlength="<?php echo @ZIP01_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" size=6 class="box6" />&nbsp;-&nbsp;<input type="text" name="zip02" value="<?php echo $this->_tpl_vars['arrForm']['zip02']; ?>
" maxlength="<?php echo @ZIP02_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" size=6 class="box6" />��
										<a href="http://search.post.japanpost.jp/7zip/" target="_blank"><span class="fs12">͹���ֹ渡��</span></a></td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td><a href="<?php echo @URL_DIR; ?>
input_zip.php" onclick="fnCallAddress('<?php echo @URL_INPUT_ZIP; ?>
', 'zip01', 'zip02', 'pref', 'addr01'); return false;" target="_blank"><img src="<?php echo @URL_DIR; ?>
img/common/address.gif" width="86" height="20" alt="���꼫ư����" /></a></td>
										<td class="fs10n">&nbsp;͹���ֹ�����ϸ塢����å����Ƥ���������</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12">����<span class="red">��</span></td>
								<td bgcolor="#ffffff">
								<table border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['pref'];  echo $this->_tpl_vars['arrErr']['addr01'];  echo $this->_tpl_vars['arrErr']['addr02']; ?>
</span>
										<select name="pref" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['pref'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected>��ƻ�ܸ�������</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => $this->_tpl_vars['arrForm']['pref']), $this);?>

										</select></td>
									</tr>
									<tr><td height="7"></td>
									</tr>
									<tr>
										<td><input type="text" name="addr01" value="<?php echo $this->_tpl_vars['arrForm']['addr01']; ?>
" size="60" class="box60" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" /></td>
									</tr>
									<tr>
										<td class="fs10n">�Զ�Į¼̾���㡧�����̶�Ʋ���</td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td><input type="text" name="addr02" value="<?php echo $this->_tpl_vars['arrForm']['addr02']; ?>
" size="60" class="box60" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" /></td>
									</tr>
									<tr>
										<td class="fs10n">���ϡ��ӥ�̾���㡧6-1-1��</td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs10"><span class="red">�����2�Ĥ�ʬ���Ƥ��������������ޤ����ޥ󥷥��̾��ɬ���������Ƥ���������</span></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">�����ֹ�<span class="red">��</span></td>
								<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['tel01'];  echo $this->_tpl_vars['arrErr']['tel02'];  echo $this->_tpl_vars['arrErr']['tel03']; ?>
</span><input type="text" name="tel01" value="<?php echo $this->_tpl_vars['arrForm']['tel01']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="tel02" value="<?php echo $this->_tpl_vars['arrForm']['tel02']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="tel03" value="<?php echo $this->_tpl_vars['arrForm']['tel03']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel03'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">FAX</td>
								<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['fax01'];  echo $this->_tpl_vars['arrErr']['fax02'];  echo $this->_tpl_vars['arrErr']['fax03']; ?>
</span><input type="text" name="fax01" value="<?php echo $this->_tpl_vars['arrForm']['fax01']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="fax02" value="<?php echo $this->_tpl_vars['arrForm']['fax02']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="fax03" value="<?php echo $this->_tpl_vars['arrForm']['fax03']; ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" size="6" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax03'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">�᡼�륢�ɥ쥹<span class="red">��</span></td>
								<td bgcolor="#ffffff">
								<table border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['email']; ?>
</span>
										<input type="text" name="email" value= "<?php echo $this->_tpl_vars['arrForm']['email']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" maxlength="<?php echo @MTEXT_LEN; ?>
" size=40 class="box40" /></td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['email02']; ?>
</span>
										<input type="text" name="email02" value= "<?php if ($this->_tpl_vars['arrForm']['email02'] == ""):  echo $this->_tpl_vars['arrForm']['email'];  else:  echo $this->_tpl_vars['arrForm']['email02'];  endif; ?>" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" maxlength="<?php echo @MTEXT_LEN; ?>
" size=40 class="box40" /></td>
									</tr>
									<tr><td height="2"></td></tr>
									<tr>
										<td class="fs10n"><span class="red">��ǧ�Τ���2�����Ϥ��Ƥ���������</span></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">����<span class="red">��</span></td>
								<td bgcolor="#ffffff" class="fs12n">
								<span class="red"><?php echo $this->_tpl_vars['arrErr']['sex']; ?>
</span><input type="radio" id="man" name="sex" value="1" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['sex'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrForm']['sex'] == 1): ?> checked <?php endif; ?> /><label for="man">����</label>��<input type="radio" id="woman" name="sex" value="2" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['sex'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrForm']['sex'] == 2): ?> checked <?php endif; ?> /><label for="woman">����</label></td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">����</td>
								<td bgcolor="#ffffff">
									<span class="red"><?php echo $this->_tpl_vars['arrErr']['job']; ?>
</span>
									<select name="job">
									<option value="" selected>���򤷤Ƥ�������</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrJob'],'selected' => $this->_tpl_vars['arrForm']['job']), $this);?>

									</select>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12n">��ǯ����</td>
								<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['year'];  echo $this->_tpl_vars['arrErr']['month'];  echo $this->_tpl_vars['arrErr']['day']; ?>
</span>
									<select name="year" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
									<option value="" selected>--</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['year']), $this);?>

									</select>&nbsp;ǯ
									<select name="month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['month'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"><span class="red"><?php echo $this->_tpl_vars['arrErr']['month']; ?>
</span>
									<option value="" selected>--</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['month']), $this);?>

									</select>&nbsp;��
									<select name="day" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['day'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"><span class="red"><?php echo $this->_tpl_vars['arrErr']['day']; ?>
</span>
									<option value="" selected>--</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['day']), $this);?>

									</select>&nbsp;��
								</td>
							</tr>

							<tr>
								<td bgcolor="#f0f0f0"><span class="fs12">��˾����ѥ����<span class="red">��</span></span><br>
								<span class="fs10">�ѥ���ɤϹ�������ɬ�פǤ�</span></td>
								<td bgcolor="#ffffff">
								<table cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['password']; ?>
</span>
										<input type="password" name="password" value="<?php echo $this->_tpl_vars['arrForm']['password']; ?>
" maxlength="<?php echo @PASSWORD_LEN2; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['password'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size=15 class="box15" /></td>
									</tr>
									<tr><td height="2"></td></tr>
									<tr>
										<td class="fs10n"><span class="red">Ⱦ�ѱѿ���4��10ʸ���Ǥ��ꤤ���ޤ����ʵ����Բġ�</span></td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['password02']; ?>
</span>
									  	<input type="password" name="password02" value="<?php echo $this->_tpl_vars['arrForm']['password02']; ?>
" maxlength="<?php echo @PASSWORD_LEN2; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['password02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size=15 class="box15" /></td>
									</tr>
									<tr><td height="2"></td></tr>
									<tr>
										<td class="fs10n"><span class="red">��ǧ�Τ����2�����Ϥ��Ƥ���������</span></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12">�ѥ���ɤ�˺�줿���Υҥ��<span class="red">��</span></td>
								<td bgcolor="#ffffff">
								<table cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['reminder']; ?>
</span><select name="reminder" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reminder'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
											<option value="" selected>���򤷤Ƥ�������</option>
											<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrReminder'],'selected' => $this->_tpl_vars['arrForm']['reminder']), $this);?>

											</select>
										</td>
									</tr>
									<tr><td height="5"></td></tr>
									<tr>
										<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['reminder_answer']; ?>
</span><input type="text" name="reminder_answer" value="<?php echo $this->_tpl_vars['arrForm']['reminder_answer']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reminder_answer'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" size=40 class="box40" /></td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#f0f0f0" class="fs12">�᡼��ޥ��������դˤĤ���<span class="red">��</span></td>
								<td bgcolor="#ffffff" class="fs12">
									<span class="red"><?php echo $this->_tpl_vars['arrErr']['mail_flag']; ?>
</span>
									<input type="radio" name="mail_flag" value="1" id="html" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrForm']['mail_flag'] == 1): ?> checked <?php endif; ?> />HTML�᡼��ܥƥ����ȥ᡼���������</label><br>
									<input type="radio" name="mail_flag" value="2" id="text" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrForm']['mail_flag'] == 2): ?> checked <?php endif; ?> /><label for="text">�ƥ����ȥ᡼���������</label><br>
									<input type="radio" name="mail_flag" value="3" id="no" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrForm']['mail_flag'] == 3): ?> checked <?php endif; ?> /><label for="no">�������ʤ�</label>
								</td>
							</tr>
						</table>
						<!--���ϥե����ळ���ޤ�-->
						</td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr>
						<td align="center">
							<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_confirm_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_confirm.gif',this)" src="<?php echo @URL_DIR; ?>
img/common/b_confirm.gif" width="150" height="30" alt="��ǧ�ڡ�����" name="refusal" id="refusal" />
						</td>
					</tr>
				</form>
				</table>
				</td>
			</tr>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->
