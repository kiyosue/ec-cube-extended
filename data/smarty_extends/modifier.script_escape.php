<?php
/**
 * Script�����򥨥�������
 * ���ƤΥڡ�����Ŭ�Ѥ����
 *
 * @param string $value ����
 * @return string ����
 */
function smarty_modifier_script_escape($value) {
    
    return preg_replace("/<script.*?>|<\/script>/", '&lt;script&gt;', $value);
    
}
?>
