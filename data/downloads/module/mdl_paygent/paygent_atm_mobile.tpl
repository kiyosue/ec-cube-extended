<center><!--{$tpl_payment_method}--></center>

<hr>

<form name="form1" method="post" action="<!--{$smarty.server.PHP_SELF|escape}-->">
<input type="hidden" name="mode" value="next">
<input type="hidden" name="uniqid" value="<!--{$tpl_uniqid}-->">

<!--{if $tpl_error != ""}-->
<font color="#ff0000"><!--{$tpl_error}--></font><br><br>
<!--{/if}-->

������ɬ�׻�������Ϥ��Ƥ���������<br><br>

<!--{if $tpl_payment_image != ""}-->
�����Ѥ����������ͻ���ؤμ���<br>
<img src="<!--{$smarty.const.IMAGE_SAVE_URL}--><!--{$tpl_payment_image}-->"><br><br>
<!--{/if}-->

���Ѽ�<br>
<font size="2">�� �ü�ʴ����ϻ��ѤǤ��ʤ���礬�������ޤ���</font><br>
<!--{assign var=key1 value="customer_family_name"}-->
<!--{assign var=key2 value="customer_name"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<font color="#ff0000"><!--{$arrErr[$key2]}--></font>
��<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" istyle="2" size="15"><br>
̾<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" istyle="2" size="15">
<br><br>

���Ѽ�(����)<br>
<font size="2">�����ʤ������ʡ��ˤ�Ⱦ�����ʡ��ˤ������硢��������Τ߽�������ޤ���ͽ�ᤴλ������������</font><br>
<!--{assign var=key1 value="customer_family_name_kana"}-->
<!--{assign var=key2 value="customer_name_kana"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<font color="#ff0000"><!--{$arrErr[$key2]}--></font>
����<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" istyle="2" size="15"><br>
�ᥤ<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" istyle="2" size="15">
<br><br>

<br>

�ʾ�����ƤǴְ㤤�ʤ���С������ּ��ءץܥ���򥯥�å����Ƥ���������<br>
<font size="2" color="#ff6600">�����̤��ڤ��ؤ�ޤǾ������֤��������礬�������ޤ��������Τޤޤ��Ԥ�����������</font><br>
<center><input type="submit" value="����">
</form>
<form action="./load_payment_module.php" method="post">
<input type="hidden" name="mode" value="return">
<input type="submit" value="���"></center>
</form>

<br>
<hr>

<a href="<!--{$smarty.const.URL_CART_TOP}-->" accesskey="9"><!--{9|numeric_emoji}-->�����򸫤�</a><br>
<a href="<!--{$smarty.const.URL_SITE_TOP}-->" accesskey="0"><!--{0|numeric_emoji}-->TOP�ڡ�����</a><br>

<br>

<!-- ���եå��� �������� -->
<center>LOCKON CO.,LTD.</center>
<!-- ���եå��� �����ޤ� -->
