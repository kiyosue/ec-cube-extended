<!--{*
 * Copyright(c) 2000-2007 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *}-->
<!--����CONTENTS-->
<table width="760" border="0" cellspacing="0" cellpadding="0" summary=" ">
	<tr>
		<td align="center" bgcolor="#ffffff">
		<!--����MAIN ONTENTS-->
		<!--���؎�?��?���������ΎΎ���?->
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/flow04.gif" width="700" height="36" alt="���؎�?��?���������ΎΎ���?></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		<!--���؎�?��?���������ΎΎ���?->
			
		<table width="700" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td><img src="<!--{$smarty.const.URL_DIR}-->img/shopping/complete_title.jpg" width="700" height="40" alt="�����Ï�؎������Ύ�"></td>
			</tr>
			<tr><td height="15"></td></tr>
		</table>
		
		<table width="640" border="0" cellspacing="0" cellpadding="0" summary=" ">
			<tr>
				<td align="center" bgcolor="#cccccc">
				<table width="630" border="0" cellspacing="0" cellpadding="0" summary=" ">
					<tr><td height="5"></td></tr>
					<tr>
						<td align="center" bgcolor="#ffffff">
							<!-- �����������Ύ����ю������ˎ�����������??ώɎ����� -->
							<!--{if $arrOther.title.value }-->
							<table  width="590" cellspacing="0" cellpadding="0" summary=" ">
								<tr>
									<td>
									<table cellspacing="0" cellpadding="0" summary=" " id="comp">
										<tr><td height="20"></td></tr>
										<tr>
											<td class="fs12">����<!--{$arrOther.title.name}-->����?br />
											<!--{foreach key=key item=item from=$arrOther}-->
											<!--{if $key != "title"}--><!--{if $item.name != ""}--><!--{$item.name}-->����<!--{/if}--><!--{$item.value|nl2br}--><br/><!--{/if}-->
											<!--{/foreach}-->
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td height="5"></td></tr>
					<tr>
						<td align="center" bgcolor="#ffffff">
							<!--{/if}-->						
							<!-- �������������ӎ��ˎ��ю��Ύ�?ˎ��ώɎ����� -->
						
							<!--�����Ï�؎������Ύ����Ύʎ����ώ�������������?->
							<table width="590" border="0" cellspacing="0" cellpadding="0" summary=" ">
								<tr><td height="25"></td></tr>
								<tr>
									<td class="fs12"><span class="redst"><!--{$arrInfo.shop_name|escape}-->���Ύ����Ɏʎ��������؎�?���������������������������������Ȏ������������������ގ�����������</span></td>
								</tr>
								<tr><td height="20"></td></tr>
								<tr>
									<td class="fs12">���������������ގ��������Ï�؎����Ύ��Ύǎ���⣎���?��������������������Ǝ������������������ގ����������� <br>
									��??���������Ύǎ���⣎���?���Ǝώ������ʎ�����?ώ������Ȏ��֎�?�Ύ��Ďǎ�������䦎������ގ������Ύ��ǎ��̎ю�����?���ǎ��ώ��������������ގ���������䦎���?�َ�����覎����?�������������������������������ŎŎώÎ��ˎ��Ǝ�����覎����?���������������������ގ������� </td>
								</tr>
								<tr><td height="15"></td></tr>
								<tr>
									<td class="fs12">������ꦎȎ�䦎��������܎������ގ�����𦎦��𦏾���������������������������ꦎ����ގ�������</td>
								</tr>
								<tr><td height="20"></td></tr>
								<tr>
									<td class="fs12"><!--{$arrInfo.shop_name|escape}--><br>
									TEL����<!--{$arrInfo.tel01}-->-<!--{$arrInfo.tel02}-->-<!--{$arrInfo.tel03}--> <!--{if $arrInfo.business_hour != ""}-->���ʎ���ˎՎ�?����/<!--{$arrInfo.business_hour}-->����<!--{/if}--><br>
									E-mail����<a href="mailto:<!--{$arrInfo.email02|escape}-->"><!--{$arrInfo.email02|escape}--></a></td>
								</tr>
								<tr><td height="25"></td></tr>
							</table>
							<!--�����Ï�؎������Ύ����Ύʎ����ώ����������ގ���-->
						</td>
					</tr>
					<tr><td height="5"></td></tr>
				</table>
				</td>
			</tr>
			<tr><td height="20"></td></tr>
			<tr align="center">
				<td>
					<!--{if $is_campaign}-->
					<a href="<!--{$smarty.const.CAMPAIGN_URL}--><!--{$campaign_dir}-->/index.php" onmouseover="chgImg('<!--{$smarty.const.URL_DIR}-->img/common/b_toppage_on.gif','b_toppage');" onmouseout="chgImg('<!--{$smarty.const.URL_DIR}-->img/common/b_toppage.gif','b_toppage');"><img src="<!--{$smarty.const.URL_DIR}-->img/common/b_toppage.gif" width="150" height="30" alt="���Ȏ��Î��׎��ڎ�����������" border="0" name="b_toppage"></a>
					<!--{else}-->
					<a href="<!--{$smarty.const.URL_DIR}-->index.php" onmouseover="chgImg('<!--{$smarty.const.URL_DIR}-->img/common/b_toppage_on.gif','b_toppage');" onmouseout="chgImg('<!--{$smarty.const.URL_DIR}-->img/common/b_toppage.gif','b_toppage');"><img src="<!--{$smarty.const.URL_DIR}-->img/common/b_toppage.gif" width="150" height="30" alt="���Ȏ��Î��׎��ڎ�����������" border="0" name="b_toppage"></a>
					<!--{/if}-->
				</td>
			</tr>
		</table>
		<!--����MAIN ONTENTS-->
		</td>
	</tr>
</table>
<!--����CONTENTS-->
