<?php /* Smarty version 2.6.13, created on 2007-01-10 00:00:18
         compiled from contents/campaign.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'contents/campaign.tpl', 22, false),array('function', 'html_options', 'contents/campaign.tpl', 80, false),)), $this); ?>

<script type="text/javascript">
<!--
// �����Ȥ˾��ʤ������˥����å������äƤ��뤫�����å�
function fnIsCartOn(){
    if (document.form1.cart_flg.checked){
		document.form1.deliv_free_flg.disabled = false;
    } else {
		document.form1.deliv_free_flg.disabled = true;    
    }
}
//-->
</script>
<!--�����ᥤ�󥳥�ƥ�ġ���-->
<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="hidden" name="mode" value="">
<input type="hidden" name="campaign_id" value="<?php echo $this->_tpl_vars['campaign_id']; ?>
" >
<table width="878" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr valign="top">
		<td background="<?php echo @URL_DIR; ?>
img/contents/navi_bg.gif" height="402">
			<!--��SUB NAVI-->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tpl_subnavi'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<!--��SUB NAVI-->
		</td>
		<td class="mainbg">
			<!--����Ͽ�ơ��֥뤳������-->
			<table width="737" border="0" cellspacing="0" cellpadding="0" summary=" ">
				<!--�ᥤ�󥨥ꥢ-->
				<tr>
					<td align="center">
						<table width="706" border="0" cellspacing="0" cellpadding="0" summary=" ">
						
							<tr><td height="14"></td></tr>
							<tr>
								<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/main_top.jpg" width="706" height="14" alt=""></td>
							</tr>
							<tr>
								<td background="<?php echo @URL_DIR; ?>
img/contents/main_left.jpg"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="14" height="1" alt=""></td>
								<td bgcolor="#cccccc">
								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_top.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td background="<?php echo @URL_DIR; ?>
img/contents/contents_title_left_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_left.gif" width="22" height="12" alt=""></td>
										<td bgcolor="#636469" width="638" class="fs14n"><span class="white"><!--����ƥ�ĥ����ȥ�-->�����ڡ���ڡ�����Ͽ</span></td>
										<td background="<?php echo @URL_DIR; ?>
img/contents/contents_title_right_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="18" height="1" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_bottom.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/main_bar.jpg" width="678" height="10" alt=""></td>
									</tr>
								</table>

								<!--����Ͽ�ơ��֥뤳������-->
								<table width="678" border="0" cellspacing="1" cellpadding="8" summary=" ">	
									<thead>
									<tr>
										<td bgcolor="#f2f1ec" width="140" class="fs12n">�����ڡ���̾<span class="red"> *</span></td>
										<td bgcolor="#ffffff" width="538" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['campaign_name']; ?>
</span><input type="text" name="campaign_name" size="60" class="box60"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['campaign_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrErr']['campaign_name']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?> maxlength="<?php echo @STEXT_LEN; ?>
"/></span>
									</tr>
									</thead>
									<tfoot>
									<tr class="fs12n">
										<td bgcolor="#f2f1ec" width="140">�����ڡ������<span class="red"> *</span></td>
										<td bgcolor="#ffffff" width="538">
											<span class="red"><?php echo $this->_tpl_vars['arrErr']['start_year'];  echo $this->_tpl_vars['arrErr']['start_month'];  echo $this->_tpl_vars['arrErr']['start_day']; ?>
</span>
											����������
											<select name="start_year" <?php if ($this->_tpl_vars['arrErr']['start_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>----</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['start_year']), $this);?>

											</select>ǯ
											<select name="start_month" <?php if ($this->_tpl_vars['arrErr']['start_month'] || $this->_tpl_vars['arrErr']['start_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['start_month']), $this);?>

											</select>��
											<select name="start_day" <?php if ($this->_tpl_vars['arrErr']['start_day'] || $this->_tpl_vars['arrErr']['start_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['start_day']), $this);?>

											</select>��
											<select name="start_hour" <?php if ($this->_tpl_vars['arrErr']['start_hour'] || $this->_tpl_vars['arrErr']['start_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrHour'],'selected' => $this->_tpl_vars['arrForm']['start_hour']), $this);?>

											</select>��
											<select name="start_minute" <?php if ($this->_tpl_vars['arrErr']['start_minute'] || $this->_tpl_vars['arrErr']['start_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMinutes'],'selected' => $this->_tpl_vars['arrForm']['start_minute']), $this);?>

											</select>ʬ<br/><br/><br/>
											<span class="red"><?php echo $this->_tpl_vars['arrErr']['end_year'];  echo $this->_tpl_vars['arrErr']['end_month'];  echo $this->_tpl_vars['arrErr']['end_day']; ?>
</span>	
											���������
											<select name="end_year" <?php if ($this->_tpl_vars['arrErr']['end_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>----</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['end_year']), $this);?>

											</select>ǯ
											<select name="end_month" <?php if ($this->_tpl_vars['arrErr']['end_month'] || $this->_tpl_vars['arrErr']['end_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['end_month']), $this);?>

											</select>��
											<select name="end_day" <?php if ($this->_tpl_vars['arrErr']['end_day'] || $this->_tpl_vars['arrErr']['end_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['end_day']), $this);?>

											</select>��
											<select name="end_hour" <?php if ($this->_tpl_vars['arrErr']['end_hour'] || $this->_tpl_vars['arrErr']['end_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrHour'],'selected' => $this->_tpl_vars['arrForm']['end_hour']), $this);?>

											</select>��
											<select name="end_minute" <?php if ($this->_tpl_vars['arrErr']['end_minute'] || $this->_tpl_vars['arrErr']['end_year']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?>>
												<option value="" selected>--</option>
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMinutes'],'selected' => $this->_tpl_vars['arrForm']['end_minute']), $this);?>

											</select>ʬ<br/><br/><br/>
										</td>
									</tr>									
									<tr>
										<td bgcolor="#f2f1ec" width="140" class="fs12n">�ǥ��쥯�ȥ�̾<span class="red"> *</span></td>
										<td bgcolor="#ffffff" width="538" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['directory_name']; ?>
</span><input type="text" name="directory_name" size="60" class="box60"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['directory_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrErr']['directory_name']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?> maxlength="<?php echo @STEXT_LEN; ?>
"/></span>
										</td>
									</tr>
									<tr>
										<td bgcolor="#f2f1ec" width="140" class="fs12n">����������</td>
										<td bgcolor="#ffffff" width="538" class="fs12n"><span class="red"><?php echo $this->_tpl_vars['arrErr']['limit_count']; ?>
</span><input type="text" name="limit_count" size="54" class="box6"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['limit_count'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['arrErr']['limit_count']): ?>style="background-color:<?php echo ((is_array($_tmp=@ERR_COLOR)) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php endif; ?> maxlength="<?php echo @STEXT_LEN; ?>
"/>&nbsp;��ǽ�λ�ڡ������ڤ��ؤ�
										</td>
									</tr>								
									<tr class="fs12n">
										<td bgcolor="#f2f1ec" width="140">��ʣ��������</td>
										<td bgcolor="#ffffff" width="538"><input type="checkbox" name="orverlapping_flg" id="orverlapping_flg" value="1" <?php if ($this->_tpl_vars['arrForm']['orverlapping_flg'] == 1): ?> checked <?php endif; ?> ><label for="orverlapping_flg">��ʣ���������椹��</label></td>
									</tr>
									<tr class="fs12n">
										<td bgcolor="#f2f1ec" width="140">�����Ȥ˾��ʤ������</td>
										<td bgcolor="#ffffff" width="538"><input type="checkbox" onclick="fnIsCartOn()" name="cart_flg" id="cart_flg" value="1" <?php if ($this->_tpl_vars['arrForm']['cart_flg'] == 1): ?> checked <?php endif; ?> ><label for="cart_flg">�����Ȥ˾��ʤ������褦�ˤ���</label></td>
									</tr>
									<tr class="fs12n">
										<td bgcolor="#f2f1ec" width="140">����̵������</td>
										<td bgcolor="#ffffff" width="538"><input type="checkbox" name="deliv_free_flg" id="deliv_free_flg" value="1" <?php if ($this->_tpl_vars['arrForm']['deliv_free_flg'] == 1): ?> checked <?php endif; ?> ><label for="deliv_free_flg">����̵��</label></td>
									</tr>
									</tfoot>
								</table>
								<!--����Ͽ�ơ��֥뤳���ޤ�-->
								
								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="5" alt=""></td>
										<td><img src="<?php echo @URL_DIR; ?>
img/contents/tbl_top.gif" width="676" height="7" alt=""></td>
										<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="5" alt=""></td>
									</tr>
									<tr>
										<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="10" alt=""></td>
										<td bgcolor="#e9e7de" align="center">
										<table border="0" cellspacing="0" cellpadding="0" summary=" ">
											<tr>
												<td><a href="javascript:fnFormModeSubmit('form1', 'regist', '', '');"><img onMouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/contents/btn_regist_on.jpg',this)" onMouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/contents/btn_regist.jpg',this)" src="<?php echo @URL_DIR; ?>
img/contents/btn_regist.jpg" width="123" height="24" alt="�������Ƥ���Ͽ����" border="0"></a></td>
											</tr>
										</table>
										</td>
										<td bgcolor="#cccccc"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="10" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/tbl_bottom.gif" width="678" height="8" alt=""></td>
									</tr>
									</form>
								</table>
								
								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr><td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/main_bar.jpg" width="678" height="10" alt=""></td></tr>
								</table>
								
								<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_top.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td background="<?php echo @URL_DIR; ?>
img/contents/contents_title_left_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_left.gif" width="22" height="12" alt=""></td>
										<td bgcolor="#636469" width="638" class="fs14n"><span class="white"><!--����ƥ�ĥ����ȥ�-->�����ڡ������</span></td>										
										<td background="<?php echo @URL_DIR; ?>
img/contents/contents_title_right_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="18" height="1" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/contents_title_bottom.gif" width="678" height="7" alt=""></td>
									</tr>
									<tr>
										<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/main_bar.jpg" width="678" height="10" alt=""></td>
									</tr>
								</table>

								<!--������ɽ�����ꥢ��������-->
								<table width="678" border="0" cellspacing="1" cellpadding="8" summary=" ">
									<tr bgcolor="#f2f1ec" align="center" class="fs12n">
										<td width="205" rowspan="2">�����ڡ���̾</td>
										<td width="50" rowspan="2">�����Ϳ�</td>
										<td width="160" colspan="2">�ǥ���������</td>
										<td width="50" rowspan="2">�Խ�</td>
										<td width="50" rowspan="2">���</td>
										<td width="50" rowspan="2">CSV</td>
									</tr>
									<tr bgcolor="#f2f1ec" align="center" class="fs12n">
										<td width="80">�����ڡ�����</td>
										<td width="80">�����ڡ���λ</td>
									</tr>
									<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['arrCampaign']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<tr bgcolor="#ffffff" align="center" class="fs12n">
										<td width="205"><?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_name']; ?>
</td>
										<td width="50"><?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['total_count']; ?>
</td>
										<td width="80"><a href="<?php echo @URL_CAMPAIGN_DESIGN; ?>
?campaign_id=<?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id']; ?>
&status=active">����</a></td>
										<td width="80"><a href="<?php echo @URL_CAMPAIGN_DESIGN; ?>
?campaign_id=<?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id']; ?>
&status=end">����</a></td>
										<?php if ($this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id'] != $this->_tpl_vars['arrForm']['campaign_id']): ?>
										<td width="50"><a href="javascript:fnFormModeSubmit('form1', 'update', 'campaign_id', '<?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id']; ?>
')">�Խ�</a></td>
										<?php else: ?>
										<td width="50">�Խ�</td>
										<?php endif; ?>
										<td width="50"><a href="javascript:fnFormModeSubmit('form1', 'delete', 'campaign_id', '<?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id']; ?>
')">���</a></td>
										<td width="50"><a href="javascript:fnFormModeSubmit('form1', 'csv', 'campaign_id', '<?php echo $this->_tpl_vars['arrCampaign'][$this->_sections['cnt']['index']]['campaign_id']; ?>
')">CSV</a></td>
									</tr>
									<?php endfor; endif; ?>									
								</table>
								<!--������ɽ�����ꥢ�����ޤ�-->
									
								</td>
								<td background="<?php echo @URL_DIR; ?>
img/contents/main_right.jpg"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="14" height="1" alt=""></td>
							</tr>
							<tr>
								<td colspan="3"><img src="<?php echo @URL_DIR; ?>
img/contents/main_bottom.jpg" width="706" height="14" alt=""></td>
							</tr>
							<tr><td height="30"></td></tr>
						</table>
					</td>
				</tr>
				<!--�ᥤ�󥨥ꥢ-->
			</table>
			<!--����Ͽ�ơ��֥뤳���ޤ�-->
		</td>
	</tr>
</table>
</form>
<!--�����ᥤ�󥳥�ƥ�ġ���-->