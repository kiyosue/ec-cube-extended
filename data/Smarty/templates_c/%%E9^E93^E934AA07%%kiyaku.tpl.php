<?php /* Smarty version 2.6.13, created on 2007-01-10 00:17:19
         compiled from entry/kiyaku.tpl */ ?>
		<!--��MAIN ONTENTS-->
		<table width="580" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<form name="form1" method="post" action="./payment.php">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/entry/agree_title.jpg" width="580" height="40" alt="�����ѵ���"></td>
			</tr>
			<tr><td height="15"></td></tr>
			<tr>

				<td class="fs12"><span class="redst">�ڽ��ס� �����Ͽ�򤵤�����ˡ����������ѵ����褯���ɤߤ���������</span><br>
				����ˤϡ��ܥ����ӥ�����Ѥ���������äƤΤ��ʤ��θ����ȵ�̳�����ꤵ��Ƥ���ޤ���<br>
				�ֵ����Ʊ�դ��Ʋ����Ͽ�򤹤�ץܥ��� �򥯥�å�����ȡ����ʤ����ܵ�������Ƥξ���Ʊ�դ������Ȥˤʤ�ޤ���</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td>
				<textarea name="textfield" cols="80" rows="30" class="area80_2" readonly><?php echo $this->_tpl_vars['tpl_kiyaku_text']; ?>
</textarea>
				</td>
			</tr>
			<tr><td height="25"></td></tr>
			<tr align="center">
				<td>
				<?php if ($this->_tpl_vars['is_campaign']): ?>
				<a href="javascript:history.back();" onmouseover="chgImg('../img/entry/b_noagree_on.gif','b_noagree');" onmouseout="chgImg('../img/entry/b_noagree.gif','b_noagree');"><img src="<?php echo @URL_DIR; ?>
img/entry/b_noagree.gif" width="180" height="30" alt="Ʊ�դ��ʤ�" border="0" name="b_noagree"></a>�� 
				<?php else: ?>
				<a href="<?php echo @URL_DIR; ?>
index.php" onmouseover="chgImg('../img/entry/b_noagree_on.gif','b_noagree');" onmouseout="chgImg('../img/entry/b_noagree.gif','b_noagree');"><img src="<?php echo @URL_DIR; ?>
img/entry/b_noagree.gif" width="180" height="30" alt="Ʊ�դ��ʤ�" border="0" name="b_noagree"></a>�� 
				<?php endif; ?>
                <a href="<?php echo @URL_ENTRY_TOP; ?>
" onmouseover="chgImg('../img/entry/b_agree_on.gif','b_agree');" onmouseout="chgImg('../img/entry/b_agree.gif','b_agree');"><img src="<?php echo @URL_DIR; ?>
img/entry/b_agree.gif" width="180" height="30" alt="�����Ʊ�դ��Ʋ����Ͽ" border="0" name="b_agree"></a>
                </td>
			</tr>
		</form>
		</table>

		<!--��MAIN ONTENTS-->