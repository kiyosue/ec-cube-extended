<?php /* Smarty version 2.6.13, created on 2007-01-10 00:21:40
         compiled from contact/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'contact/index.tpl', 12, false),array('modifier', 'default', 'contact/index.tpl', 35, false),array('modifier', 'sfGetErrorColor', 'contact/index.tpl', 35, false),array('function', 'html_options', 'contact/index.tpl', 69, false),)), $this); ?>
<!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr valign="top">
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="580" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="mode" value="confirm">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/contact/title.jpg" width="580" height="40" alt="���䤤��碌"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">���䤤��碌�ϥ᡼��ˤƾ��äƤ��ޤ���<br>
				���Ƥˤ�äƤϲ����򤵤�������Τˤ����֤򤤤��������Ȥ⤴�����ޤ����ޤ����������˺�����ǯ��ǯ�ϡ��Ƶ����֤���Ķ����ʹߤ��б��Ȥʤ�ޤ��ΤǤ�λ������������</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs10"><span class="red">������ʸ�˴ؤ��뤪�䤤��碌�ˤϡ�ɬ���֤���ʸ�ֹ�פȡ֤�̾���פ򤴵����ξ塢�᡼�뤯�������ޤ��褦���ꤤ�������ޤ���</span></td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc" align="center">
				<!--���ϥե����ळ������-->
				<table width="" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="135" bgcolor="#f0f0f0" class="fs12n">��̾��<span class="red">��</span></td>
						<td width="402" bgcolor="#ffffff" class="fs12n">
							<span class="red"><?php echo $this->_tpl_vars['arrErr']['name01'];  echo $this->_tpl_vars['arrErr']['name02']; ?>
</span>
							��&nbsp;<input type="text" name="name01" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['name01']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['name01'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" class="box15" />��̾&nbsp;<input type="text" name="name02" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['name02']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['name02'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['name02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n"><span class="red">
							<?php echo $this->_tpl_vars['arrErr']['kana01'];  echo $this->_tpl_vars['arrErr']['kana02']; ?>
</span>
							����&nbsp;<input type="text" name="kana01" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['kana01']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['kana01'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" class="box15" />���ᥤ&nbsp;<input type="text" name="kana02" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['kana02']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['kana02'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['kana02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">͹���ֹ�</td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td colspan="2"><span class="fs12n"><?php echo $this->_tpl_vars['arrErr']['zip01'];  echo $this->_tpl_vars['arrErr']['zip02']; ?>
</span>
								��&nbsp;<input type="text" name="zip01" size="6" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['zip01']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['zip01'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @ZIP01_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />&nbsp;-&nbsp;<input type="text" name="zip02" size="6" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['zip02']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['zip02'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @ZIP02_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['zip02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />��<a href="http://search.post.japanpost.jp/7zip/" target="_blank"><span class="fs10">͹���ֹ渡��</span></a></td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><a href="#" onClick="fnCallAddress('<?php echo @URL_INPUT_ZIP; ?>
', 'zip01', 'zip02', 'pref', 'addr01'); return false;"><img src="<?php echo @URL_DIR; ?>
img/common/address.gif" width="86" height="20" alt="���꼫ư����" /></a></td>
								<td class="fs10n">&nbsp;͹���ֹ�����ϸ塢����å����Ƥ���������</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">����</td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td><span class="red"><?php echo $this->_tpl_vars['arrErr']['pref'];  echo $this->_tpl_vars['arrErr']['addr01'];  echo $this->_tpl_vars['arrErr']['addr02']; ?>
</span>
								<select name="pref" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['pref'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
								<option value="" selected>��ƻ�ܸ�������</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['pref'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['pref']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['pref']))), $this);?>

								</select></td>
							</tr>
							<tr><td height="7"></td>
							</tr>
							<tr>
								<td><input type="text" name="addr01" size="40" class="box40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['addr01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['addr01']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['addr01'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"/></td>
							</tr>
							<tr>
								<td class="fs10n">�Զ�Į¼̾���㡧�����̶�Ʋ���</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><input type="text" name="addr02" size="40" class="box40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['addr02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['addr02']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['addr02'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['addr02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"/><span class="mini"></td>
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
						<td bgcolor="#f0f0f0" class="fs12n">�����ֹ�</td>
						<td bgcolor="#ffffff" class="fs12n">
							<?php echo $this->_tpl_vars['arrErr']['tel01'];  echo $this->_tpl_vars['arrErr']['tel02'];  echo $this->_tpl_vars['arrErr']['tel03']; ?>
</span>
							<input type="text" name="tel01" size="6" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tel01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['tel01']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['tel01'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel01'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />&nbsp;-&nbsp;<input type="text" name="tel02" size="6" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tel02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['tel02']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['tel02'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />&nbsp;-&nbsp;<input type="text" name="tel03" size="6" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tel03'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['tel03']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['tel03'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @TEL_ITEM_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['tel03'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">�᡼�륢�ɥ쥹<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td bgcolor="#ffffff" class="fs12n">
									<span class="red"><?php echo $this->_tpl_vars['arrErr']['email'];  echo $this->_tpl_vars['arrErr']['email02']; ?>
</span>
									<input type="text" name="email" size="40" class="box40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['arrData']['email']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['arrData']['email'])))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo @MTEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><input type="text" name="email02" size="40" class="box40" value=<?php if ($_SERVER['REQUEST_METHOD'] != 'POST' & $_SESSION['customer']): ?> "<?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php else: ?> "<?php echo ((is_array($_tmp=$this->_tpl_vars['email02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php endif; ?> maxlength="<?php echo @MTEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['email02'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" /></td>
							</tr>
							<tr><td height="2"></td></tr>
							<tr>
								<td class="fs10n"><span class="red">��ǧ�Τ���2�����Ϥ��Ƥ���������</span></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">���䤤��碌����<span class="red">��</span><br>
						<span class="mini">������<?php echo @MLTEXT_LEN; ?>
���ʲ���</span></td>
						<td bgcolor="#ffffff" class="fs12n">
							<span class="red"><?php echo $this->_tpl_vars['arrErr']['contents']; ?>
</span>
							<textarea name="contents" cols="60" rows="20" class="area60" wrap="hard" maxlength="<?php echo @LTEXT_LEN; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['contents'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"><?php echo $this->_tpl_vars['contents']; ?>
</textarea>
						</td>
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




