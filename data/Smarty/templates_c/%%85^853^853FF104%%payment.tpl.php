<?php /* Smarty version 2.6.13, created on 2007-01-10 00:05:56
         compiled from shopping/payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shopping/payment.tpl', 35, false),array('modifier', 'sfGetErrorColor', 'shopping/payment.tpl', 52, false),array('modifier', 'sfGetChecked', 'shopping/payment.tpl', 52, false),array('modifier', 'default', 'shopping/payment.tpl', 137, false),array('modifier', 'number_format', 'shopping/payment.tpl', 140, false),array('function', 'html_options', 'shopping/payment.tpl', 85, false),)), $this); ?>
<!--��CONTENTS-->
<table width="760" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<!--������³����ή��-->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/flow02.gif" width="700" height="36" alt="������³����ή��"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��-->

		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/payment_title.jpg" width="700" height="40" alt="����ʧ����ˡ�����Ϥ��������λ���"></td>
			</tr>
			<tr><td height="25"></td></tr>
		</table>
		<table width="670" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/subtitle01.gif" width="670" height="33" alt="����ʧ��ˡ�λ���"></td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12n">����ʧ��ˡ�����򤯤�������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="mode" value="confirm">
			<input type="hidden" name="uniqid" value="<?php echo $this->_tpl_vars['tpl_uniqid']; ?>
">
			<tr><td class="fs12">
				<?php $this->assign('key', 'payment_id'); ?>
				<?php if ($this->_tpl_vars['arrErr'][$this->_tpl_vars['key']] != ""): ?><span class="redst"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span><?php endif; ?>
			</td></tr>
			<tr>
				<td bgcolor="#cccccc">
				<!--����ʧ����ˡ��������-->
				<table width="670" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr bgcolor="#f0f0f0">
						<td width="37" align="center" class="fs12n">����</td>
						<td width="590" align="center" class="fs12n" colspan="2">����ʧ��ˡ</td>
					</tr>
					<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['arrPayment']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cnt']['show'] = true;
$this->_sections['cnt']['max'] = $this->_sections['cnt']['loop'];
$this->_sections['cnt']['step'] = 1;
$this->_sections['cnt']['start'] = $this->_sections['cnt']['step'] > 0 ? 0 : $this->_sections['cnt']['loop']-1;
if ($this->_sections['cnt']['show']) {
    $this->_sections['cnt']['total'] = $this->_sections['cnt']['loop'];
    if ($this->_sections['cnt']['total'] == 0)
        $this->_sections['cnt']['show'] = false;
} else
    $this->_sections['cnt']['total'] = 0;
if ($this->_sections['cnt']['show']):

            for ($this->_sections['cnt']['index'] = $this->_sections['cnt']['start'], $this->_sections['cnt']['iteration'] = 1;
                 $this->_sections['cnt']['iteration'] <= $this->_sections['cnt']['total'];
                 $this->_sections['cnt']['index'] += $this->_sections['cnt']['step'], $this->_sections['cnt']['iteration']++):
$this->_sections['cnt']['rownum'] = $this->_sections['cnt']['iteration'];
$this->_sections['cnt']['index_prev'] = $this->_sections['cnt']['index'] - $this->_sections['cnt']['step'];
$this->_sections['cnt']['index_next'] = $this->_sections['cnt']['index'] + $this->_sections['cnt']['step'];
$this->_sections['cnt']['first']      = ($this->_sections['cnt']['iteration'] == 1);
$this->_sections['cnt']['last']       = ($this->_sections['cnt']['iteration'] == $this->_sections['cnt']['total']);
?>
					<tr bgcolor="#ffffff">
						<td halign="center" align="center"><input type="radio" id="pay_<?php echo $this->_sections['cnt']['iteration']; ?>
" name="<?php echo $this->_tpl_vars['key']; ?>
" onclick="fnModeSubmit('payment', '', '');" value="<?php echo $this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['payment_id']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" <?php echo ((is_array($_tmp=$this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['payment_id'])) ? $this->_run_mod_handler('sfGetChecked', true, $_tmp, $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']) : sfGetChecked($_tmp, $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])); ?>
 /></td>
						<td class="fs12n" width="90"><label for="pay_<?php echo $this->_sections['cnt']['iteration']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['payment_method'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  if ($this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['note'] != ""):  endif; ?></td></label>
						<td width="500">
						<?php if ($this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['payment_image'] != ""): ?>
						<img src="<?php echo @IMAGE_SAVE_URL;  echo $this->_tpl_vars['arrPayment'][$this->_sections['cnt']['index']]['payment_image']; ?>
">
						<?php endif; ?>
						</td>
					</tr>
					<?php endfor; endif; ?>	
				</table>
				<!--����ʧ����ˡ�����ޤ�-->
				</td>
			</tr>
			<tr><td height="40"></td></tr>
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/subtitle02.gif" width="670" height="33" alt="���Ϥ����֤λ���"></td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12n">����˾�����ϡ����Ϥ����֤����򤷤Ƥ���������</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12n">
				<!--����ã�������-->
					<?php $this->assign('key', 'deliv_date'); ?>
					<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
					<strong>���Ϥ������ꡧ</strong>&nbsp;
					<?php if (! $this->_tpl_vars['arrDelivDate']): ?>
						������ĺ���ޤ���
					<?php else: ?>
						<select name="<?php echo $this->_tpl_vars['key']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">	
						<option value="" selected="">����ʤ�</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDelivDate'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']), $this);?>

						</select>
					<?php endif; ?>
					&nbsp;&nbsp;&nbsp;
					<?php $this->assign('key', 'deliv_time_id'); ?>
					<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
					<strong>���Ϥ����ֻ��ꡧ</strong>&nbsp;<select name="<?php echo $this->_tpl_vars['key']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">	
					<option value="" selected="">����ʤ�</option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDelivTime'],'selected' => $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value']), $this);?>

					</select>
				</td>
			</tr>
		
			<tr><td height="40"></td></tr>
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/subtitle03.gif" width="670" height="33" alt="����¾���䤤��碌"></td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12n">����¾���䤤��碌���ब�������ޤ����顢������ˤ����Ϥ���������</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12"><!--������¾���䤤��碌�����-->
					<?php $this->assign('key', 'message'); ?>
					<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
					<textarea name="<?php echo $this->_tpl_vars['key']; ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" cols="80" rows="8" class="area80" wrap="head"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
					<span class="red"> ��<?php echo @LTEXT_LEN; ?>
ʸ���ޤǡ�</span>
				</td>
			</tr>
			<tr><td height="20"></td></tr>
			
			<!-- ���ݥ���Ȼ��� �������� -->
			<?php if ($this->_tpl_vars['tpl_login'] == 1): ?>
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/subtitle_point.jpg" width="670" height="32" alt="�ݥ���Ȼ��Ѥλ���" /></td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td class="fs12">
					<span class="redst">1�ݥ���Ȥ�1��</span>�Ȥ��ƻ��Ѥ�������Ǥ��ޤ���<br />
					���Ѥ�����ϡ��֥ݥ���Ȥ���Ѥ���פ˥����å������줿�塢���Ѥ���ݥ���Ȥ򤴵�������������
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr><td>
				
				<table width="670" cellspacing="3" cellpadding="5" summary=" " bgcolor="#d0d0d0">
					<tr>
						<td bgcolor="#ffffff" align="center">
						<table cellspacing="0" cellpadding="0" summary=" ">
							<tr>
								<td class="fs12" colspan="2"><?php echo ((is_array($_tmp=$this->_tpl_vars['objCustomer']->getValue('name01'))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['objCustomer']->getValue('name02'))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
�ͤΡ����ߤν���ݥ���Ȥϡ�<span class="redst"><?php echo ((is_array($_tmp=@$this->_tpl_vars['tpl_user_point'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</span>�פǤ���</td>
							</tr>
							<tr>
								<td class="fs12">���󤴹�����׶�ۡ�<span class="redst"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['subtotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</span><span class="red">���������������ޤߤޤ��󡣡�</span></td>
							</tr>
						</table>
						<table cellspacing="0" cellpadding="10" summary=" " id="point03">
							<tr>
								<td>
								<table cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td class="fs12"><input type="radio" id="point_on" name="point_check" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['point_check']['value'])) ? $this->_run_mod_handler('sfGetChecked', true, $_tmp, 1) : sfGetChecked($_tmp, 1)); ?>
 onclick="fnCheckInputPoint();" /><label for="point_on">�ݥ���Ȥ���Ѥ���</label></td>
									</tr>
									<tr><td height="2"></td></tr>
									<tr>
										<td class="fs12"><span class="indent18">
										<?php $this->assign('key', 'use_point'); ?>
										<span class="red"><?php echo $this->_tpl_vars['arrErr'][$this->_tpl_vars['key']]; ?>
</span>
										����Τ��㤤ʪ�ǡ�<input type="text" name="<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['value'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['tpl_user_point']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['tpl_user_point'])); ?>
" maxlength="<?php echo $this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length']; ?>
" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" size="6" class="box6" />&nbsp;�ݥ���Ȥ���Ѥ��롣</span></td>
									</tr>
									<tr>
										<td height="12"><img src="<?php echo @URL_DIR; ?>
img/shopping/line02.gif" width="514" height="1" alt="" /></td>
									</tr>
									<tr>
										<td class="fs12"><input type="radio" id="point_off" name="point_check" value="2" <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['point_check']['value'])) ? $this->_run_mod_handler('sfGetChecked', true, $_tmp, 2) : sfGetChecked($_tmp, 2)); ?>
 onclick="fnCheckInputPoint();" /><label for="point_off">�ݥ���Ȥ���Ѥ��ʤ�</label></td>
									</tr>
								</table>
								</td>
							</tr>

						</table>
						</td>
					</tr>
				</table>
				<?php endif; ?>
				</td>
			</tr>
			<tr><td height="20"></td></tr>
			<!-- ���ݥ���Ȼ��� �����ޤ� -->			
			
			<tr>
				<td align="center">
					<a href="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/common/b_back_on.gif','back03')" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/common/b_back.gif','back03')" onclick="history.back(); return false;" /><img src="<?php echo @URL_DIR; ?>
img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03" ></a><img src="<?php echo @URL_DIR; ?>
img/_.gif" width="20" height="" alt="" />
					<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_next.gif',this)" src="<?php echo @URL_DIR; ?>
img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
				</td>
			</tr>
			</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->
	
	