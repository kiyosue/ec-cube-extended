<?php /* Smarty version 2.6.13, created on 2007-01-10 00:06:11
         compiled from shopping/confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shopping/confirm.tpl', 30, false),array('modifier', 'sfPreTax', 'shopping/confirm.tpl', 62, false),array('modifier', 'number_format', 'shopping/confirm.tpl', 62, false),array('modifier', 'default', 'shopping/confirm.tpl', 78, false),array('modifier', 'nl2br', 'shopping/confirm.tpl', 205, false),)), $this); ?>
<!--��CONTENTS-->
<table width="760" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<!--������³����ή��-->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/flow03.gif" width="700" height="36" alt="������³����ή��"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--������³����ή��-->
		
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/shopping/confirm_title.jpg" width="700" height="40" alt="���������ƤΤ���ǧ"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>
				<td class="fs12">��������ʸ���Ƥ��������Ƥ������Ǥ��礦����<br>
				�������С����ֲ��Ρ�<?php if ($this->_tpl_vars['payment_type'] != ""): ?>����<?php else: ?>����ʸ��λ�ڡ�����<?php endif; ?>�ץܥ���򥯥�å����Ƥ���������</td>
			</tr>
			<tr><td height="20"></td></tr>
			<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="mode" value="confirm">
			<input type="hidden" name="uniqid" value="<?php echo $this->_tpl_vars['tpl_uniqid']; ?>
">
			<tr>
				<td bgcolor="#cccccc">
				<!--����ʸ���Ƥ�������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr align="center" bgcolor="#f0f0f0">
						<td width="85" class="fs12n">���ʼ̿�</td>
						<td width="298" class="fs12n">����̾</td>
						<td width="60" class="fs12n">ñ��</td>
						<td width="40" class="fs12n">�Ŀ�</td>
						<td width="90" class="fs12n">����</td>
					</tr>
					<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['arrProductsClass']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td align="center">
							<a href="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="win01('../products/detail_image.php?product_id=<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['product_id']; ?>
&image=main_image','detail_image','<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['tpl_image_width']; ?>
','<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['tpl_image_height']; ?>
'); return false;" target="_blank">
								<img src="<?php echo @SITE_URL; ?>
resize_image.php?image=<?php echo @IMAGE_SAVE_DIR; ?>
/<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['main_list_image']; ?>
&width=65&height=65" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
							</a>
						</td>
						<td class="fs12">
							<strong><?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['name']; ?>
</strong><br>
							<?php if ($this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['classcategory_name1'] != ""): ?>
								<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['class_name1']; ?>
��<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['classcategory_name1']; ?>
<br>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['classcategory_name2'] != ""): ?>
								<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['class_name2']; ?>
��<?php echo $this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['classcategory_name2']; ?>

							<?php endif; ?>
						</td>
						<td align="right" class="fs12">
							<?php if ($this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['price02'] != ""): ?>
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['price02'])) ? $this->_run_mod_handler('sfPreTax', true, $_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule']) : sfPreTax($_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule'])))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
							<?php else: ?>
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['price01'])) ? $this->_run_mod_handler('sfPreTax', true, $_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule']) : sfPreTax($_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule'])))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��
							<?php endif; ?>
						</td>
						<td align="right" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['quantity'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</td>
						<td align="right" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProductsClass'][$this->_sections['cnt']['index']]['total_pretax'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</td>
					</tr>
					<?php endfor; endif; ?>
					<tr align="right">
						<td colspan="4" bgcolor="#f0f0f0" class="fs12">����</td>
						<td colspan="2" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_total_pretax'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</span><br>
					</tr>
					<tr align="right">
						<td colspan="4" bgcolor="#f0f0f0" class="fs12">�Ͱ����ʥݥ���Ȥ����ѻ���</td>
						<?php $this->assign('discount', ($this->_tpl_vars['arrData']['use_point']*@POINT_VALUE)); ?>
						<td colspan="2" bgcolor="#ffffff" class="fs12">-<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['discount'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
��</td>
					</tr>
					<tr align="right">
						<td colspan="4" bgcolor="#f0f0f0" class="fs12">����</td>
						<td colspan="2" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_fee'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</td>
					</tr>
					<tr align="right">
						<td colspan="4" bgcolor="#f0f0f0" class="fs12">�����</td>
						<td colspan="2" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['charge'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</td>
					</tr>
					<tr align="right">
						<td colspan="4" bgcolor="#f0f0f0" class="fs12">���</td>
						<td colspan="2" bgcolor="#ffffff" class="fs12"><span class="redst"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['payment_total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
��</span></td>
					</tr>
				</table>
				<!--����ʸ���Ƥ����ޤ�-->

								<?php if ($this->_tpl_vars['tpl_login'] == 1 || $this->_tpl_vars['arrData']['member_check'] == 1): ?>
				<table bgcolor="#ffffff" width=100%><tr><td height="15"></td></tr></table>
				
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr class="fs12" align="right">
						<td bgcolor="#f0f0f0" width="610">����ʸ���Υݥ����</td>
						<td bgcolor="#ffffff" width="90"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_user_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</td>
					</tr>
					<tr class="fs12" align="right">
						<td bgcolor="#f0f0f0" width="610">�����ѥݥ����</td>
						<td bgcolor="#ffffff" width="90">-<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['use_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</td>
					</tr>
					<?php if ($this->_tpl_vars['arrData']['birth_point'] > 0): ?>
					<tr class="fs12" align="right">
						<td bgcolor="#f0f0f0" width="610">��������ݥ����</td>
						<td bgcolor="#ffffff" width="90">+<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['birth_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</td>
					</tr>
					<?php endif; ?>
					<tr class="fs12" align="right">
						<td bgcolor="#f0f0f0" width="610">����û������ݥ����</td>
						<td bgcolor="#ffffff" width="90">+<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['add_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</td>
					</tr>
					<tr class="fs12st" align="right">
						<?php $this->assign('total_point', ($this->_tpl_vars['tpl_user_point']-$this->_tpl_vars['arrData']['use_point']+$this->_tpl_vars['arrData']['add_point'])); ?>
						<td bgcolor="#f0f0f0" width="610">����ʸ��λ��Υݥ����</td>
						<td bgcolor="#ffffff" width="90"><?php echo ((is_array($_tmp=$this->_tpl_vars['total_point'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
Pt</td>
					</tr>
				</table>
				<?php endif; ?>
								</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc">
				<!--���Ϥ��褳������-->
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td colspan="2" bgcolor="#f0f0f0" class="fs12n"><strong>�����Ϥ���</strong></td>
					</tr>
					<?php if ($this->_tpl_vars['arrData']['deliv_check'] == 1): ?>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">��̾��</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">��̾���ʥեꥬ�ʡ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">͹���ֹ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12">��<?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">����</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo $this->_tpl_vars['arrPref'][$this->_tpl_vars['arrData']['deliv_pref']];  echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_addr01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  echo ((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_addr02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">�����ֹ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo $this->_tpl_vars['arrData']['deliv_tel01']; ?>
-<?php echo $this->_tpl_vars['arrData']['deliv_tel02']; ?>
-<?php echo $this->_tpl_vars['arrData']['deliv_tel03']; ?>
</td>
						</tr>
					<?php else: ?>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">��̾��</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">��̾���ʥեꥬ�ʡ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">͹���ֹ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12">��<?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_zip01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_zip02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">����</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo $this->_tpl_vars['arrPref'][$this->_tpl_vars['arrData']['order_pref']];  echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_addr01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp));  echo ((is_array($_tmp=$this->_tpl_vars['arrData']['order_addr02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
						</tr>
						<tr>
							<td width="150" bgcolor="#f0f0f0" class="fs12">�����ֹ�</td>
							<td width="507" bgcolor="#ffffff" class="fs12"><?php echo $this->_tpl_vars['arrData']['order_tel01']; ?>
-<?php echo $this->_tpl_vars['arrData']['order_tel02']; ?>
-<?php echo $this->_tpl_vars['arrData']['order_tel03']; ?>
</td>
						</tr>
					<?php endif; ?>
				</table>
				<!--���Ϥ��褳���ޤ�-->
				</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td bgcolor="#cccccc">
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌��������-->		
				<table width="700" border="0" cellspacing="1" cellpadding="10" summary=" ">
					<tr>
						<td colspan="2" bgcolor="#f0f0f0" class="fs12n"><strong>������ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌</strong></td>
					</tr>
					<tr>
						<td width="150" bgcolor="#f0f0f0" class="fs12">����ʧ��ˡ</td>
						<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrData']['payment_method'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
					</tr>
					<tr>
						<td width="150" bgcolor="#f0f0f0" class="fs12">���Ϥ���</td>
						<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_date'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "����ʤ�") : smarty_modifier_default($_tmp, "����ʤ�")); ?>
</td>
					</tr>
					<tr>
						<td width="150" bgcolor="#f0f0f0" class="fs12">���Ϥ�����</td>
						<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['deliv_time'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, "����ʤ�") : smarty_modifier_default($_tmp, "����ʤ�")); ?>
</td>
					</tr>
					<tr>
						<td width="150" bgcolor="#f0f0f0" class="fs12">����¾���䤤��碌</td>
						<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrData']['message'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
					</tr>
					
					<?php if ($this->_tpl_vars['tpl_login'] == 1): ?>
					<tr>
						<td width="150" bgcolor="#f0f0f0" class="fs12">�ݥ���Ȼ���</td>
						<td width="507" bgcolor="#ffffff" class="fs12"><?php echo ((is_array($_tmp=@$this->_tpl_vars['arrData']['use_point'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
Pt</td>
					</tr>
					<?php endif; ?>
					
				</table>
				<!--����ʧ��ˡ�����Ϥ����֤λ��ꡦ����¾���䤤��碌�����ޤ�-->
				</td>
			</tr>
			<tr><td height="20"></td></tr>

			<tr>
				<td align="center">
					<a href="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_back_on.gif',back03)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_back.gif',back03)" onclick="fnModeSubmit('return', '', ''); return false;"><img src="<?php echo @URL_DIR; ?>
img/common/b_back.gif" width="150" height="30" alt="���" border="0" name="back03" id="back03"/></a>
					<img src="<?php echo @URL_DIR; ?>
img/_.gif" width="20" height="" alt="" />
					<?php if ($this->_tpl_vars['payment_type'] != ""): ?>
						<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_next_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/common/b_next.gif',this)" src="<?php echo @URL_DIR; ?>
img/common/b_next.gif" width="150" height="30" alt="����" border="0" name="next" id="next" />
					<?php else: ?>
						<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/shopping/b_ordercomp_on.gif',this)" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/shopping/b_ordercomp.gif',this)" src="<?php echo @URL_DIR; ?>
img/shopping/b_ordercomp.gif" width="150" height="30" alt="����ʸ��λ�ڡ�����" border="0" name="next" id="next" />
					<?php endif; ?>
				</td>
			</tr>
			</form>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->
