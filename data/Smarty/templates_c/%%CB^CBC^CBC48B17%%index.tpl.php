<?php /* Smarty version 2.6.13, created on 2007-01-10 00:01:44
         compiled from entry/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'entry/index.tpl', 12, false),array('modifier', 'sfGetErrorColor', 'entry/index.tpl', 29, false),array('function', 'html_options', 'entry/index.tpl', 64, false),)), $this); ?>
 <!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr valign="top">
		<td align="right" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="580" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="mode" value="confirm">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/entry/title.jpg" width="580" height="40" alt="�����Ͽ"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">����Ͽ����ޤ��ȡ��ޤ��ϲ�����Ȥʤ�ޤ���<br>
				���Ϥ��줿�᡼�륢�ɥ쥹�ˡ���Ϣ���Ϥ��ޤ��Τǡ��ܲ���ˤʤä���Ǥ��㤤ʪ�򤪳ڤ��ߤ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc" align="center">
				<!--���ϥե����ळ������-->
				<table width="580" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="135" bgcolor="#f0f0f0" class="fs12n">��̾��<span class="red">��</span></td>
						<td width="402" bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['name01'];  echo $this->_tpl_vars['arrErr']['name02']; ?>
</span>��&nbsp;<input type="text" name="name01" size="15" class="box15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" />��̾&nbsp;<input type="text" name="name02" size="15" class="box15"value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" /></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['kana01'];  echo $this->_tpl_vars['arrErr']['kana02']; ?>
</span>����&nbsp;<input type="text" name="kana01" size="15" class="box15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" />���ᥤ&nbsp;<input type="text" name="kana02" size="15" class="box15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" /></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">͹���ֹ�<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td colspan="2">
									<?php $this->assign('key1', 'zip01'); ?>
									<?php $this->assign('key2', 'zip02'); ?>
									<span class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span></span>
									<span class="fs12n">��&nbsp;</span><input type="text" name="zip01" value="<?php if ($this->_tpl_vars['zip01'] == ""):  echo ((is_array($_tmp=$this->_tpl_vars['arrOtherDeliv']['zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  endif; ?>" maxlength="<?php echo @ZIP01_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" size=6 class="box6" />&nbsp;-&nbsp;<input type="text" name="zip02" value="<?php if ($this->_tpl_vars['zip02'] == ""):  echo ((is_array($_tmp=$this->_tpl_vars['arrOtherDeliv']['zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  else:  echo ((is_array($_tmp=$this->_tpl_vars['zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  endif; ?>" maxlength="<?php echo @ZIP02_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" size=6 class="box6" />��
									<a href="http://search.post.japanpost.jp/7zip/" target="_blank"><span class="fs10">͹���ֹ渡��</span></a>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><a href="<?php echo @URL_DIR; ?>
address/index.php" onclick="fnCallAddress('<?php echo @URL_INPUT_ZIP; ?>
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
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => $this->_tpl_vars['pref']), $this);?>

								</select></td>
							</tr>
							<tr><td height="7"></td>
							</tr>
							<tr>
								<td><input type="text" name="addr01" size="40" class="box40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['addr01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;"/></td>
							</tr>
							<tr>
								<td class="fs10n">�Զ�Į¼̾���㡧�����̶�Ʋ���</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><input type="text" name="addr02" size="40" class="box40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['addr02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
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
</span><input type="text" name="tel01" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tel01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="tel02" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tel02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="tel03" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tel03'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel03'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">FAX</td>
						<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['fax01'];  echo $this->_tpl_vars['arrErr']['fax02'];  echo $this->_tpl_vars['arrErr']['fax03']; ?>
</span><input type="text" name="fax01" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fax01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
"  style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="fax02" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fax02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" />&nbsp;-&nbsp;<input type="text" name="fax03" size="6" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fax02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['fax01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">�᡼�륢�ɥ쥹<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr><span class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['email'];  echo $this->_tpl_vars['arrErr']['email02']; ?>
</span></span>
								<td><input type="text" name="email" size="40" class="box40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><input type="text" name="email02" size="40" class="box40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['email02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" /></td>
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
						<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['sex']; ?>
</span>
							<input type="radio" name="sex" id="man" value="1" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['sex'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['sex'] == 1): ?>checked<?php endif; ?> /><label for="man">����</label>��<input type="radio" name="sex" id="woman" value="2" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['sex'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['sex'] == 2): ?>checked<?php endif; ?> /><label for="woman">����</label>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">����</td>
						<td bgcolor="#ffffff"><span class="red"><?php echo $this->_tpl_vars['arrErr']['job']; ?>
</span>
						<select name="job" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['job'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
						<option value="" selected>���򤷤Ƥ�������</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrJob'],'selected' => $this->_tpl_vars['job']), $this);?>

						</select></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��ǯ����</td>
						<td bgcolor="#ffffff" class="fs12n">
						<table cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['year'];  echo $this->_tpl_vars['arrErr']['month'];  echo $this->_tpl_vars['arrErr']['day']; ?>
</span>
									<select name="year" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['year']), $this);?>

									</select>ǯ
									<select name="month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="">--</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['month']), $this);?>

									</select>��
									<select value="" name="day" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="">--</option>\
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['day']), $this);?>

									</select>��</td>
							</tr>
							<tr><td height="2"></td></tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" ><span class="fs12">��˾����ѥ����<span class="red">��</span></span><br>
						<span class="fs10">�ѥ���ɤϹ�������ɬ�פǤ�</span></td>
						<td bgcolor="#ffffff">
						<table cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['password'];  echo $this->_tpl_vars['arrErr']['password02']; ?>
</span><input type="password" name="password" value="<?php echo $this->_tpl_vars['arrForm']['password']; ?>
"size="15" class="box15"  style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['password'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"/></td>
							</tr>
							<tr><td height="2"></td></tr>
							<tr>
								<td class="fs10n"><span class="red">Ⱦ�ѱѿ���4��10ʸ���Ǥ��ꤤ���ޤ����ʵ����Բġ�</span></td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><input type="password" name="password02" value="<?php echo $this->_tpl_vars['arrForm']['password02']; ?>
" size="15" class="box15"  style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['password02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"/></td>
							</tr>
							<tr><td height="2"></td></tr>
							<tr>
								<td class="fs10n"><span class="red">��ǧ�Τ����2�����Ϥ��Ƥ���������</span></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0"  class="fs12">�ѥ���ɤ�˺�줿���Υҥ��<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['reminder'];  echo $this->_tpl_vars['arrErr']['reminder_answer']; ?>
</span>
						<table cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12n">���䡧</td>
								<td>
									<select name="reminder" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reminder'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected>���򤷤Ƥ�������</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrReminder'],'selected' => $this->_tpl_vars['reminder']), $this);?>

									</select>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td class="fs12n">������</td>

								<td><input type="text" name="reminder_answer" size="33" class="box33" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['reminder_answer'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reminder_answer'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
; ime-mode: active;" /></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">�᡼��ޥ��������դˤĤ���<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12"><span class="red"><?php echo $this->_tpl_vars['arrErr']['mail_flag']; ?>
</span>
						<input type="radio" name="mail_flag" id="html" value="1" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['mail_flag'] == 1 || $this->_tpl_vars['mail_flag'] == ""): ?>checked<?php endif; ?> /><label for="html">HTML�᡼��ܥƥ����ȥ᡼���������</label><br>
						<input type="radio" name="mail_flag" id="text"value="2" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['mail_flag'] == 2): ?>checked<?php endif; ?> /><label for="text">�ƥ����ȥ᡼���������</label><br>
						<input type="radio" name="mail_flag" id="no" value="3" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['mail_flag'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php if ($this->_tpl_vars['mail_flag'] == 3): ?>checked<?php endif; ?> /><label for="no">�������ʤ�</label></td>
					</tr>
				</table>
				<!--���ϥե����ळ���ޤ�-->
				</td>
			</tr>
			<tr><td height="25"></td></tr>
			<tr align="center">
				<td>
					<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_confirm_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_confirm.gif',this)" src="<?php echo @URL_DIR; ?>
img/common/b_confirm.gif" width="150" height="30" alt="��ǧ�ڡ�����" border="0" name="confirm" id="confirm" />
				</td>
			</tr>
		</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->