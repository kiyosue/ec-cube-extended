<!--{*
/*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 */
*}-->
<center>����ʸ��λ</center>

<hr>

����ʸ��ͭ���񤦤������ޤ�����<br>
��������򤪳ڤ��ߤˤ��Ԥ��������ޤ���<br>
�ɤ���������Ȥ⡢<!--{$arrInfo.shop_name|escape}-->���������ꤤ���ޤ���<br>
<br>

<!--{if $arrOther.title.value }-->
<!-- ������¾�η�Ѿ��� -->
��<!--{$arrOther.title.name}-->����<br>
<!--{foreach key=key item=item from=$arrOther}-->
<!--{if $key != "title"}-->
<!--{if $item.name != ""}--><!--{$item.name}-->��<!--{/if}--><!--{$item.value|nl2br}--><br>
<!--{/if}-->
<!--{/foreach}-->
<br>
<!-- ������¾�η�Ѿ��� -->
<!--{/if}-->

<a href="<!--{$smarty.const.MOBILE_URL_SITE_TOP}-->" accesskey="0"><!--{0|numeric_emoji}-->TOP�ڡ��������</a><br>

<br>
<hr>

<!-- ���եå��� �������� -->
<center>LOCKON CO.,LTD.</center>
<!-- ���եå��� �����ޤ� -->
