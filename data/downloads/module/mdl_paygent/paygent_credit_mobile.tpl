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
�������Ѥ��������륫���ɤμ���<br>
<img src="<!--{$smarty.const.IMAGE_SAVE_URL}--><!--{$tpl_payment_image}-->"><br><br>
<!--{/if}-->

����ʧ���<br>
<!--{assign var=key1 value="payment_class"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<select name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" style="<!--{$arrErr[$key1]|sfGetErrorColor}-->" >
<!--{html_options options=$arrPaymentClass selected=$arrForm[$key1].value}-->
</select>
<br><br>

<!--{if $cnt_card >= 1}-->
����Ͽ������<br>
<!--{assign var=key1 value="CardSeq"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<input type="checkbox" name="stock" value="1" <!--{if $smarty.post.stock == 1}-->checked<!--{/if}-->>��Ͽ�����ɤ����Ѥ���<br>
<font size="2">��Ͽ�����ɤ����Ѥ����ϡ������ɾ�������Ϥ����פǤ���<br><font color="#ff6600">���Ϥ���Ƥ�Ŭ�Ѥ���ޤ���Τǡ�����դ���������</font></font>
<table border>
  <tr>
    <td>����</td>
    <td>�������ֹ�</td>
    <td>ͭ������</td>
    <td>������̾��</td>
  </tr>
  <!--{foreach name=cardloop from=$arrCardInfo item=card}-->
  <tr>
    <td><input type="radio" name="<!--{$key1}-->" value="<!--{$card[$key1]}-->" <!--{if $smarty.post.$key1 == $card[$key1]}-->checked<!--{/if}-->></td>
    <td><!--{$card.CardNo}--></td>
    <td><!--{$card.Expire|substr:0:2}-->��/<!--{$card.Expire|substr:2:4}-->ǯ</td>
    <td><!--{$card.HolderName}--></td>
  </tr>
  <!--{/foreach}-->
</table>
<input type="submit" name="deletecard" value="���򥫡��ɤκ��">
<br><br>
<!--{/if}-->

���������ֹ�<br>
<font size="2"><font color="#ff6600">���ܿ�̾���Υ����ɤ򤴻��Ѥ���������</font><br>
Ⱦ�����ϡ��㡧1234-5678-9012-3456��</font><br>
<!--{assign var=key1 value="card_no01"}-->
<!--{assign var=key2 value="card_no02"}-->
<!--{assign var=key3 value="card_no03"}-->
<!--{assign var=key4 value="card_no04"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<font color="#ff0000"><!--{$arrErr[$key2]}--></font>
<font color="#ff0000"><!--{$arrErr[$key3]}--></font>
<font color="#ff0000"><!--{$arrErr[$key4]}--></font>
<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->" size="6" istyle="4">-
<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->" size="6" istyle="4">-
<input type="text" name="<!--{$key3}-->" value="<!--{$arrForm[$key3].value|escape}-->" maxlength="<!--{$arrForm[$key3].length}-->" size="6" istyle="4">-
<input type="text" name="<!--{$key4}-->" value="<!--{$arrForm[$key4].value|escape}-->" maxlength="<!--{$arrForm[$key4].length}-->" size="6" istyle="4">
<br><br>

��ͭ������<br>
<!--{assign var=key1 value="card_month"}-->
<!--{assign var=key2 value="card_year"}-->
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<font color="#ff0000"><!--{$arrErr[$key2]}--></font>
<select name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" maxlength="<!--{$arrForm[$key1].length}-->">
<option value="">--</option>
<!--{html_options options=$arrMonth selected=$arrForm[$key1].value}-->
</select>��/
<select name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" maxlength="<!--{$arrForm[$key2].length}-->">
<option value="">--</option>
<!--{html_options options=$arrYear selected=$arrForm[$key2].value}-->
</select>ǯ
<br><br>

��������̾���ʥ��޻���</td>
<font size="2">Ⱦ�����ϡ��㡧TARO YAMADA��</font><br>
<!--{assign var=key2 value="card_name01"}-->
<!--{assign var=key1 value="card_name02"}-->								
<font color="#ff0000"><!--{$arrErr[$key1]}--></font>
<font color="#ff0000"><!--{$arrErr[$key2]}--></font>
̾<input type="text" name="<!--{$key1}-->" value="<!--{$arrForm[$key1].value|escape}-->" istyle="3" size="15"><br>
��<input type="text" name="<!--{$key2}-->" value="<!--{$arrForm[$key2].value|escape}-->" istyle="3" size="15">
<br><br>

<!--{if $stock_flg == 1}-->
����������Ͽ<br>
<input type="checkbox" name="stock_new" value="1" <!--{if $smarty.post.stock_new == 1}-->checked<!--{/if}-->>��Ͽ����<br>
<font size="2">�����ɾ������Ͽ���Ƥ����ȡ�����ʹߤι������˥����ɾ������Ϥ���ά�Ǥ������������Ǥ���<br>����5��ޤ���Ͽ�Ǥ��ޤ���</font>
<br><br>
<!--{/if}-->

<br>

�ʾ�����ƤǴְ㤤�ʤ���С������ּ��ءץܥ���򥯥�å����Ƥ���������<br>
<font size="2" color="#ff6600">�����̤��ڤ��ؤ�ޤǾ������֤��������礬�������ޤ��������Τޤޤ��Ԥ�����������</font><br>
<center><input type="submit" value="����"></center>
</form>
<form action="./load_payment_module.php" method="post">
<input type="hidden" name="mode" value="return">
<center><input type="submit" value="���"></center>
</form>

<br>
<hr>

<a href="<!--{$smarty.const.URL_CART_TOP}-->" accesskey="9"><!--{9|numeric_emoji}-->�����򸫤�</a><br>
<a href="<!--{$smarty.const.URL_SITE_TOP}-->" accesskey="0"><!--{0|numeric_emoji}-->TOP�ڡ�����</a><br>

<br>

<!-- ���եå��� �������� -->
<center>LOCKON CO.,LTD.</center>
<!-- ���եå��� �����ޤ� -->
