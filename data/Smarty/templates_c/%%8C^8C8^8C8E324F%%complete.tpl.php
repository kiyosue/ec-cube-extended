<?php /* Smarty version 2.6.13, created on 2007-01-10 00:18:33
         compiled from entry/complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'entry/complete.tpl', 42, false),)), $this); ?>
<!--��CONTENTS-->
<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr valign="top">
		<td align="right" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/entry/title.jpg" width="580" height="40" alt="�����Ͽ"></td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr>
				<td align="center">
				<table width="520" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr>
						<td align="center" bgcolor="#cccccc">
						<table width="510" border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr><td height="5"></td></tr>
							<tr>
								<td align="center" bgcolor="#ffffff">
								<!--��Ͽ��λ��ʸ�Ϥ�������-->
								<table width="470" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr><td height="25"></td></tr>
									<tr>
										<td class="fs14"><span class="redst">�����Ͽ�μ��դ���λ�������ޤ�����</span></td>
									</tr>
									<tr><td height="20"></td></tr>
									<tr>
										<td class="fs12">����<span class="redst">�����</span>�ξ��֤Ǥ���<br>
										�����Ϥ����������᡼�륢�ɥ쥹���Ƥˡ���Ϣ���Ϥ��Ƥ���ޤ��Τǡ��ܲ����Ͽ�ˤʤä���Ǥ��㤤ʪ�򤪳ڤ��ߤ���������</td>
									</tr>
									<tr><td height="15"></td></tr>
									<tr>
										<td class="fs12">����Ȥ⤴���ܻ��ޤ��褦��������ꤤ�����夲�ޤ���</td>
									</tr>
									<tr><td height="20"></td></tr>
									<tr>
										<td class="fs12"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['company_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br>
									TEL��<?php echo $this->_tpl_vars['arrSiteInfo']['tel01']; ?>
-<?php echo $this->_tpl_vars['arrSiteInfo']['tel02']; ?>
-<?php echo $this->_tpl_vars['arrSiteInfo']['tel03']; ?>
 <?php if ($this->_tpl_vars['arrSiteInfo']['business_hour'] != ""): ?>�ʼ��ջ���/<?php echo $this->_tpl_vars['arrSiteInfo']['business_hour']; ?>
��<?php endif; ?><br>
									E-mail��<a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['email02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['email02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></td>
									</tr>
									<tr><td height="20"></td></tr>
									<tr align="center">
										<td>
										<?php if ($this->_tpl_vars['is_campaign']): ?>
										<a href="<?php echo @URL_SHOP_TOP; ?>
" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/common/b_toppage_on.gif','b_toppage');" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/common/b_toppage.gif','b_toppage');"><img src="<?php echo @URL_DIR; ?>
img/common/b_toppage.gif" width="150" height="30" alt="�ȥåץڡ�����" border="0" name="b_toppage"></a>
										<?php else: ?>
										<a href="<?php echo @URL_DIR; ?>
index.php" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/common/b_toppage_on.gif','b_toppage');" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/common/b_toppage.gif','b_toppage');"><img src="<?php echo @URL_DIR; ?>
img/common/b_toppage.gif" width="150" height="30" alt="�ȥåץڡ�����" border="0" name="b_toppage"></a>
										<?php endif; ?>										
										</td>
									</tr>
									<tr><td height="25"></td></tr>
								</table>
								<!--��Ͽ��λ��ʸ�Ϥ����ޤ�-->
								</td>
							</tr>
							<tr><td height="5"></td></tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		<!--��MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--��CONTENTS-->