<?php /* Smarty version 2.6.13, created on 2007-01-10 18:48:02
         compiled from /home/web/beta.ec-cube.net/html/user_data/templates/mypage/refusal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/web/beta.ec-cube.net/html/user_data/templates/mypage/refusal.tpl', 8, false),)), $this); ?>
<!--��CONTENTS-->
<table width="100" border="0" cellspacing="0" cellpadding="0" summary=" ">
<form name="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="hidden" name="mode" value="confirm">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--��MAIN ONTENTS-->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/mypage/title.jpg" width="700" height="40" alt="MY�ڡ���"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr valign="top">
				<td>
				<!--��NAVI-->
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tpl_navi'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<!--��NAVI-->
				</td>
				<td align="right">
				<table width="515" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr>
						<td><!--�������ȥ�--><img src="<?php echo @URL_DIR; ?>
img/mypage/subtitle04.gif" width="515" height="32" alt="����³��"></td>
					</tr>
					<tr><td height="15"></td></tr>
					<tr>
						<td align="center" bgcolor="#cccccc">
						<table width="505" border="0" cellspacing="0" cellpadding="0" summary=" ">
							<tr><td height="5"></td></tr>
							<tr>
								<td align="center" bgcolor="#ffffff">
								<!--ɽ����������-->
								<table width="465" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr><td height="30"></td></tr>
									<tr>
										<td class="fs12">
										�������񤵤줿���ˤϡ�������¸����Ƥ����������䡢���Ϥ���ʤɤξ���ϡ����٤ƺ������ޤ���������Ǥ��礦����</td>
									</tr>
									<tr><td height="30"></td></tr>
									<tr>
										<td align="center">
											<input type="image" onmouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/mypage/b_refuse_on.gif',this);" onmouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/mypage/b_refuse.gif',this);" src="<?php echo @URL_DIR; ?>
img/mypage/b_refuse.gif" width="180" height="30" alt="�������Ԥ�" name="refusal" id="refusal" />
										</td>
									</tr>
									<tr><td height="10"></td></tr>
									<tr>
										<td class="fs10"><span class="red">������³������λ���������ǡ�������¸����Ƥ����������䡢���Ϥ������ξ���Ϥ��٤Ƥʤ��ʤ�ޤ��ΤǤ���դ���������</span></td>
									</tr>
									<tr><td height="30"></td></tr>
								</table>
								<!--ɽ�������ޤ�-->
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
</form>
</table>
<!--��CONTENTS-->
