<?php /* Smarty version 2.6.13, created on 2007-01-15 19:58:43
         compiled from customer/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'customer/index.tpl', 43, false),array('modifier', 'sfGetErrorColor', 'customer/index.tpl', 103, false),array('function', 'sfSetErrorStyle', 'customer/index.tpl', 83, false),array('function', 'html_options', 'customer/index.tpl', 89, false),array('function', 'html_checkboxes', 'customer/index.tpl', 100, false),array('function', 'mailto', 'customer/index.tpl', 391, false),)), $this); ?>
<script type="text/javascript">
<!--
	
	function fnCustomerPage(pageno) {
		document.form1.search_pageno.value = pageno;
		document.form1.submit();
	}
	
	function fnCSVDownload(pageno) {
		document.form1['csv_mode'].value = 'csv';
		document.form1.submit();
		document.form1['csv_mode'].value = '';
		return false;
	}
	
	function fnDelete(customer_id) {
		if (confirm('���θܵҾ���������Ƥ⵹�����Ǥ�����')) {
			document.form1.mode.value = "delete"
			document.form1['edit_customer_id'].value = customer_id;
			document.form1.submit();
			return false;
		}
	}
	
	function fnEdit(customer_id) {
		document.form1.action = './edit.php';
		document.form1.mode.value = "edit_search"
		document.form1['edit_customer_id'].value = customer_id;
		document.form1.search_pageno.value = 1;
		document.form1.submit();
		return false;
	}

	function fnSubmit() {
		document.form1.submit();
		return false;
	}
//-->
</script>

<!--�����ᥤ�󥳥�ƥ�ġ���-->
<table width="878" border="0" cellspacing="0" cellpadding="0" summary=" ">
<form name="form_search" id="form_search" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="hidden" name="mode" value="search">
	<tr valign="top">
		<td background="<?php echo @URL_DIR; ?>
img/contents/navi_bg.gif" height="402">
			<!-- ���֥ʥ� -->
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tpl_subnavi'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
		<td class="mainbg">
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
								<td bgcolor="#636469" width="638" class="fs14n"><span class="white"><!--����ƥ�ĥ����ȥ�-->�����������</span></td>
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
						<!--�����������ơ��֥뤳������-->
						<table width="678" border="0" cellspacing="1" cellpadding="8" summary=" ">
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�ܵҥ�����</td>
								<td bgcolor="#ffffff" width="194"><?php if ($this->_tpl_vars['arrErr']['customer_id']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['customer_id']; ?>
</span><br><?php endif; ?><input type="text" name="customer_id" maxlength="<?php echo @INT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['customer_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" class="box30" <?php if ($this->_tpl_vars['arrErr']['customer_id']):  echo sfSetErrorStyle(array(), $this); endif; ?> /></td>
								<td bgcolor="#f2f1ec" width="110">��ƻ�ܸ�</td>
								<td bgcolor="#ffffff" width="195">
									<?php if ($this->_tpl_vars['arrErr']['pref']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['pref']; ?>
</span><br><?php endif; ?>
									<select name="pref">
										<option value="" selected="selected" <?php if ($this->_tpl_vars['arrErr']['name']):  echo sfSetErrorStyle(array(), $this); endif; ?>>��ƻ�ܸ�������</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPref'],'selected' => $this->_tpl_vars['arrForm']['pref']), $this);?>

									</select>
								</td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�ܵ�̾</td>
								<td bgcolor="#ffffff" width="194"><?php if ($this->_tpl_vars['arrErr']['name']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['name']; ?>
</span><br><?php endif; ?><input type="text" name="name" maxlength="<?php echo @STEXT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" class="box30" <?php if ($this->_tpl_vars['arrErr']['name']):  echo sfSetErrorStyle(array(), $this); endif; ?> /></td>
								<td bgcolor="#f2f1ec" width="110">�ܵ�̾�ʥ��ʡ�</td>
								<td bgcolor="#ffffff" width="195"><?php if ($this->_tpl_vars['arrErr']['kana']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['kana']; ?>
</span><br><?php endif; ?><input type="text" name="kana" maxlength="<?php echo @STEXT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" class="box30" <?php if ($this->_tpl_vars['arrErr']['kana']):  echo sfSetErrorStyle(array(), $this); endif; ?> /></td>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">����</td>
								<td bgcolor="#ffffff" width="194"><?php echo smarty_function_html_checkboxes(array('name' => 'sex','options' => $this->_tpl_vars['arrSex'],'separator' => "&nbsp;",'selected' => $this->_tpl_vars['arrForm']['sex']), $this);?>
</td>
								<td bgcolor="#f2f1ec" width="110">������</td>
								<td bgcolor="#ffffff" width="195"><?php if ($this->_tpl_vars['arrErr']['birth_month']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['birth_month']; ?>
</span><br><?php endif; ?>
									<select name="birth_month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['birth_month'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" >
										<option value="" selected="selected">--</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['objDate']->getMonth(),'selected' => $this->_tpl_vars['arrForm']['birth_month']), $this);?>

									</select>��
								</td>
							</tr>
							<tr class="fs12n">			
								<td bgcolor="#f2f1ec" width="110">������</td>
								<td bgcolor="#ffffff" width="499" colspan="3">
									<?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['b_start_year'];  echo $this->_tpl_vars['arrErr']['b_end_year']; ?>
</span><br><?php endif; ?>
									<select name="b_start_year" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['b_start_year']), $this);?>

									</select>ǯ
									<select name="b_start_month" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['b_start_month']), $this);?>

									</select>��
									<select name="b_start_day" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['b_start_day']), $this);?>

									</select>����
									<select name="b_end_year" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['b_end_year']), $this);?>

									</select>ǯ
									<select name="b_end_month" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['b_end_month']), $this);?>

									</select>��
									<select name="b_end_day" <?php if ($this->_tpl_vars['arrErr']['b_start_year'] || $this->_tpl_vars['arrErr']['b_end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['b_end_day']), $this);?>

									</select>��
								</td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�᡼�륢�ɥ쥹</td>
								<td bgcolor="#ffffff" width="499" colspan="3"><?php if ($this->_tpl_vars['arrErr']['email']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['email']; ?>
</span><?php endif; ?><input type="text" name="email" maxlength="<?php echo @STEXT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="60" class="box60" <?php if ($this->_tpl_vars['arrErr']['email']):  echo sfSetErrorStyle(array(), $this); endif; ?>/></td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�����ֹ�</td>
								<td bgcolor="#ffffff" width="499" colspan="3"><?php if ($this->_tpl_vars['arrErr']['tel']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['tel']; ?>
</span><br><?php endif; ?><input type="text" name="tel" maxlength="<?php echo @TEL_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="60" class="box60" /></td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">����</td>
								<td bgcolor="#ffffff" width="499" colspan="3"><?php echo smarty_function_html_checkboxes(array('name' => 'job','options' => $this->_tpl_vars['arrJob'],'separator' => "&nbsp;",'selected' => $this->_tpl_vars['arrForm']['job']), $this);?>
</td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�������</td>
								<td bgcolor="#ffffff" width="194"><?php if ($this->_tpl_vars['arrErr']['buy_total_from'] || $this->_tpl_vars['arrErr']['buy_total_to']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['buy_total_from'];  echo $this->_tpl_vars['arrErr']['buy_total_to']; ?>
</span><br><?php endif; ?><input type="text" name="buy_total_from" maxlength="<?php echo @INT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['buy_total_from'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="6" class="box6" <?php if ($this->_tpl_vars['arrErr']['buy_total_from'] || $this->_tpl_vars['arrErr']['buy_total_to']):  echo sfSetErrorStyle(array(), $this); endif; ?> /> �� �� <input type="text" name="buy_total_to" maxlength="<?php echo @INT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['buy_total_to'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="6" class="box6" <?php if ($this->_tpl_vars['arrErr']['buy_total_from'] || $this->_tpl_vars['arrErr']['buy_total_to']):  echo sfSetErrorStyle(array(), $this); endif; ?> /> ��</td>
								<td bgcolor="#f2f1ec" width="110">�������</td>
								<td bgcolor="#ffffff" width="195"><?php if ($this->_tpl_vars['arrErr']['buy_times_from'] || $this->_tpl_vars['arrErr']['buy_times_to']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['buy_times_from'];  echo $this->_tpl_vars['arrErr']['buy_times_to']; ?>
</span><br><?php endif; ?><input type="text" name="buy_times_from" maxlength="<?php echo @INT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['buy_times_from'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="6" class="box6" <?php if ($this->_tpl_vars['arrErr']['buy_times_from'] || $this->_tpl_vars['arrErr']['buy_times_to']):  echo sfSetErrorStyle(array(), $this); endif; ?> /> �� �� <input type="text" name="buy_times_to" maxlength="<?php echo @INT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['buy_times_to'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="6" class="box6" <?php if ($this->_tpl_vars['arrErr']['buy_times_from'] || $this->_tpl_vars['arrErr']['buy_times_to']):  echo sfSetErrorStyle(array(), $this); endif; ?> /> ��</td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">��Ͽ��������</td>
								<td bgcolor="#ffffff" width="499" colspan="3">
									<?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['start_year'];  echo $this->_tpl_vars['arrErr']['end_year']; ?>
</span><br><?php endif; ?>
									<select name="start_year" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['start_year']), $this);?>

									</select>ǯ
									<select name="start_month" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['start_month']), $this);?>

									</select>��
									<select name="start_day" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['start_day']), $this);?>

									</select>����
									<select name="end_year" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrYear'],'selected' => $this->_tpl_vars['arrForm']['end_year']), $this);?>

									</select>ǯ
									<select name="end_month" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['end_month']), $this);?>

									</select>��
									<select name="end_day" <?php if ($this->_tpl_vars['arrErr']['start_year'] || $this->_tpl_vars['arrErr']['end_year']):  echo sfSetErrorStyle(array(), $this); endif; ?>>
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['end_day']), $this);?>

									</select>��
								</td>
							</tr>
				
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">�ǽ�������</td>
								<td bgcolor="#ffffff" width="499" colspan="3">
									<?php if ($this->_tpl_vars['arrErr']['buy_start_year'] || $this->_tpl_vars['arrErr']['buy_end_year']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['buy_start_year'];  echo $this->_tpl_vars['arrErr']['buy_end_year']; ?>
</span><br><?php endif; ?>
									<select name="buy_start_year" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_start_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['objDate']->getYear(@RELEASE_YEAR),'selected' => $this->_tpl_vars['arrForm']['buy_start_year']), $this);?>

									</select>ǯ
									<select name="buy_start_month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_start_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['buy_start_month']), $this);?>

									</select>��
									<select name="buy_start_day" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_start_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['buy_start_day']), $this);?>

									</select>����
									<select name="buy_end_year" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_end_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">------</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['objDate']->getYear(@RELEASE_YEAR),'selected' => $this->_tpl_vars['arrForm']['buy_end_year']), $this);?>

									</select>ǯ
									<select name="buy_end_month" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_end_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrMonth'],'selected' => $this->_tpl_vars['arrForm']['buy_end_month']), $this);?>

									</select>��
									<select name="buy_end_day" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_end_year'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
										<option value="" selected="selected">----</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrDay'],'selected' => $this->_tpl_vars['arrForm']['buy_end_day']), $this);?>

									</select>��
								</td>
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">��������̾</td>
								<td bgcolor="#ffffff" width="194">
									<?php if ($this->_tpl_vars['arrErr']['buy_product_name']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['buy_product_name']; ?>
</span><?php endif; ?>
									<span style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_product_name'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
">
									<input type="text" name="buy_product_name" maxlength="<?php echo @STEXT_LEN; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['buy_product_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="30" class="box30" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_product_name'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
"/>
									</span>
								</td>
								<td bgcolor="#f2f1ec" width="110">��������<br />������</td>
								<td bgcolor="#ffffff" width="195">
								<?php if ($this->_tpl_vars['arrErr']['buy_product_code']): ?><span class="red12"><?php echo $this->_tpl_vars['arrErr']['buy_product_code']; ?>
</span><?php endif; ?>
								<input type="text" name="buy_product_code" value="<?php echo $this->_tpl_vars['arrForm']['buy_product_code']; ?>
" maxlength="<?php echo @STEXT_LEN; ?>
" size="30" class="box30" style="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['buy_product_code'])) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : sfGetErrorColor($_tmp)); ?>
" >
								</td>				
							</tr>
							<tr class="fs12n">
								<td bgcolor="#f2f1ec" width="110">���ƥ���</td>
								<td bgcolor="#ffffff" width="499" colspan="3">
									<select name="category_id" style="<?php if ($this->_tpl_vars['arrErr']['category_id'] != ""): ?>background-color: <?php echo @ERR_COLOR;  endif; ?>">
										<option value="">���򤷤Ƥ�������</option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrCatList'],'selected' => $this->_tpl_vars['arrForm']['category_id']), $this);?>

									</select>
								</td>
							</tr>
						</table>
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
										<td class="fs12n">�������ɽ�����
											<select name="page_rows">
												<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['arrPageRows'],'selected' => $this->_tpl_vars['arrForm']['page_rows']), $this);?>

											</select> ��</td>
										</td>
										<td><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="10" height="1" alt=""></td>
										<td><input type="image" name="subm" onMouseover="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/contents/btn_search_on.jpg',this)" onMouseout="chgImgImageSubmit('<?php echo @URL_DIR; ?>
img/contents/btn_search.jpg',this)" src="<?php echo @URL_DIR; ?>
img/contents/btn_search.jpg" width="123" height="24" alt="���ξ��Ǹ�������" border="0" ></td>
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
						</table>
						<!--�����������ơ��֥뤳���ޤ�-->
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
		</td>
	</tr>
</form>	
</table>
<!--�����ᥤ�󥳥�ƥ�ġ���-->

<?php if (count ( $this->_tpl_vars['arrErr'] ) == 0 && ( $_POST['mode'] == 'search' || $_POST['mode'] == 'delete' )): ?>

<!--����������̰�������-->
<table width="878" border="0" cellspacing="0" cellpadding="0" summary=" ">
<form name="form1" id="form1" method="post" action="<?php echo ((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<?php $_from = $_POST; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['key'] != 'mode' && $this->_tpl_vars['key'] != 'del_mode' && $this->_tpl_vars['key'] != 'edit_customer_id' && $this->_tpl_vars['key'] != 'del_customer_id' && $this->_tpl_vars['key'] != 'search_pageno' && $this->_tpl_vars['key'] != 'csv_mode' && $this->_tpl_vars['key'] != 'job' && $this->_tpl_vars['key'] != 'sex'): ?><input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $_POST['job']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<input type="hidden" name="job[]" value=<?php echo $this->_tpl_vars['item']; ?>
>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $_POST['sex']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<input type="hidden" name="sex[]" value=<?php echo $this->_tpl_vars['item']; ?>
>
<?php endforeach; endif; unset($_from); ?>
<input type="hidden" name="mode" value="search">
<input type="hidden" name="del_mode" value="">
<input type="hidden" name="edit_customer_id" value="">
<input type="hidden" name="del_customer_id" value="">
<input type="hidden" name="search_pageno" value="<?php echo ((is_array($_tmp=$_POST['search_pageno'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="hidden" name="csv_mode" value="">
	<tr><td colspan="2"><img src="<?php echo @URL_DIR; ?>
img/contents/search_line.jpg" width="878" height="12" alt=""></td></tr>
	<tr bgcolor="cbcbcb">
		<td>
		<table border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<?php echo @URL_DIR; ?>
img/contents/search_left.gif" width="19" height="22" alt=""></td>
				<td>
				<!--�������-->
				<table border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr>
						<td><img src="<?php echo @URL_DIR; ?>
img/contents/reselt_left_top.gif" width="22" height="5" alt=""></td>
						<td background="<?php echo @URL_DIR; ?>
img/contents/reselt_top_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="5" alt=""></td>
						<td><img src="<?php echo @URL_DIR; ?>
img/contents/reselt_right_top.gif" width="22" height="5" alt=""></td>
					</tr>
					<tr>
						<td background="<?php echo @URL_DIR; ?>
img/contents/reselt_left_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/contents/reselt_left_middle.gif" width="22" height="12" alt=""></td>
						<td bgcolor="#393a48" class="white10">������̰�����<span class="reselt"><!--������̿�--><?php echo $this->_tpl_vars['tpl_linemax']; ?>
��</span>&nbsp;���������ޤ�����</td>
						<td background="<?php echo @URL_DIR; ?>
img/contents/reselt_right_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="22" height="8" alt=""></td>
					</tr>
					<tr>
						<td><img src="<?php echo @URL_DIR; ?>
img/contents/reselt_left_bottom.gif" width="22" height="5" alt=""></td>
						<td background="<?php echo @URL_DIR; ?>
img/contents/reselt_bottom_bg.gif"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="5" alt=""></td>
						<td><img src="<?php echo @URL_DIR; ?>
img/contents/reselt_right_bottom.gif" width="22" height="5" alt=""></td>
					</tr>
				</table>
				<!--�������-->
				<?php if (@ADMIN_MODE == '1'): ?>
				<input type="button" name="subm" value="������̤򤹤٤ƺ��" onclick="fnModeSubmit('delete_all','','');" />
				<?php endif; ?>
				</td>
				<td><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="8" height="1" alt=""></td>
				<td><a href="#" onmouseover="chgImg('<?php echo @URL_DIR; ?>
img/contents/btn_csv_on.jpg','btn_csv');" onmouseout="chgImg('<?php echo @URL_DIR; ?>
img/contents/btn_csv.jpg','btn_csv');"  onclick="fnModeSubmit('csv','','');" ><img src="<?php echo @URL_DIR; ?>
img/contents/btn_csv.jpg" width="99" height="22" alt="CSV DOWNLOAD" border="0" name="btn_csv" id="btn_csv"></a></td>
				<td><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="8" height="1" alt=""></td>
				<td><a href="../contents/csv.php?tpl_subno_csv=customer"><span class="fs12n"> >> CSV���Ϲ������� </span></a></td>
			</tr>
		</table>
		</td>
		<td align="right">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tpl_pager'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>									
	</tr>
	<tr><td bgcolor="cbcbcb" colspan="2"><img src="<?php echo @URL_DIR; ?>
img/common/_.gif" width="1" height="5" alt=""></td></tr>
</table>

<table width="878" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td bgcolor="#f0f0f0" align="center">

		<?php if (count ( $this->_tpl_vars['search_data'] ) > 0): ?>		

			<table width="840" border="0" cellspacing="0" cellpadding="0" summary=" ">
				<tr><td height="12"></td></tr>
				<tr>
					<td bgcolor="#cccccc">
					<!--�������ɽ���ơ��֥�-->
					<table width="840" border="0" cellspacing="1" cellpadding="5" summary=" ">
						<tr bgcolor="#636469" align="center" class="fs12n">
							<td width="50" rowspan="2"><span class="white">����</span></td>
							<td width="120"><span class="white">�ܵҥ�����</span></td>
							<td width="300" rowspan="2"><span class="white">�ܵ�̾/�ʥ��ʡ�</span></td>
							<td width="50" rowspan="2"><span class="white">����</span></td>
							<td width="250"><span class="white">TEL</span></td>
							<td width="50" rowspan="2"><span class="white">�Խ�</span></td>
							<td width="50" rowspan="2"><span class="white">���</span></td>
						</tr>
						<tr bgcolor="#636469" align="center" class="fs12n">
							<td width=""><span class="white">��ƻ�ܸ�</span></td>
							<td width=""><span class="white">�᡼�륢�ɥ쥹</span></td>
						</tr>
						<?php unset($this->_sections['data']);
$this->_sections['data']['name'] = 'data';
$this->_sections['data']['loop'] = is_array($_loop=$this->_tpl_vars['search_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['data']['show'] = true;
$this->_sections['data']['max'] = $this->_sections['data']['loop'];
$this->_sections['data']['step'] = 1;
$this->_sections['data']['start'] = $this->_sections['data']['step'] > 0 ? 0 : $this->_sections['data']['loop']-1;
if ($this->_sections['data']['show']) {
    $this->_sections['data']['total'] = $this->_sections['data']['loop'];
    if ($this->_sections['data']['total'] == 0)
        $this->_sections['data']['show'] = false;
} else
    $this->_sections['data']['total'] = 0;
if ($this->_sections['data']['show']):

            for ($this->_sections['data']['index'] = $this->_sections['data']['start'], $this->_sections['data']['iteration'] = 1;
                 $this->_sections['data']['iteration'] <= $this->_sections['data']['total'];
                 $this->_sections['data']['index'] += $this->_sections['data']['step'], $this->_sections['data']['iteration']++):
$this->_sections['data']['rownum'] = $this->_sections['data']['iteration'];
$this->_sections['data']['index_prev'] = $this->_sections['data']['index'] - $this->_sections['data']['step'];
$this->_sections['data']['index_next'] = $this->_sections['data']['index'] + $this->_sections['data']['step'];
$this->_sections['data']['first']      = ($this->_sections['data']['iteration'] == 1);
$this->_sections['data']['last']       = ($this->_sections['data']['iteration'] == $this->_sections['data']['total']);
?>
							<!--�ܵ�<?php echo $this->_sections['data']['iteration']; ?>
-->
							<tr bgcolor="#ffffff" class="fs12n">
								<td align="center" rowspan="2"><?php if ($this->_tpl_vars['search_data'][$this->_sections['data']['index']]['status'] == 1): ?>��<?php else: ?>��<?php endif; ?></td>
								<td><?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['customer_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
								<td rowspan="2"><?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['name01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['name02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
(<?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['kana01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['kana02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)</td>
								<td align="center" rowspan="2"><?php if ($this->_tpl_vars['search_data'][$this->_sections['data']['index']]['sex'] == 1): ?>����<?php else: ?>����<?php endif; ?></td>
								<td><?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['tel01'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['tel02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['tel03'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
								<td align="center" rowspan="2"><span class="icon_edit"><a href="#" onclick="return fnEdit('<?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['customer_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
');">�Խ�</a></span>
								</td>
								<td align="center" rowspan="2"><span class="icon_delete"><a href="#" onclick="return fnDelete('<?php echo ((is_array($_tmp=$this->_tpl_vars['search_data'][$this->_sections['data']['index']]['customer_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
');">���</a></span></td>
							</tr>
							<tr bgcolor="#ffffff" class="fs12n">
								<td width=""><?php $this->assign('pref', $this->_tpl_vars['search_data'][$this->_sections['data']['index']]['pref']);  echo $this->_tpl_vars['arrPref'][$this->_tpl_vars['pref']]; ?>
</td>
								<td width=""><?php echo smarty_function_mailto(array('address' => $this->_tpl_vars['search_data'][$this->_sections['data']['index']]['email'],'encode' => 'javascript'), $this);?>
</a></td>
							</tr>
							<!--�ܵ�<?php echo $this->_sections['data']['iteration']; ?>
-->
						<?php endfor; endif; ?>
					</table>
					<!--�������ɽ���ơ��֥�-->
					</td>
				</tr>
			</table>

		<?php endif; ?>

		</td>
	</tr>
</form>
</table>		
<!--����������̰�������-->		

<?php endif; ?>