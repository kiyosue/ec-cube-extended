<!--{if $cybs_disp}-->
<script type="text/javascript">
// ��ѽ���(Ϳ�����/���/�ֶ�)��Ԥ�
function doCybsApp(app, name) {
    var msg = name + '������¹Ԥ��ޤ���������Ǥ�����';
    if (window.confirm(msg)) {
        fnModeSubmit('cybs_do_ics_application','cybs_app', app);
    }
}
</script>
<table width="678" border="0" cellspacing="1" cellpadding="8" summary=" ">
    <tr class="fs12n">
        <td bgcolor="#f2f1ec" width="717" colspan="4">�������С�������</td>
    </tr>
    <!--{if $cybs_result != ''}-->
    <tr class="fs12n">
        <td bgcolor="#f2f1ec" width="110">���</td>
        <td bgcolor="#ffffff"><span class="red"><!--{$cybs_result}--></span></td>
    </tr>
    <!--{/if}-->
    <tr class="fs12n">
        <td bgcolor="#f2f1ec" width="110">���ơ�����</td>
        <td bgcolor="#ffffff">
            <!--{assign var=key value="cybs_auth_status"}-->
            <span class="red12"><!--{$arrErr[$key]}--></span>
            <select name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
            <!--{html_options options=$arrCybsAuthStatus selected=$arrCybsMemo.memo06}-->
            </select>
            <input type="button" value="�ѹ�" onClick="fnModeSubmit('cybs_change_auth_status','','');return false;">
        </td>
    </tr>
    <tr class="fs12n">
        <td bgcolor="#f2f1ec" width="110">����</td>
        <td bgcolor="#ffffff">
        <input type="hidden" name="cybs_app" value="">
        <!--{if $arrCybsMemo.memo06 == $smarty.const.MDL_CYBS_AUTH_STATUS_AUTH}-->
        <input type="button" value="Ϳ�����" onClick="doCybsApp('<!--{$smarty.const.MDL_CYBS_APP_REVERSAL}-->', 'Ϳ�����');return false;">��
        <input type="button" value="���" onClick="doCybsApp('<!--{$smarty.const.MDL_CYBS_APP_BILL}-->', '���');return false;">��
        <input type="button" value="�ֶ�" disabled="disabled">
        <!--{elseif $arrCybsMemo.memo06 == $smarty.const.MDL_CYBS_AUTH_STATUS_AUTHCANCEL}-->
        <input type="button" value="Ϳ�����" disabled="disabled">��
        <input type="button" value="���" disabled="disabled">��
        <input type="button" value="�ֶ�" disabled="disabled">
        <!--{elseif $arrCybsMemo.memo06 == $smarty.const.MDL_CYBS_AUTH_STATUS_CAPTURE}-->
        <input type="button" value="Ϳ�����" disabled="disabled">��
        <input type="button" value="���" disabled="disabled">��
        <input type="button" value="�ֶ�" onClick="doCybsApp('<!--{$smarty.const.MDL_CYBS_APP_CREDIT}-->', '�ֶ�');return false;">��
        <!--{elseif $arrCybsMemo.memo06 == $smarty.const.MDL_CYBS_AUTH_STATUS_RETURN}-->
        <input type="button" value="Ϳ�����" disabled="disabled">��
        <input type="button" value="���" disabled="disabled">��
        <input type="button" value="�ֶ�" disabled="disabled">
        <!--{/if}-->
        </td>
    </tr>
</table>
<table width="678" border="0" cellspacing="0" cellpadding="0" summary=" ">
    <tr><td colspan="3"><img src="<!--{$smarty.const.URL_DIR}-->img/contents/main_bar.jpg" width="678" height="10" alt=""></td></tr>
</table>
<!--{/if}-->