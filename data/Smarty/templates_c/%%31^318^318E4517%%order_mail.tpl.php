<?php /* Smarty version 2.6.13, created on 2007-01-10 00:06:20
         compiled from mail_templates/order_mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'mail_templates/order_mail.tpl', 15, false),array('modifier', 'default', 'mail_templates/order_mail.tpl', 15, false),array('modifier', 'sfPreTax', 'mail_templates/order_mail.tpl', 46, false),)), $this); ?>
<?php echo $this->_tpl_vars['arrOrder']['order_name01']; ?>
 <?php echo $this->_tpl_vars['arrOrder']['order_name02']; ?>
 ��

<?php echo $this->_tpl_vars['tpl_header']; ?>


******************************************************************
����������Ȥ�������
******************************************************************

����ʸ�ֹ桧<?php echo $this->_tpl_vars['arrOrder']['order_id']; ?>

����ʧ��ס��� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['payment_total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

�������ˡ��<?php echo $this->_tpl_vars['arrOrder']['payment_method']; ?>

�����Ϥ�����<?php echo ((is_array($_tmp=@$this->_tpl_vars['arrOrder']['deliv_date'])) ? $this->_run_mod_handler('default', true, $_tmp, "����ʤ�") : smarty_modifier_default($_tmp, "����ʤ�")); ?>

���Ϥ����֡�<?php echo ((is_array($_tmp=@$this->_tpl_vars['arrOrder']['deliv_time'])) ? $this->_run_mod_handler('default', true, $_tmp, "����ʤ�") : smarty_modifier_default($_tmp, "����ʤ�")); ?>

��å�������<?php echo $this->_tpl_vars['Message_tmp']; ?>

�����Ϥ���
����̾������<?php echo $this->_tpl_vars['arrOrder']['deliv_name01']; ?>
 <?php echo $this->_tpl_vars['arrOrder']['deliv_name02']; ?>
����
��͹���ֹ桧��<?php echo $this->_tpl_vars['arrOrder']['deliv_zip01']; ?>
-<?php echo $this->_tpl_vars['arrOrder']['deliv_zip02']; ?>

�������ꡡ��<?php echo $this->_tpl_vars['arrOrder']['deliv_pref'];  echo $this->_tpl_vars['arrOrder']['deliv_addr01'];  echo $this->_tpl_vars['arrOrder']['deliv_addr02']; ?>

�������ֹ桧<?php echo $this->_tpl_vars['arrOrder']['deliv_tel01']; ?>
-<?php echo $this->_tpl_vars['arrOrder']['deliv_tel02']; ?>
-<?php echo $this->_tpl_vars['arrOrder']['deliv_tel03']; ?>


<?php if ($this->_tpl_vars['arrOther']['title']['value']): ?>
******************************************************************
��<?php echo $this->_tpl_vars['arrOther']['title']['name']; ?>
����
******************************************************************

<?php $_from = $this->_tpl_vars['arrOther']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['key'] != 'title'): ?>
<?php if ($this->_tpl_vars['item']['name'] != ""):  echo $this->_tpl_vars['item']['name']; ?>
��<?php endif;  echo $this->_tpl_vars['item']['value']; ?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

******************************************************************
������ʸ��������
******************************************************************

<?php unset($this->_sections['cnt']);
$this->_sections['cnt']['name'] = 'cnt';
$this->_sections['cnt']['loop'] = is_array($_loop=$this->_tpl_vars['arrOrderDetail']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
����̾: <?php echo $this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['product_name']; ?>
 <?php echo $this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['classcategory_name1']; ?>
 <?php echo $this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['classcategory_name2']; ?>

���ʥ�����: <?php echo $this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['product_code']; ?>

���̡�<?php echo $this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['quantity']; ?>
 ��
��ۡ��� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrderDetail'][$this->_sections['cnt']['index']]['price'])) ? $this->_run_mod_handler('sfPreTax', true, $_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule']) : sfPreTax($_tmp, $this->_tpl_vars['arrInfo']['tax'], $this->_tpl_vars['arrInfo']['tax_rule'])))) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>


<?php endfor; endif; ?>
-----------------------------------------------------------
������ �� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['subtotal'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 (���������� ��<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['tax'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
��
�Ͱ��� �� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['use_point']+$this->_tpl_vars['arrOrder']['discount'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

������ �� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['deliv_fee'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

����� �� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['charge'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

===============================================================
�硡�� �� <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrOrder']['payment_total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

===============================================================

�����ѥݥ���� <?php echo ((is_array($_tmp=@$this->_tpl_vars['arrOrder']['use_point'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 pt
����û������û��ݥ���� <?php echo ((is_array($_tmp=@$this->_tpl_vars['arrOrder']['add_point'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 pt
�ݻ��ݥ���� <?php echo ((is_array($_tmp=@$this->_tpl_vars['arrCustomer']['point'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 pt

<?php echo $this->_tpl_vars['tpl_footer']; ?>