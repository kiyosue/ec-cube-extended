<!--{*
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
*}-->
<center>���쥸�åȷ��</center>

<hr>

<form method="post" action="<!--{$arrSendData.SEND_URL|escape}-->">
<!--{foreach from=$arrSendData key=key item=val}-->
    <!--{if $key != 'SEND_URL'}-->
    <input type="hidden" name="<!--{$key|escape}-->" value="<!--{$val|escape}-->">
    <!--{/if}-->
<!--{/foreach}-->

������ʧ����ˡ<br>
<!--{foreach key=key item=item from=$arrCreMet name=method_loop}-->
<input type="radio"
       name="METHOD"
       value="<!--{$key}-->" <!--{if $smarty.foreach.method_loop.first}-->checked<!--{/if}--> /> <!--{$item|escape}--><br>
<!--{/foreach}-->

<br>

��ʬ����<br>
<!--{assign var=key value="PTIMES"}-->
<span class="red"><!--{$arrErr[$key]}--></span>
<select name="<!--{$key}-->">
<option value="1" selected="">����ʤ�</option>
<!--{html_options options=$arrCreDiv selected=$arrForm[$key].value}-->
</select>

<br>

<center><input type="submit" name="register" value="��ʸ��λ�ڡ�����"></center>
</form>

<form method="post" action="<!--{$smarty.server.PHP_SELF|escape}-->">
<input type="hidden" name="mode" value="return">
<center><input type="submit" name="return" value="���"></center>
</form>

<br>
<hr>

<a href="<!--{$smarty.const.MOBILE_URL_CART_TOP}-->" accesskey="9"><!--{9|numeric_emoji}-->�����򸫤�</a><br>
<a href="<!--{$smarty.const.MOBILE_URL_SITE_TOP}-->" accesskey="0"><!--{0|numeric_emoji}-->TOP�ڡ�����</a><br>

<br>

<!-- ���եå��� �������� -->
<center>LOCKON CO.,LTD.</center>
<!-- ���եå��� �����ޤ� -->
