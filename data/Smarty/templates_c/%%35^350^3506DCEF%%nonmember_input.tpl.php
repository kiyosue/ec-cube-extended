<?php /* Smarty version 2.6.13, created on 2007-01-10 00:19:20
         compiled from shopping/nonmember_input.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shopping/nonmember_input.tpl', 8, false),array('modifier', 'sfGetErrorColor', 'shopping/nonmember_input.tpl', 43, false),array('modifier', 'sfGetChecked', 'shopping/nonmember_input.tpl', 239, false),array('function', 'html_options', 'shopping/nonmember_input.tpl', 90, false),array('function', 'html_radios', 'shopping/nonmember_input.tpl', 184, false),)), $this); ?>
<!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="hidden" name="mode" value="nonmember_confirm">
<input type="hidden" name="uniqid" value="<?php echo $this->_tpl_vars['tpl_uniqid']; ?>
">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<!--������³����ή��-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/flow01.gif" width="700" height="36" alt="������³����ή��"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��-->
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/info_title.jpg" width="700" height="40" alt="�����;�������"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">�������ܤˤ����Ϥ�����������<span class="red">��</span>�װ�������ɬ�ܹ��ܤǤ���<br>
				���ϸ塢���ֲ��Ρֳ�ǧ�ڡ����ءץܥ���򥯥�å����Ƥ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc" align="center">
				<!--���ϥե����ळ������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="170" bgcolor="#f0f0f0" class="fs12n">��̾��<span class="red">��</span></td>
						<td width="487" bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'order_name01'); ?>
							<?php $this->assign('key2', 'order_name02'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							��&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />��̾&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'order_kana01'); ?>
							<?php $this->assign('key2', 'order_kana02'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							����&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />���ᥤ&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">͹���ֹ�<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td colspan="2" >
									<?php $this->assign('key1', 'order_zip01'); ?>
									<?php $this->assign('key2', 'order_zip02'); ?>
									<span class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span></span>
									��
									<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" />
									 - 
									<input type="text"  name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" />��
									<a href="http://search.post.japanpost.jp/7zip/" target="_blank"><span class="fs10">͹���ֹ渡��</span></a>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><a href="<?php echo @URL_DIR; ?>
address/index.php" onclick="fnCallAddress('<?php echo @URL_INPUT_ZIP; ?>
', 'order_zip01', 'order_zip02', 'order_pref', 'order_addr01'); return false;" target="_blank"><img src="<?php echo @URL_DIR; ?>
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
								<td class="fs12n">
									<?php $this->assign('key', 'order_pref'); ?>
									<span class="red"><?php echo $this->_tpl_vars['arrErr']['order_pref'];  echo $this->_tpl_vars['arrErr']['order_addr01'];  echo $this->_tpl_vars['arrErr']['order_addr02']; ?>
</span>
									<select name="<?php echo $this->_tpl_vars['key']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">							
									<option value="" selected="">��ƻ�ܸ�������</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']), $this);?>

									</select>
								</td>
							</tr>
							<tr><td height="7"></td>
							</tr>
							<tr>
								<td class="fs12">
									<?php $this->assign('key', 'order_addr01'); ?>
									<input type="text" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="40" class="box40" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" /><span class="mini"></span>
								</td>
							</tr>
							<tr>
								<td class="fs10n">�Զ�Į¼̾���㡧�����̶�Ʋ���</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td>
									<?php $this->assign('key', 'order_addr02'); ?>
									<input type="text" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="40" class="box40" maxlength=<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" /><span class="mini"></span>
								</td>
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
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'order_tel01'); ?>
							<?php $this->assign('key2', 'order_tel02'); ?>
							<?php $this->assign('key3', 'order_tel03'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']]; ?>
</span>
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">FAX</td>
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'order_fax01'); ?>
							<?php $this->assign('key2', 'order_fax02'); ?>
							<?php $this->assign('key3', 'order_fax03'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']]; ?>
</span>
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">�᡼�륢�ɥ쥹<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12n">
									<?php $this->assign('key', 'order_email'); ?>
									<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
									<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="40" class="box40" />
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td class="fs12n">
									<?php $this->assign('key', 'order_email_check'); ?>
									<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
									<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="40" class="box40" />
								</td>
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
							<?php $this->assign('key', 'order_sex'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
							<?php if ($this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]): ?>
							<?php $this->assign('err', "background-color: ".(@ERR_COLOR)); ?>
							<?php endif; ?>
							<?php echo smarty_function_html_radios(array('name' => ($this->_tpl_vars['key']),'options' => $this->_tpl_vars['arrSex'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'],'style' => ($this->_tpl_vars['err'])), $this);?>

						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">����</td>
						<?php $this->assign('key', 'order_job'); ?>
						<?php if ($this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]): ?>
						<?php $this->assign('err', "background-color: ".(@ERR_COLOR)); ?>
						<?php endif; ?>
						<td bgcolor="#ffffff">
							<select name="<?php echo $this->_tpl_vars['key']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">							
							<option value="">���򤷤Ʋ�����</option>
							<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrJob'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']), $this);?>

						</td>
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
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['year']['value']), $this); echo $this->_tpl_vars['arrForm']['year']['value']; ?>

									</select>ǯ
									<select name="month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="">--</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['month']['value']), $this);?>

									</select>��
									<select value="" name="day" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="">--</option>\
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['day']['value']), $this);?>

									</select>��</td>
							</tr>
							<tr><td height="2"></td></tr>
						</table>
						</td>
					</tr>
										<tr>
						<td colspan="2" bgcolor="#f0f0f0" class="fs12n">
							<?php $this->assign('key', 'deliv_check'); ?>
							<input type="checkbox" name="<?php echo $this->_tpl_vars['key']; ?>
" value="1" onclick="fnCheckInputDeliv();" <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('sfGetChecked', true, $_tmp, 1) : sfGetChecked($_tmp, 1)); ?>
 id="deliv_label" />
							<label for="deliv_label"><span class="blackst">����������</span>�����嵭�����Ϥ��줿�������Ʊ��ξ��Ͼ�ά��ǽ�Ǥ���</label>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��̾��<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'deliv_name01'); ?>
							<?php $this->assign('key2', 'deliv_name02'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							��&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />��̾&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'deliv_kana01'); ?>
							<?php $this->assign('key2', 'deliv_kana02'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							����&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />���ᥤ&nbsp;<input type="text" name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="15" class="box15" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">͹���ֹ�<span class="red">��</span></td>
						<td bgcolor="#ffffff">
						<table border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td colspan="2">
									<?php $this->assign('key1', 'deliv_zip01'); ?>
									<?php $this->assign('key2', 'deliv_zip02'); ?>
									<span class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']];  echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span></span>
									��
									<input type="text" name="<?php echo $this->_tpl_vars['key1']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" />
									 - 
									<input type="text"  name="<?php echo $this->_tpl_vars['key2']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" />��
									<a href="http://search.post.japanpost.jp/7zip/" target="_blank"><span class="fs10">͹���ֹ渡��</span></a>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td><a href="<?php echo @URL_DIR; ?>
address/index.php" onclick="fnCallAddress('<?php echo @URL_INPUT_ZIP; ?>
', '<?php echo $this->_tpl_vars['key1']; ?>
', '<?php echo $this->_tpl_vars['key2']; ?>
', 'deliv_pref', 'deliv_addr01'); return false;" target="_blank"><img src="<?php echo @URL_DIR; ?>
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
								<td class="fs12n">
									<?php $this->assign('key', 'deliv_pref'); ?>
									<span class="red"><?php echo $this->_tpl_vars['arrErr']['deliv_pref'];  echo $this->_tpl_vars['arrErr']['deliv_addr01'];  echo $this->_tpl_vars['arrErr']['deliv_addr02']; ?>
</span>
									<select name="<?php echo $this->_tpl_vars['key']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">							
									<option value="" selected="">��ƻ�ܸ�������</option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']), $this);?>

									</select>
								</td>
							</tr>
							<tr><td height="7"></td>
							</tr>
							<tr>
								<td>
									<?php $this->assign('key', 'deliv_addr01'); ?>
									<input type="text" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="40" class="box40" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />
								</td>
							</tr>
							<tr>
								<td class="fs10n">�Զ�Į¼̾���㡧�����̶�Ʋ���</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td>
									<?php $this->assign('key', 'deliv_addr02'); ?>
									<input type="text" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="40" class="box40" maxlength=<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" />
								</td>
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
						<td bgcolor="#ffffff" class="fs12n">
							<?php $this->assign('key1', 'deliv_tel01'); ?>
							<?php $this->assign('key2', 'deliv_tel02'); ?>
							<?php $this->assign('key3', 'deliv_tel03'); ?>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']]; ?>
</span>
							<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']]; ?>
</span>
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key1']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key2']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"  size="6" /> - 
							<input type="text" name="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['keyname']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key3']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" />
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
img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_next.gif',this)" src="<?php echo @URL_DIR; ?>
img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
				</td>
			</tr>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</form>
</table>
<!--��CONTENTS-->

