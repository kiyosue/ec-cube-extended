<!--{*
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
*}-->
<!--��CONTENTS-->
<!--��MAIN ONTENTS-->
<div align="center"><font color="#000080">����ʸ��³��</font></div><br>
<hr>
<!--{if !$tpl_valid_phone_id}-->
<!--�������Ͽ�����ѤߤǤʤ�������-->
�����Ƥ���ʸ����<br>
(��������Ͽ)<br>
<form name="member_form" id="member_form" method="post" action="sendRequest(test,'&test=test','POST','json.php',true,true)">
	<div align="center"><input type="submit" value="�ƥ���"></div><br>
</form>
<!--���ޤ������Ͽ����Ƥ��ʤ�������-->
<!--{/if}-->

<!--�������Ͽ����ʤ�������-->
<form name="nonmember_form" id="nonmember_form" method="post" action="<!--{$smarty.const.MOBILE_URL_DIR}-->shopping/index.php">
	<input type="hidden" name="mode" value="nonmember">
	<input type="hidden" name="mode2" value="set1">
	<center><input type="submit" value="��Ͽ�����˹���" name="nonmember"></center>
</form>
<!--�������Ͽ����ʤ�������-->
<!--��MAIN ONTENTS-->
<!--��CONTENTS-->

<br>
<hr>

<a href="<!--{$smarty.const.MOBILE_URL_CART_TOP}-->" accesskey="9"><!--{9|numeric_emoji}-->�����򸫤�</a><br>
<a href="<!--{$smarty.const.MOBILE_URL_SITE_TOP}-->" accesskey="0"><!--{0|numeric_emoji}-->TOP�ڡ�����</a><br>

<br>

<!-- ���եå��� �������� -->
<!--{include file='footer.tpl'}-->
<!-- ���եå��� �����ޤ� -->
