<?php /* Smarty version 2.6.13, created on 2007-01-10 00:02:46
         compiled from entry/confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'entry/confirm.tpl', 12, false),array('modifier', 'default', 'entry/confirm.tpl', 64, false),)), $this); ?>
<!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr valign="top">
		<td align="right" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="580" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
				<input type="hidden" name="mode" value="complete">
			<?php $_from = $this->_tpl_vars['list_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<?php endforeach; endif; unset($_from); ?>
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/entry/title.jpg" width="580" height="40" alt="�����Ͽ"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">���������Ƥ��������Ƥ������Ǥ��礦����<br>
				�������С����ֲ��Ρֲ����Ͽ��λ�ءץܥ���򥯥�å����Ƥ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc" align="center">
				<!--���ϥե����ळ������-->
				<table width="580" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td width="135" bgcolor="#f0f0f0" class="fs12">��̾��<span class="red">��</span></td>
						<td width="402" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
��<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">��̾���ʥեꥬ�ʡ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
��<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">͹���ֹ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12">��<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">����<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrPref'][$this->_tpl_vars['list_data']['pref']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  echo ((is_array($_tmp=$this->_tpl_vars['list_data']['addr01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  echo ((is_array($_tmp=$this->_tpl_vars['list_data']['addr02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">�����ֹ�<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['tel01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['tel02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['tel03'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">FAX</td>
						<td bgcolor="#ffffff" class="fs12"><?php if (strlen ( $this->_tpl_vars['list_data']['fax01'] ) > 0 && strlen ( $this->_tpl_vars['list_data']['fax02'] ) > 0 && strlen ( $this->_tpl_vars['list_data']['fax03'] ) > 0):  echo ((is_array($_tmp=$this->_tpl_vars['list_data']['fax01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['fax02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['fax03'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  else: ?>̤��Ͽ<?php endif; ?></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">�᡼�륢�ɥ쥹<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n"><a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">����<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12n"><?php if ($this->_tpl_vars['list_data']['sex'] == 1): ?>����<?php else: ?>����<?php endif; ?></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0"  class="fs12n">����</td>
						<td bgcolor="#ffffff" class="fs12n"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrJob'][$this->_tpl_vars['list_data']['job']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "̤��Ͽ") : smarty_modifier_default($_tmp, "̤��Ͽ")); ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12n">��ǯ����</td>
						<td bgcolor="#ffffff" class="fs12n"><?php if (strlen ( $this->_tpl_vars['list_data']['year'] ) > 0 && strlen ( $this->_tpl_vars['list_data']['month'] ) > 0 && strlen ( $this->_tpl_vars['list_data']['day'] ) > 0):  echo ((is_array($_tmp=$this->_tpl_vars['list_data']['year'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
ǯ<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['month'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
��<?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['day'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
��<?php else: ?>̤��Ͽ<?php endif; ?></td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" ><span class="fs12">��˾����ѥ����<span class="red">��</span></span><br>
						<span class="fs10">�ѥ���ɤϹ�������ɬ�פǤ�</span></td>
						<td bgcolor="#ffffff" class="fs12"><?php echo $this->_tpl_vars['passlen']; ?>
</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">�ѥ���ɤ�˺�줿���Υҥ��<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12">
						<table cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12n">���䡧</td>
								<td class="fs12n"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrReminder'][$this->_tpl_vars['list_data']['reminder']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
							</tr>
							<tr>
								<td class="fs12n">������</td>
								<td class="fs12n"><?php echo ((is_array($_tmp=$this->_tpl_vars['list_data']['reminder_answer'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f0f0f0" class="fs12">�᡼��ޥ��������դˤĤ���<span class="red">��</span></td>
						<td bgcolor="#ffffff" class="fs12"><?php if ($this->_tpl_vars['list_data']['mail_flag'] == 1): ?>HTML�᡼��ܥƥ����ȥ᡼���������<?php elseif ($this->_tpl_vars['list_data']['mail_flag'] == 2): ?>�ƥ����ȥ᡼���������<?php else: ?>�������ʤ�<?php endif; ?></td>
					</tr>
				</table>
				<!--���ϥե����ळ���ޤ�-->
				</td>
			</tr>
			<tr><td height="25"></td></tr>
			<tr align="center">
				<td>
					<a href="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="fnModeSubmit('return', '', ''); return false;" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/common/b_back_on.gif','back')" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/common/b_back.gif','back')"><img src="<?php echo @URL_DIR; ?>
img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back" id="back" /></a>
					<img src="<?php echo @URL_DIR; ?>
img/_.gif" width="20" height="" alt="" />
					<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/entry/b_entrycomp_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/entry/b_entrycomp.gif',this)" src="<?php echo @URL_DIR; ?>
img/entry/b_entrycomp.gif" width="150" height="30" alt="����" border="0" name="send" id="send" />
				</td>
			</tr>
		</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->