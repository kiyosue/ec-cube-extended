<?php /* Smarty version 2.6.13, created on 2007-01-10 13:54:21
         compiled from /home/web/beta.ec-cube.net/html/user_data/include/bloc/cart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '/home/web/beta.ec-cube.net/html/user_data/include/bloc/cart.tpl', 17, false),array('modifier', 'default', '/home/web/beta.ec-cube.net/html/user_data/include/bloc/cart.tpl', 17, false),)), $this); ?>
<!--���ߤΥ������椳������-->
<table width="166" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/side/title_cartin.jpg" width="166" height="35" alt="���ߤΥ�������"></td>
	</tr>
	<tr>
		<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="10" alt=""></td>
		<td align="center" bgcolor="#ffffff">
		<table width="146" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr><td height="5"></td></tr>
			<tr>
				<td class="fs10">���ʿ���<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrCartList']['0']['TotalQuantity'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
��</td>
			</tr>
			<tr><td height="10"><img src="<?php echo @URL_DIR; ?>
img/side/line_146.gif" width="146" height="1" alt=""></td></tr>
			<tr>
				<td class="fs12"><span class="redst">��ס�<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrCartList']['0']['ProductsTotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
��</span></td>
			</tr>
			<tr><td height="5"></td></tr>
			
			<!-- ��������˾��ʤ�������ˤΤ�ɽ�� -->
			<?php if ($this->_tpl_vars['arrCartList']['0']['TotalQuantity'] > 0): ?>
			<tr>
				<td class="fs10">
				<?php if ($this->_tpl_vars['arrCartList']['0']['deliv_free'] > 0): ?>
					���������̵���ޤǤ���<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrCartList']['0']['deliv_free'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
�ߡ��ǹ��ˤǤ���
				<?php else: ?>
					���ߡ������ϡ�<span class="redst">̵��</span>�פǤ���
				<?php endif; ?>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<?php endif; ?>
			<tr>
				<td align="center"><a href="<?php echo @URL_DIR; ?>
cart/index.php" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/side/button_cartin_on.gif','button_cartin');" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/side/button_cartin.gif','button_cartin');"><img src="<?php echo @URL_DIR; ?>
img/side/button_cartin.gif" width="87" height="22" alt="��������򸫤�" border="0" name="button_cartin"></a></td>
			</tr>
		</table>
		</td>
		<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="10" alt=""></td>
	</tr>
	<tr>
		<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/side/flame_bottom01.gif" width="166" height="15" alt=""></td>
	</tr>
	<tr><td height="10"></td></tr>
</table>
<!--���ߤΥ������椳���ޤ�-->